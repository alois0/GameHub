<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index()
    {
        try {
            // Récupération des commandes avec leurs relations, triées par date de création
            $orders = Order::with([
                'user',
                'orderDetails.product',
                'orderDetails.platform',
                'orderDetails.address'
            ])
            ->orderBy('created_at', 'desc')
            ->paginate(10); // Ajout de la pagination

            return view('admin.orders.index', compact('orders'));
        } catch (\Exception $e) {
            return back()->with('error', 'Une erreur est survenue lors de la récupération des commandes.');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:Pending,Processing,Shipped,Delivered,Canceled',
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->input('status');
        $order->save();

        return redirect()->route('admin.orders.index')->with('success', 'Order updated successfully.');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.orders.index')->with('success', 'Order deleted successfully.');
    }
}