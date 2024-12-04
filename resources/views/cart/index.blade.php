<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier - GameHub</title>
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

    <!-- Contenu du panier -->
    <div class="container mx-auto mt-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Votre Panier</h1>

        @if($cart->products->count() > 0)
            <div class="overflow-x-auto bg-white shadow-lg rounded-lg p-4">
                <table class="min-w-full table-auto">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left">Produit</th>
                            <th class="px-4 py-2 text-left">Quantité</th>
                            <th class="px-4 py-2 text-left">Prix Unitaire</th>
                            <th class="px-4 py-2 text-left">Total</th>
                            <th class="px-4 py-2 text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart->products as $product)
                            <tr>
                                <td class="px-4 py-2">{{ $product->product_name }}</td>
                                <td class="px-4 py-2">{{ $product->pivot->quantity }}</td>
                                <td class="px-4 py-2">{{ number_format($product->pivot->price, 2) }} €</td>
                                <td class="px-4 py-2">{{ number_format($product->pivot->price * $product->pivot->quantity, 2) }} €</td>
                                <td class="px-4 py-2">
                                    <!-- Bouton pour supprimer le produit du panier -->
                                    
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Affichage du total -->
                <div class="mt-4 text-right">
                    <strong>Total : </strong>
                    <span class="text-xl font-bold">{{ number_format($cart->products->sum(function ($product) {
                        return $product->pivot->price * $product->pivot->quantity;
                    }), 2) }} €</span>
                </div>

                <!-- Vider le panier -->
                <div class="mt-4 text-center">
                    <form action="{{ route('cart.clear') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">Vider le Panier</button>
                    </form>
                </div>
            </div>
        @else
            <p class="text-center text-gray-700">Votre panier est vide.</p>
        @endif
    </div>
</body>
</html>
