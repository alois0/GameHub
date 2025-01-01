<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - GameHub</title>
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

    <!-- Checkout Section -->
    <div class="container mx-auto mt-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Résumé du Panier</h1>

        <!-- Affichage du panier -->
        <div class="bg-white shadow-lg rounded-lg p-4">
            <h2 class="text-xl font-semibold text-gray-800">Produits dans votre Panier</h2>

            @if($cart->products->count() > 0)
                <table class="table-auto w-full mt-4">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left">Produit</th>
                            <th class="px-4 py-2 text-left">Quantité</th>
                            <th class="px-4 py-2 text-left">Prix</th>
                            <th class="px-4 py-2 text-left">Sous-total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart->products as $product)
                            <tr class="border-b">
                                <td class="px-4 py-2">{{ $product->product_name }}</td>
                                <td class="px-4 py-2">{{ $product->pivot->quantity }}</td>
                                <td class="px-4 py-2">{{ number_format($product->pivot->price, 2) }} €</td>
                                <td class="px-4 py-2">{{ number_format($product->pivot->price * $product->pivot->quantity, 2) }} €</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="text-right mt-4">
                    <h3 class="text-xl font-bold text-gray-800">
                        Total : {{ number_format($cart->products->sum(fn($product) => $product->pivot->price * $product->pivot->quantity), 2) }} €
                    </h3>
                </div>
            @else
                <p class="text-gray-600">Votre panier est vide.</p>
            @endif
        </div>

        <!-- Formulaire de commande -->
        <div class="bg-white shadow-lg rounded-lg p-4 mt-6">
            <h2 class="text-xl font-semibold text-gray-800">Détails de la Commande</h2>

            <form action="{{ route('checkout.store') }}" method="POST">
    @csrf
    <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">Passer la Commande</button>
</form>

        </div>
    </div>
</body>
</html>
