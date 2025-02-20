<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la Commande - GameHub</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">
    
    <!-- Navigation -->
    @include('components.nav')

    <!-- Définition des couleurs pour le statut -->
    @php
        $statusColors = [
            'Pending' => 'bg-yellow-200 text-yellow-800',
            'Processing' => 'bg-blue-200 text-blue-800',
            'Shipped' => 'bg-indigo-200 text-indigo-800',
            'Delivered' => 'bg-green-200 text-green-800',
            'Canceled' => 'bg-red-200 text-red-800'
        ];
    @endphp

    <!-- Contenu principal -->
    <main class="flex-grow">
        <div class="container mx-auto mt-8 p-6 max-w-4xl bg-white shadow-lg rounded-lg">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Commande #{{ $order->id }}</h1>

            <p class="text-gray-600"><strong>Date :</strong> {{ $order->order_date }}</p>
            
            <!-- Affichage du statut avec badge coloré -->
            <p class="text-gray-600">
                <strong>Statut :</strong> 
                <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $statusColors[$order->status] ?? 'bg-gray-200 text-gray-800' }}">
                    {{ ucfirst($order->status) }}
                </span>
            </p>

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
                                    {{ optional($orderDetail->platform)->name ?? 'Non spécifié' }}
                                </td>
                                <td class="px-4 py-2">{{ $orderDetail->quantity }}</td>
                                <td class="px-4 py-2">{{ number_format($orderDetail->price_each, 2) }} €</td>
                                <td class="px-4 py-2">{{ number_format($orderDetail->price_each * $orderDetail->quantity, 2) }} €</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Ajout de l'espace avant le footer -->
        <div class="h-32"></div>
    </main>

    <!-- Footer bien en bas -->
    @include('components.footer')

</body>



</html>
