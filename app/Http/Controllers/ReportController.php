<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function monthlyReport(Request $request)
    {
        $year = $request->input('year', date('Y'));
        $month = $request->input('month', date('m'));
        $transactions = Transaction::whereYear('transaction_date', $year)
            ->whereMonth('transaction_date', $month)
            ->get();
        $monthlySales = $transactions->sum('total_price');

        return view('reports.monthly', compact('transactions', 'monthlySales', 'year', 'month'));
    }

    public function productReport(Request $request)
    {
        $productSales = DB::table('product_transaction')
            ->join('products', 'product_transaction.product_id', '=', 'products.id')
            ->select('products.product_name', DB::raw('SUM(product_transaction.quantity) as total_sold'), DB::raw('SUM(product_transaction.quantity * products.price) as total_sales_value'))
            ->groupBy('products.product_name')
            ->get();

        $remainingProducts = Product::select('product_name', 'product_stock')
            ->get();

        return view('reports.products', compact('productSales', 'remainingProducts'));
    }
}
