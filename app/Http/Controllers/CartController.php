<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Afficher le panier de l'utilisateur connecté.
     */
    public function index()
    {
        // Vérifier si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect()->route('home'); // Redirige vers la page d'accueil si l'utilisateur n'est pas connecté
        }

        // Récupérer ou créer le panier de l'utilisateur
        $cart = Auth::user()->cart;

        // Si aucun panier n'existe, en créer un
        if (!$cart) {
            $cart = Cart::create(['user_id' => Auth::id()]);
        }

        return view('cart.index', compact('cart')); // Affiche la vue du panier
    }

    /**
     * Ajouter un produit au panier.
     */
    public function addProduct($productId)
    {
        // Vérifier si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect()->route('home'); // Redirige vers la page d'accueil si l'utilisateur n'est pas connecté
        }

        $user = Auth::user();
        $cart = $user->cart;

        // Si aucun panier n'existe, en créer un
        if (!$cart) {
            $cart = Cart::create(['user_id' => $user->id]);
        }

        // Trouver le produit par son ID
        $product = Product::find($productId);
        if (!$product) {
            // Si le produit n'existe pas, rediriger avec un message d'erreur
            return redirect()->route('cart.index')->with('error', 'Produit introuvable.');
        }

        // Vérifier si le produit existe déjà dans le panier
        $existingProduct = $cart->products()->where('product_id', $productId)->first();

        if ($existingProduct) {
            // Si le produit existe déjà, mettre à jour la quantité
            $cart->products()->updateExistingPivot($productId, [
                'quantity' => $existingProduct->pivot->quantity + 1,
            ]);
        } else {
            // Si le produit n'existe pas, l'ajouter au panier
            $cart->products()->attach($productId, [
                'quantity' => 1,
                'price' => $product->price,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Produit ajouté au panier');
    }

    /**
     * Supprimer un produit du panier.
     */
    public function removeProduct($productId)
    {
        // Vérifier si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect()->route('home'); // Redirige vers la page d'accueil si l'utilisateur n'est pas connecté
        }

        // Récupérer le panier de l'utilisateur
        $cart = Auth::user()->cart;

        // Supprimer le produit du panier
        $cart->products()->detach($productId);

        return redirect()->route('cart.index')->with('success', 'Produit retiré du panier');
    }

    /**
     * Vider le panier.
     */
    public function clearCart()
    {
        // Vérifier si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect()->route('home'); // Redirige vers la page d'accueil si l'utilisateur n'est pas connecté
        }

        // Récupérer le panier de l'utilisateur
        $cart = Auth::user()->cart;

        // Supprimer tous les produits du panier
        $cart->products()->detach();

        return redirect()->route('cart.index')->with('success', 'Panier vidé');
    }
}
