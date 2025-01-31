<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
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
    
    




}
