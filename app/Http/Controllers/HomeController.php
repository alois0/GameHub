<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderDetail;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $latestProducts = Product::orderBy('created_at', 'desc')->take(5)->get();
        $categories = Category::all();

        // Calculate best-selling products based on order details
        $bestSellingProducts = Product::select('products.id', 'products.product_name', 'products.description', 'products.price', 'products.image_path', DB::raw('SUM(order_details.quantity) as total_sales'))
            ->join('order_details', 'products.id', '=', 'order_details.product_id')
            ->groupBy('products.id', 'products.product_name', 'products.description', 'products.price', 'products.image_path')
            ->orderBy('total_sales', 'desc')
            ->take(5)
            ->get();

        return view('home', compact('latestProducts', 'categories', 'bestSellingProducts'));
    }
}
