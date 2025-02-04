<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Commandes - GameHub</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-gray-900 text-white py-4 px-8 flex justify-between items-center">
        <div class="text-xl font-bold">
            <a href="/" class="hover:text-green-500">GameHub</a>
        </div>
        <ul class="flex gap-4">
            @auth
                <li><a href="{{ route('profile.edit') }}" class="hover:text-green-500">Profil</a></li>
                <li><a href="{{ route('cart.index') }}" class="hover:text-green-500">Panier</a></li>
                <li><a href="{{ route('orders.index') }}" class="hover:text-green-500">Commandes</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="hover:text-green-500">Déconnexion</button>
                    </form>
                </li>
            @else
                <li><a href="{{ route('login') }}" class="hover:text-green-500">Connexion</a></li>
                <li><a href="{{ route('register') }}" class="hover:text-green-500">Inscription</a></li>
            @endauth
        </ul>
    </nav>

    <!-- Mes Commandes -->
    <div class="container mx-auto mt-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Mes Commandes</h1>

        @if($orders->count() > 0)
            @foreach($orders as $order)
                <div class="bg-white shadow-lg rounded-lg p-6 mb-4">
                    <h3 class="font-semibold text-xl">Commande #{{ $order->id }}</h3>
                    <p class="text-gray-600">Date : {{ \Carbon\Carbon::parse($order->order_date)->format('d/m/Y H:i') }}</p>

                    <!-- Affichage du statut avec des couleurs -->
                    @php
                        $statusColors = [
                            'Pending' => 'bg-yellow-200 text-yellow-800',
                            'Processing' => 'bg-blue-200 text-blue-800',
                            'Shipped' => 'bg-indigo-200 text-indigo-800',
                            'Delivered' => 'bg-green-200 text-green-800',
                            'Canceled' => 'bg-red-200 text-red-800'
                        ];
                    @endphp
                    <p class="inline-block px-3 py-1 rounded-lg font-semibold {{ $statusColors[$order->status] ?? 'bg-gray-200 text-gray-800' }}">
                        {{ ucfirst($order->status) }}
                    </p>

                    <p class="text-gray-600 font-bold">Total : {{ number_format($order->total_price, 2) }} €</p>

                    <div class="mt-4">
                        <a href="{{ route('orders.show', $order->id) }}" class="text-blue-500 hover:text-blue-700 font-semibold">
                            Voir les détails
                        </a>
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-center text-gray-600 mt-6">Vous n'avez passé aucune commande.</p>
        @endif
    </div>
</body>
</html>
