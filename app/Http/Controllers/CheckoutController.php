<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cart;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{

    /**
     * Afficher la page de checkout avec les informations du panier.
     */
    public function index()
{
    // Vérifie si l'utilisateur est connecté
    if (!Auth::check()) {
        return redirect()->route('login'); // Redirige vers la page de connexion
    }

    // Récupère le panier de l'utilisateur avec les plateformes
    $cart = Auth::user()->cart->load('products.platforms');

    // Vérifie si le panier est vide
    if (!$cart || $cart->products->isEmpty()) {
        return redirect()->route('cart.index')->with('error', 'Votre panier est vide.');
    }

    // Calcule le total
    $total = $cart->products->sum(function ($product) {
        return $product->pivot->quantity * $product->pivot->price;
    });

    // Retourne la vue du checkout
    return view('checkout.index', compact('cart', 'total'));
}

public function chooseAddress()
{
    $user = auth()->user();
    $addresses = $user->addresses; // Récupérer toutes les adresses de l'utilisateur

    return view('checkout.choose_address', compact('addresses'));
}

public function storeAddress(Request $request)
{
    if ($request->address_id === "new") {
        // Validation des champs pour une nouvelle adresse
        $request->validate([
            'street_number' => 'required|string|max:10',
            'street_name' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'postal_code' => 'required|numeric|digits:5',
        ]);

        // Créer la nouvelle adresse
        $newAddress = Address::create([
            'street_number' => $request->street_number,
            'street_name' => $request->street_name,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
        ]);

        // Associer cette adresse à l'utilisateur
        Auth::user()->addresses()->attach($newAddress->id);

        // Enregistrer l'ID de la nouvelle adresse en session
        session(['checkout_address_id' => $newAddress->id]);

        Log::info('Nouvelle adresse enregistrée et sélectionnée : ' . $newAddress->id);
    } else {
        // Validation si une adresse existante est choisie
        $request->validate([
            'address_id' => 'required|exists:addresses,id',
        ]);

        // Stocker l'adresse existante en session
        session(['checkout_address_id' => $request->address_id]);

        Log::info('Adresse existante sélectionnée : ' . $request->address_id);
    }

    return redirect()->route('payment.show')->with('success', 'Adresse sélectionnée.');
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
