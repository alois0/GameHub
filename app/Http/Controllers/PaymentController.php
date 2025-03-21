<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use App\Models\Order;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use App\Notifications\OrderConfirmedNotification;
use App\Mail\SendCodes; // Import the SendCodes Mailable class

class PaymentController extends Controller
{
    /**
     * Affiche le formulaire de paiement
     */
    public function show()
    {
        // Récupérer le panier de l'utilisateur et calculer le montant total
        $cart = Auth::user()->cart;
        $totalPrice = $cart->products->sum(function($product) {
            return $product->pivot->price * $product->pivot->quantity;
        });

        // Créer un PaymentIntent pour le paiement
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        $paymentIntent = PaymentIntent::create([
            'amount' => $totalPrice * 100, // Montant en centimes
            'currency' => 'eur',
            'metadata' => [
                'user_id' => Auth::id(), // Associe l'utilisateur
            ],
        ]);

        // Passer les données à la vue
        return view('payment.show', [
            'totalPrice' => $totalPrice,
            'stripePublicKey' => env('STRIPE_PUBLIC_KEY'),
            'clientSecret' => $paymentIntent->client_secret,
        ]);
    }

    /**
     * Traitement du paiement et création de la commande
     */
    public function process(Request $request)
{
    Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

    try {
        // Récupérer l'ID du PaymentIntent depuis la requête
        $paymentIntentId = $request->input('paymentIntentId');
        $paymentIntent = \Stripe\PaymentIntent::retrieve($paymentIntentId);

        // Vérifiez si le paiement est réussi
        if ($paymentIntent->status === 'succeeded') {
            Log::info('Paiement réussi pour PaymentIntent ID : ' . $paymentIntentId);

            // Récupérer l'utilisateur et son panier
            $user = Auth::user();
            $cart = $user->cart;

            if (!$cart) {
                Log::error('Aucun panier trouvé pour l\'utilisateur ID : ' . $user->id);
                return response()->json(['success' => false, 'message' => 'Erreur : Aucun panier trouvé.']);
            }

            $addressId = session('checkout_address_id');

            if (!$addressId) {
                Log::error('Aucune adresse enregistrée en session.');
                return response()->json(['success' => false, 'message' => 'Erreur : Aucune adresse sélectionnée.']);
            }
            
            Log::info('Adresse récupérée pour la commande : ' . $addressId);
            

            // Calculer le total du panier
            $totalPrice = $cart->products->sum(function ($product) {
                return $product->pivot->price * $product->pivot->quantity;
            });

            Log::info('Total du panier calculé : ' . $totalPrice);

            // Créer une nouvelle commande
            $order = Order::create([
                'user_id' => $user->id,
                'total_price' => $totalPrice,
                'status' => 'Pending', // Marquer la commande comme terminée
            ]);

            Log::info('Commande créée avec ID : ' . $order->id);

            // Ajouter les produits du panier à la commande
            foreach ($cart->products as $product) {
                $order->orderDetails()->create([
                    'product_id' => $product->id,
                    'platform_id' => $product->pivot->platform_id, // Ajouter la plateform
                    'quantity' => $product->pivot->quantity,
                    'price_each' => $product->pivot->price,
                    'address_id' => $addressId, // Associer l'adresse ici

                ]);
            }

            Log::info('Produits ajoutés à la commande ID : ' . $order->id);

            Log::info('📧 Envoi immédiat de l’email de confirmation à : ' . $user->email);
            Notification::sendNow($user, new OrderConfirmedNotification($order));


            Log::info('✅ Email envoyé.');


            // $codes = [];
            // for ($i = 0; $i < 12; $i++) {
            //     $codes[] = strtoupper(bin2hex(random_bytes(12)));
            // }
            // Mail::to(users: $user->email)->send(new SendCodes($order, $codes)); // Ensure $user->email is used correctly
            // // Mail::to($order->user_id->email)->send(new SendCodes($order, $codes));

            // Vider le panier
            $cart->products()->detach();
            Log::info('Panier vidé pour l\'utilisateur ID : ' . $user->id);

            // Supprimer l'adresse de la session après utilisation
            session()->forget('checkout_address_id');

            
            

            return response()->json(['success' => true, 'message' => 'Commande créée avec succès.']);
        } else {
            Log::warning('Paiement non réussi pour PaymentIntent ID : ' . $paymentIntentId);
            return response()->json(['success' => false, 'message' => 'Paiement non confirmé.']);
        }
    } catch (\Exception $e) {
        Log::error('Erreur lors du traitement du paiement : ' . $e->getMessage());
        return response()->json(['success' => false, 'message' => 'Erreur lors du traitement du paiement.']);
    }
}

}
