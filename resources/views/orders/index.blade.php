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
                <li><a href="{{ route('profile.edit') }}" class="hover:text-green-500">Profile</a></li>
                <li><a href="{{ route('cart.index') }}" class="hover:text-green-500">Panier</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="hover:text-green-500">Logout</button>
                    </form>
                </li>
            @else
                <li><a href="{{ route('login') }}" class="hover:text-green-500">Login</a></li>
                <li><a href="{{ route('register') }}" class="hover:text-green-500">Register</a></li>
            @endauth
        </ul>
    </nav>

    <!-- Mes Commandes -->
    <div class="container mx-auto mt-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Mes Commandes</h1>

        @foreach($orders as $order)
            <div class="bg-white shadow-lg rounded-lg p-4 mb-4">
                <h3 class="font-semibold text-xl">Commande #{{ $order->id }}</h3>
                <p class="text-gray-600">Date : {{ $order->order_date }}</p>
                <p class="text-gray-600">Statut : {{ $order->status }}</p>
                <p class="text-gray-600 font-bold">Total : {{ number_format($order->total_price, 2) }} €</p>

                <div class="mt-4">
    <a href="{{ route('orders.show', $order->id) }}" class="text-blue-500 hover:text-blue-700">Voir les détails</a>
</div>
            </div>
        @endforeach
    </div>
</body>
</html>
