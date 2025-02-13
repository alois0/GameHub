<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Platform;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Affiche tous les produits disponibles.
     */
    public function index()
    {
        // Récupérer tous les produits
        $products = Product::all();
        
        // Retourner la vue avec les produits
        return view('products.index', compact('products')); // Passer les produits à la vue
    }

    public function show($id)
    {
        $product = Product::findOrFail($id); // Récupère le produit par son ID
        return view('products.show', compact('product'));
    }


    public function create()
    {
        $categories = Category::all();
        $platforms = Platform::all();
        return view('admin.products.create', compact('categories', 'platforms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|max:100',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'category_id' => 'required|exists:categories,category_id',
            'platforms' => 'required|array',
            'platforms.*' => 'exists:platforms,id',
        ]);

        $product = Product::create($request->all());
        $product->platforms()->attach($request->platforms);

        return redirect()->route('admin.products.index')->with('success', 'Produit créé avec succès.');
    }
}