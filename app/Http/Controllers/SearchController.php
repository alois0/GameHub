<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        
        // Search products
        $products = Product::where('product_name', 'LIKE', "%{$query}%")
                            ->orWhere('description', 'LIKE', "%{$query}%")
                            ->get();

        // Determine the current route and return the appropriate view
        if (Route::currentRouteName() == 'home') {
            return view('home', compact('products', 'query'));
        } elseif (Route::currentRouteName() == 'products.index') {
            return view('products.index', compact('products', 'query'));
        }

        // Default to home view if route is not recognized
        return view('home', compact('products', 'query'));
    }
}
