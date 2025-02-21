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
    @include('components.nav')


    

    <!-- Contenu du panier -->
    <div class="container mx-auto mt-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Votre Panier</h1>

        @if($cart->products->count() > 0)
            <div class="overflow-x-auto bg-white shadow-lg rounded-lg p-4">
                <table class="min-w-full table-auto">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2 text-left">Produit</th>
                            <th class="px-4 py-2 text-left">Plateforme</th>
                            <th class="px-4 py-2 text-left">Quantité</th>
                            <th class="px-4 py-2 text-left">Prix Unitaire</th>
                            <th class="px-4 py-2 text-left">Total</th>
                            <th class="px-4 py-2 text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart->products as $product)
                            <tr class="border-b">
                                <td class="px-4 py-2">{{ $product->product_name }}</td>

                                <!-- Correction de l'affichage de la plateforme -->
                                <td class="px-4 py-2">
                                    {{ $product->platforms->where('id', $product->pivot->platform_id)->first()->name ?? 'Non spécifié' }}
                                </td>

                                <td class="px-4 py-2">
                                <form action="{{ route('cart.update', $product->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <input type="number" name="quantity" value="{{ $product->pivot->quantity }}" min="1" class="w-16 text-center">
                                    <button type="submit" class="px-2 py-1 bg-green-500 text-white rounded-md hover:bg-green-600">Modifier</button>
                                </form>
                            </td>
                                <td class="px-4 py-2">{{ number_format($product->pivot->price, 2) }} €</td>
                                <td class="px-4 py-2">{{ number_format($product->pivot->price * $product->pivot->quantity, 2) }} €</td>
                                <td class="px-4 py-2">
                                    <form action="{{ route('cart.remove', ['productId' => $product->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">
                                            Retirer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Affichage du total -->
                <div class="mt-4 text-right text-xl font-bold">
                    Total : 
                    <span class="text-gray-800">
                        {{ number_format($cart->products->sum(fn($product) => $product->pivot->price * $product->pivot->quantity), 2) }} €
                    </span>
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

    <!-- Boutons pour continuer -->
    <div class="mt-4 text-center">
        <a href="{{ route('checkout') }}" class="px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Passer à la caisse</a>
        <a href="{{ route('products.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Retourner aux Produits</a>
    </div>

    <div class="h-32"></div>

    @include('components.footer')


</body>
</html>
