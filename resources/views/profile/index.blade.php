<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil - GameHub</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    
    <!-- Navigation -->
    @include('components.nav')

    

    <!-- Profil de l'utilisateur -->
    <div class="container mx-auto mt-8 p-6 max-w-4xl bg-white shadow-lg rounded-lg">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Mon Profil</h1>

        <!-- Informations de l'utilisateur -->
        <div class="flex items-center space-x-4">
            
            <div>
                <p class="text-xl font-semibold">{{ Auth::user()->name }}</p>
                <p class="text-gray-600">{{ Auth::user()->email }}</p>
            </div>

            <!-- Bouton Modifier Profil -->
            <div class="mt-6 text-right ml-auto">
                <a href="{{ route('profile.edit') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                    Modifier mon profil
                </a>
            </div>
        </div>

        <!-- Adresse par défaut -->
        <h2 class="text-xl font-semibold mt-6">Adresse par défaut</h2>
        @if($defaultAddress)
            <div class="mt-4 p-4 bg-gray-200 rounded-lg">
                <p><strong>Rue :</strong> {{ $defaultAddress->street_name }}, {{ $defaultAddress->street_number }}</p>
                <p><strong>Ville :</strong> {{ $defaultAddress->city }}</p>
                <p><strong>Code Postal :</strong> {{ $defaultAddress->postal_code }}</p>
            </div>
        @else
            <p class="text-gray-600 mt-2">Aucune adresse par défaut définie.</p>
        @endif

        <!-- Historique des 3 dernières commandes -->
        <h2 class="text-xl font-semibold mt-6">Mes 3 dernières commandes</h2>
        @if($latestOrders->count() > 0)
            <div class="overflow-x-auto mt-4">
                <table class="min-w-full bg-white border rounded-lg shadow-md">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2 text-left">Commande</th>
                            <th class="px-4 py-2 text-left">Date</th>
                            <th class="px-4 py-2 text-left">Total</th>
                            <th class="px-4 py-2 text-left">Statut</th>
                            <th class="px-4 py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($latestOrders as $order)
                            <tr class="border-b">
                                <td class="px-4 py-2">#{{ $order->id }}</td>
                                <td class="px-4 py-2">{{ $order->order_date }}</td>
                                <td class="px-4 py-2">{{ number_format($order->total_price, 2) }} €</td>
                                <td class="px-4 py-2">
                                    <span class="px-3 py-1 rounded-full text-sm font-semibold bg-gray-200 text-gray-800">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-2">
                                    <a href="{{ route('orders.show', $order->id) }}" class="text-blue-500 hover:underline">Détails</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Bouton Voir Plus -->
            <div class="mt-4 text-right">
                <a href="{{ route('orders.index') }}" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                    Voir plus
                </a>
            </div>
        @else
            <p class="text-gray-600 mt-2">Aucune commande récente.</p>
        @endif
    </div>

    <div class="h-32"></div>

    @include('components.footer')
</body>

</html>
