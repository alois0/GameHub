<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Afficher toutes les commandes de l'utilisateur connecté.
     */
    public function index()
    {

        
        // Récupérer les commandes de l'utilisateur connecté avec les détails des produits associés
        $orders = Auth::user()->orders()->with('orderDetails.product')->get();

        // Vérification : afficher les commandes dans la console pour débogage
          // Retirer ce dd() après avoir vérifié les données

        // Retourner la vue avec les commandes
        return view('orders.index', compact('orders'));
    }

    /**
     * Annuler une commande.
     */
    public function cancel($orderId)
    {
        // Trouver la commande par son ID
        $order = Order::findOrFail($orderId);

        // Vérifier que l'utilisateur connecté est bien celui qui a passé la commande
        if ($order->user_id != Auth::id()) {
            return redirect()->route('orders.index')->with('error', 'Vous ne pouvez pas annuler cette commande.');
        }

        // Annuler la commande
        $order->status = 'Canceled';
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Commande annulée avec succès.');
    }

    public function show($orderId)
{
    // Trouver la commande spécifique avec les détails associés
    $order = Order::with('orderDetails.product')->findOrFail($orderId);

    // Passer les données à la vue
    return view('orders.show', compact('order'));
}
}
