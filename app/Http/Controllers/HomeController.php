<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Monthly Sales Data
        $monthlySales = DB::table('transactions')
            ->select(
                DB::raw('EXTRACT(YEAR FROM transaction_date) as year'),
                DB::raw('EXTRACT(MONTH FROM transaction_date) as month'),
                DB::raw('SUM(total_price) as total_sales')
            )
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        $salesData = $monthlySales->map(function ($item) {
            return [
                'month' => $item->month.'-'.$item->year,
                'total_sales' => $item->total_sales,
            ];
        });

        // Products Sold Data
        $productsSold = Product::select('product_name', DB::raw('SUM(quantity) as total_sold'))
            ->join('product_transaction', 'products.id', '=', 'product_transaction.product_id')
            ->groupBy('product_name')
            ->orderBy('total_sold', 'desc')
            ->get();

        // Products Stock Data
        $productsStock = Product::select('product_name', 'product_stock')
            ->orderBy('product_stock', 'desc')
            ->get();

        // Categories Data
        $categories = Category::withCount('products')
            ->get();

        return view('home', compact('salesData', 'productsSold', 'productsStock', 'categories'));
    }
}
