<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Platform;
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
        //
    }

    public function show($product_id)
    {
        $product = Product::findOrFail($product_id);
        $platforms = Platform::all(); // Fetch all platforms from the database
        $categories = Category::all(); // Fetch all categories from the database
        return view('products.show', compact('product', 'platforms', 'categories'));
    }
}
