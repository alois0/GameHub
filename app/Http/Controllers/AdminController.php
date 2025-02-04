<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Category;
use App\Models\Product;
use App\Models\Platform;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
{
    if (Auth::check()) {
        $users = User::all();
        $orders = Order::all();
        $categories = Category::all();
        $products = Product::with('categories')->get();
        $platforms = Platform::all(); 

        return view('admin.dashboard', compact('users', 'orders', 'categories', 'products', 'platforms'));
    } else {
        return redirect()->route('login');
    }
}




    public function showOrder($orderId)
    {
        // Trouver la commande spécifique avec les détails associés
        $order = Order::with('orderDetails.product')->findOrFail($orderId);
    
        // Passer les données à la vue
        return view('admin.orders.show', compact('order'));
    }


    public function updateOrderStatus(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);
        $order->status = $request->input('status');
        $order->save();

        return redirect()->route('admin.orders.show', $orderId)->with('success', 'Statut de la commande mis à jour avec succès.');
    }



}
