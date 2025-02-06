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
        if (!Auth::check()) {
            return redirect()->route('home');
        }
    
        $cart = Auth::user()->cart->load(['products.platforms']); // Charger les plateformes via la relation 'platforms'
    

        


        return view('cart.index', compact('cart'));
    }
    
    
    

    /**
     * Ajouter un produit au panier.
     */
    public function addProduct(Request $request, $productId)
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
            return redirect()->route('cart.index')->with('error', 'Produit introuvable.');
        }
    
        // Valider la plateforme choisie
        $validated = $request->validate([
            'platform' => 'required|exists:platform,id', // Vérifie que la plateforme existe dans `platforms`
        ]);
        $platformId = $validated['platform'];
    
        // Vérifier que la plateforme est bien liée au produit via `product_platform`
        $isValidPlatform = $product->platforms->contains('id', $platformId);
        if (!$isValidPlatform) {
            return redirect()->route('cart.index')->with('error', 'Cette plateforme n\'est pas disponible pour ce produit.');
        }
    
        // Vérifier si le produit avec la même plateforme existe déjà dans le panier
        $existingProduct = $cart->products()
            ->where('product_id', $productId)
            ->wherePivot('platform_id', $platformId) // Utiliser `platform_id` dans la relation pivot
            ->first();
    
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
                'platform_id' => $platformId, // Stocker la plateforme sélectionnée
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
    
    /**
     * Mettre à jour la quantité d'un produit dans le panier.
     */

    public function update(Request $request, $productId)
    {
        // Vérifier si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect()->route('home'); // Redirige vers la page d'accueil si l'utilisateur n'est pas connecté
        }

        // Récupérer le panier de l'utilisateur
        $cart = Auth::user()->cart;

        // Valider la quantité
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1', // La quantité doit être un entier positif
        ]);
        $quantity = $validated['quantity'];

        // Mettre à jour la quantité du produit dans le panier
        $cart->products()->updateExistingPivot($productId, [
            'quantity' => $quantity,
        ]);

        return redirect()->route('cart.index')->with('success', 'Quantité mise à jour');
    }
    
}
