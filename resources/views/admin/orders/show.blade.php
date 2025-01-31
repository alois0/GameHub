<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .fixed-header thead th {
            position: sticky;
            top: 0;
            background-color: white;
            z-index: 1;
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-gray-900 text-white py-4 px-8 flex justify-between items-center">
        <div class="text-xl font-bold">
            <a href="/admin/dashboard" class="hover:text-green-500">Admin</a>
        </div>
        <ul class="flex gap-4">
            @auth
                <li>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="hover:text-green-500">Logout</button>
                    </form>
                </li>
            @else
                <li>
                    <a href="{{ route('login') }}" class="hover:text-green-500">Login</a>
                </li>
                <li>
                    <a href="{{ route('register') }}" class="hover:text-green-500">Register</a>
                </li>
            @endauth
        </ul>
    </nav>










<!-- Détails de la Commande -->
    <div class="container mx-auto mt-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Détails de la Commande #{{ $order->id }}</h1>

        <p class="text-gray-600">Date : {{ $order->order_date }}</p>
        <p class="text-gray-600">Statut : {{ $order->status }}</p>
        <p class="text-gray-600 font-bold">Total : {{ number_format($order->total_price, 2) }} €</p>

        <h4 class="mt-4 font-semibold">Détails des Produits :</h4>
        <table class="min-w-full table-auto mt-2">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left">Produit</th>
                    <th class="px-4 py-2 text-left">Quantité</th>
                    <th class="px-4 py-2 text-left">Prix Unitaire</th>
                    <th class="px-4 py-2 text-left">Sous-total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->orderDetails as $orderDetail)
                    <tr>
                        <td class="px-4 py-2">{{ $orderDetail->product->product_name }}</td>
                        <td class="px-4 py-2">{{ $orderDetail->quantity }}</td>
                        <td class="px-4 py-2">{{ number_format($orderDetail->price_each, 2) }} €</td>
                        <td class="px-4 py-2">{{ number_format($orderDetail->price_each * $orderDetail->quantity, 2) }} €</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>



    <!-- Formulaire pour changer le statut de la commande -->
    <div class="container mx-auto mt-8">
            <form method="POST" action="{{ route('admin.orders.updateStatus', $order->id) }}">
                @csrf
                <label for="status" class="block text-gray-700 font-bold mb-2">Changer le statut de la commande :</label>
                <select name="status" id="status" class="block w-full bg-white border border-gray-300 rounded py-2 px-4 mb-4">
                    <option value="Pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Processing" {{ $order->status == 'Processing' ? 'selected' : '' }}>Processing</option>
                    <option value="Shipped" {{ $order->status == 'Shipped' ? 'selected' : '' }}>Shipped</option>
                    <option value="Delivered" {{ $order->status == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                </select>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Mettre à jour</button>
            </form>
        </div>
</body>
</html>
