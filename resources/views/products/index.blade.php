<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produits - GameHub</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Classe personnalisée pour le cadre de l'image */
        .image-frame {
            width: 300px;
            height: 200px;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Classe personnalisée pour l'image */
        .image-frame img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Pour s'assurer que l'image s'adapte bien à la taille définie */
        }
    </style>
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

    <!-- Contenu des produits -->
    <div class="container mx-auto mt-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Tous les Produits</h1>

        <div class="grid grid-cols-3 gap-6">
            @foreach($products as $product)
                <div class="bg-white shadow-lg rounded-lg p-4">
                    <div class="image-frame">
                        <img src="{{ asset('image/' . $product->image_path) }}" alt="{{ $product->product_name }}">
                    </div>
                    <h3 class="font-semibold text-xl">{{ $product->product_name }}</h3>
                   
                    <p class="text-gray-600 font-bold">{{ number_format($product->price, 2) }} €</p>
                    
                    <!-- Affichage des catégories -->
                    <p class="text-gray-500">
                        Catégories :
                        {{ $product->categories->pluck('category_name')->join(', ') }}
                    </p>

                    <!-- Affichage des plateformes -->
                    <p class="text-gray-500">
                        Plateformes :
                        {{ $product->platforms->pluck('name')->join(', ') }}
                    </p>

                    <!-- Bouton pour accéder à la page détail -->
                    <a href="{{ route('products.show', $product->id) }}" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded-md shadow-md hover:bg-blue-600 inline-block">
                        Voir le produit
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>