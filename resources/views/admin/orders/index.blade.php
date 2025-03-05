<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Détails de la Commande</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    
    <!-- Navigation -->
    <nav class="bg-gray-900 text-white py-4 px-8 flex justify-between items-center">
        <div class="text-xl font-bold">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-green-500">Admin</a>
        </div>
        <ul class="flex gap-4">
            @auth
                <li>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="hover:text-green-500">Déconnexion</button>
                    </form>
                </li>
            @else
                <li><a href="{{ route('login') }}" class="hover:text-green-500">Connexion</a></li>
            @endauth
        </ul>
    </nav>

    <!-- Détails de la Commande -->
    <div class="container mx-auto mt-8 p-6 max-w-4xl bg-white shadow-lg rounded-lg">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Commande #{{ $order->id }}</h1>

        <p class="text-gray-600"><strong>Date :</strong> {{ $order->order_date }}</p>
        <p class="text-gray-600"><strong>Statut :</strong> {{ $order->status }}</p>
        <p class="text-gray-800 font-bold text-lg mt-2"><strong>Total :</strong> {{ number_format($order->total_price, 2) }} €</p>

        <!-- Adresse de facturation -->
        @if($order->orderDetails->first() && $order->orderDetails->first()->address)
            <div class="mt-4 bg-gray-100 p-4 rounded-lg">
                <p class="text-gray-700 font-semibold">Adresse de facturation :</p>
                <p class="text-gray-600">
                    {{ $order->orderDetails->first()->address->street_number }} 
                    {{ $order->orderDetails->first()->address->street_name }},
                    {{ $order->orderDetails->first()->address->city }},
                    {{ $order->orderDetails->first()->address->postal_code }}
                </p>
            </div>
        @endif

        <!-- Détails des produits -->
        <h2 class="text-xl font-semibold mt-6">Produits commandés :</h2>
        <div class="overflow-x-auto mt-4">
            <table class="min-w-full bg-white border rounded-lg shadow-md">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2 text-left">Produit</th>
                        <th class="px-4 py-2 text-left">Plateforme</th>
                        <th class="px-4 py-2 text-left">Quantité</th>
                        <th class="px-4 py-2 text-left">Prix Unitaire</th>
                        <th class="px-4 py-2 text-left">Sous-total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->orderDetails as $orderDetail)
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ $orderDetail->product->product_name }}</td>
                            <td class="px-4 py-2">
                                @php
                                    $platformName = \App\Models\Platform::find($orderDetail->platform_id)->name ?? 'Non spécifié';
                                @endphp
                                {{ $platformName }}
                            </td>
                            <td class="px-4 py-2">{{ $orderDetail->quantity }}</td>
                            <td class="px-4 py-2">{{ number_format($orderDetail->price_each, 2) }} €</td>
                            <td class="px-4 py-2">{{ number_format($orderDetail->price_each * $orderDetail->quantity, 2) }} €</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Formulaire pour changer le statut de la commande -->
        <h2 class="text-xl font-semibold mt-6">Modifier le statut de la commande :</h2>
        <form method="POST" action="{{ route('admin.orders.updateStatus', $order->id) }}" class="mt-4 bg-gray-100 p-4 rounded-lg">
            @csrf
            <label for="status" class="block text-gray-700 font-bold mb-2">Statut :</label>
            <select name="status" id="status" class="block w-full bg-white border border-gray-300 rounded py-2 px-4 mb-4">
                <option value="Pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Processing" {{ $order->status == 'Processing' ? 'selected' : '' }}>Processing</option>
                <option value="Shipped" {{ $order->status == 'Shipped' ? 'selected' : '' }}>Shipped</option>
                <option value="Delivered" {{ $order->status == 'Delivered' ? 'selected' : '' }}>Delivered</option>
            </select>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-all">
                Mettre à jour
            </button>
        </form>
    </div>

</body>
</html>
