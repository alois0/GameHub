<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Platform;
use App\Models\Category;

class HomePageController extends Controller
{
    public function index()
    {
        $products = Product::all(); // Fetch all products from the database
        $platforms = Platform::all(); // Fetch all platforms from the database
        $categories = Category::all(); // Fetch all categories from the database

        return view('home', compact('products', 'platforms', 'categories')); // Pass the products, platforms, and categories to the view
    }
}
