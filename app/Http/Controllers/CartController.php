<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
        Log::info('Panier récupéré pour l\'utilisateur ID : ' . Auth::id(), ['cart' => $cart]);

         // Calculer le total du panier
         $totalPrice = $cart->products->sum(function ($product) {
            return $product->pivot->price * $product->pivot->quantity;
        });
        Log::info('Total du panier pour l\'utilisateur ID : ' . Auth::id() . ' est de ' . $totalPrice);


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


        // Vérifier si le produit est en stock
        if ($product->stock_quantity <= 0) {
            session()->flash('error_add', 'Ce produit est en rupture de stock.');
            return back(); // Reste sur la même page sans redirection explicite
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

        // Décrémenter la quantité en stock
        $product->decrement('stock_quantity');
    
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

         // Trouver le produit dans le panier
        $product = $cart->products()->where('product_id', $productId)->first();


        if ($product) {
            // Récupérer la quantité actuelle dans le panier
            $quantityInCart = $product->pivot->quantity;
    
            // Augmenter la quantité en stock
            $product->increment('stock_quantity', $quantityInCart);
        }

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
     
         // Valider la quantité demandée
         $validated = $request->validate([
             'quantity' => 'required|integer|min:1', // La quantité doit être un entier positif
         ]);
         $newQuantity = $validated['quantity'];
     
         // Trouver le produit dans le panier
         $product = $cart->products()->where('product_id', $productId)->first();
     
         if (!$product) {
             return redirect()->route('cart.index')->with('error', 'Produit introuvable dans le panier.');
         }
     
         $currentQuantity = $product->pivot->quantity;
     
         // Vérifier si la quantité demandée dépasse le stock disponible
         if ($newQuantity > $product->stock_quantity) {
            return redirect()->route('cart.index')->with('error_update', 'Stock insuffisant pour cette quantité.');
        }
        
        
     
         // Calculer la différence de quantité demandée
         $difference = $newQuantity - $currentQuantity;
     
         // Ajuster le stock en conséquence
         if ($difference > 0) {
             $product->decrement('stock_quantity', $difference);
         } elseif ($difference < 0) {
             $product->increment('stock_quantity', abs($difference));
         }
     
         // Mettre à jour la quantité du produit dans le panier
         $cart->products()->updateExistingPivot($productId, [
             'quantity' => $newQuantity,
         ]);
     
         return redirect()->route('cart.index')->with('success', 'Quantité mise à jour');
     }
     
    
}
