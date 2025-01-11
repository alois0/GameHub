<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Afficher le formulaire de paiement
     */
    public function show()
    {
        // Récupérer le panier de l'utilisateur et calculer le montant total
        $cart = Auth::user()->cart;
        $totalPrice = $cart->products->sum(function($product) {
            return $product->pivot->price * $product->pivot->quantity;
        });
    
        // Créer un PaymentIntent avec le montant total du panier
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
    
        $paymentIntent = PaymentIntent::create([
            'amount' => $totalPrice * 100, // Montant en centimes
            'currency' => 'eur',
        ]);
    
        return view('payment.show', [
            'totalPrice' => $totalPrice,
            'clientSecret' => $paymentIntent->client_secret, // Envoyer le client_secret à la vue
            'stripePublicKey' => env('STRIPE_PUBLIC_KEY') // Passer la clé publique
        ]);
    }
    

    /**
     * Créer un PaymentIntent avec Stripe
     */
    public function process(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        // Créer un PaymentIntent avec le montant envoyé
        $paymentIntent = PaymentIntent::create([
            'amount' => $request->amount * 100, // Montant en centimes
            'currency' => 'eur',
        ]);

        return response()->json(['client_secret' => $paymentIntent->client_secret]);
    }
}
