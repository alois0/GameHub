<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{

    /**
     * Afficher la page de checkout avec les informations du panier.
     */
    public function index()
    {
        // Vérifie si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect()->route('login'); // Redirige vers la page de connexion si l'utilisateur n'est pas connecté
        }

        // Récupère le panier de l'utilisateur
        $cart = Auth::user()->cart;

        // Vérifie si le panier existe
        if (!$cart) {
            return redirect()->route('cart.index')->with('error', 'Votre panier est vide.');
        }

        // Calcule le total du panier
        $total = $cart->products->sum(function ($product) {
            return $product->pivot->quantity * $product->pivot->price;
        });

        // Retourne la vue de checkout avec les données du panier
        return view('checkout.index', compact('cart', 'total'));
    }





    public function store(Request $request)
    {
        $user = Auth::user();
        $cart = $user->cart;

        // Créer une nouvelle commande
        $order = Order::create([
            'user_id' => $user->id,
            'total_price' => $cart->products->sum(fn($product) => $product->pivot->price * $product->pivot->quantity),
            'status' => 'Pending', // Statut de la commande
        ]);

        // Ajouter les produits du panier à la commande
        foreach ($cart->products as $product) {
            $order->orderDetails()->create([
                'product_id' => $product->id,
                'quantity' => $product->pivot->quantity,
                'price_each' => $product->pivot->price,
            ]);
        }

        // Vider le panier après la commande
        $cart->products()->detach();

        // Rediriger vers une page de confirmation ou afficher un message de succès
        return redirect()->route('home')->with('success', 'Commande passée avec succès');
    }
}
