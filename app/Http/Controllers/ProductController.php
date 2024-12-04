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

    /**
     * Ajouter un produit au panier.
     */
    public function addProduct($productId)
    {
        $user = Auth::user(); // Récupérer l'utilisateur connecté
        $cart = $user->cart; // Récupérer le panier de l'utilisateur

        // Si aucun panier n'existe, en créer un
        if (!$cart) {
            $cart = Cart::create(['user_id' => $user->id]);
        }

        // Vérifier si le produit existe déjà dans le panier
        $existingProduct = $cart->products()->where('product_id', $productId)->first();

        if ($existingProduct) {
            // Si le produit existe déjà, mettre à jour la quantité
            $cart->products()->updateExistingPivot($productId, [
                'quantity' => $existingProduct->pivot->quantity + 1, // Incrémenter la quantité
            ]);
        } else {
            // Si le produit n'existe pas, l'ajouter au panier
            $product = Product::find($productId);
            if ($product) {
                // Ajouter le produit au panier avec sa quantité et son prix
                $cart->products()->attach($productId, [
                    'quantity' => 1, // Par défaut, une seule unité
                    'price' => $product->price, // Ajouter le prix du produit
                ]);
            }
        }

        // Rediriger vers le panier avec un message de succès
        return redirect()->route('cart.index')->with('success', 'Produit ajouté au panier');
    }
}
