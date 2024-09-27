<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\UserLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;
use PDF;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::orderBy('created_at', 'desc')->paginate(10);

        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $products = Product::where('product_stock', '>', 0)->paginate(10);

        return view('transactions.create', compact('products'));
    }

    public function store(Request $request)
    {
        $this->validateTransaction($request);

        $transaction = $this->createTransaction($request);

        $this->updateProductStock($request, $transaction);

        $this->createTransactionItems($request, $transaction);

        $snapToken = $this->getSnapToken($request, $transaction);

        //log user activity
        UserLog::create([
            'user_id' => Auth::id(),
            'action' => 'create',
            'details' => 'Created transaction: '.$transaction->transaction_number,
        ]);

        return view('transactions.snap', compact('snapToken'));
    }

    public function print(Transaction $transaction)
    {
        $pdf = PDF::loadView('transactions.print', compact('transaction'))
            ->setPaper('a7', 'portrait');

        //log user activity
        UserLog::create([
            'user_id' => Auth::id(),
            'action' => 'print',
            'details' => 'Printed transaction: '.$transaction->transaction_number,
        ]);

        return $pdf->download('transaction_receipt.pdf');
    }

    private function validateTransaction(Request $request)
    {
        $request->validate([
            'transaction_date' => 'required|date',
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);
    }

    private function createTransaction(Request $request)
    {
        return Transaction::create([
            'transaction_number' => uniqid(),
            'transaction_date' => $request->transaction_date,
            'transaction_year' => date('Y', strtotime($request->transaction_date)),
        ]);
    }

    private function updateProductStock(Request $request, Transaction $transaction)
    {
        foreach ($request->products as $product) {
            $productData = Product::find($product['id']);
            $quantity = $product['quantity'];

            $productData->product_stock -= $quantity;
            $productData->save();

            $transaction->products()->attach($product['id'], ['quantity' => $quantity]);
        }
    }

    private function createTransactionItems(Request $request, Transaction $transaction)
    {
        $totalPrice = 0;

        foreach ($request->products as $product) {
            $productData = Product::find($product['id']);
            $quantity = $product['quantity'];
            $price = $productData->price;

            $totalPrice += $price * $quantity;
        }

        $transaction->total_price = $totalPrice;
        $transaction->save();
    }

    private function getSnapToken(Request $request, Transaction $transaction)
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        $items = $this->getItems($request);

        $params = [
            'transaction_details' => [
                'order_id' => $transaction->id.'-'.date('Ymdhis'),
                'gross_amount' => $transaction->total_price,
            ],
            'item_details' => $items,
        ];

        return Snap::getSnapToken($params);
    }

    private function getItems(Request $request)
    {
        $items = [];

        foreach ($request->products as $product) {
            $productData = Product::find($product['id']);

            $items[] = [
                'id' => $productData->id,
                'price' => $productData->price,
                'quantity' => $product['quantity'],
                'name' => $productData->product_name,
            ];
        }

        return $items;
    }
}
