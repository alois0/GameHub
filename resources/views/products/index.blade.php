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
            width: 100%;
            height: 300px;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto; /* Center the image frame */
            border-radius: 10px;
        }

        /* Classe personnalisée pour l'image */
        .image-frame img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Pour s'assurer que l'image s'adapte bien à la taille définie */
        }

        /* Center the button */
        .button-container {
            display: flex;
            justify-content: center;
            margin-top: 1rem;
        }

        /* Center the search bar */
        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .search-container {
            flex-grow: 1;
            display: flex;
            justify-content: center;
        }

        .search-container form {
            width: 100%;
            max-width: 500px;
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-gray-900 text-white py-4 px-8 flex justify-between items-center">
        <div class="flex items-center gap-10">
            <div class="text-xl font-bold">
                <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('image/LOgo.png') }}" alt="image"></a>
            </div>
            <form class="flex" role="search" action="{{ route('products.search') }}" method="GET">
                <input class="form-control me-2 px-4 py-2 rounded-l-md text-black" type="search" name="query" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success px-4 py-2 rounded-r-md" type="submit" style="background: linear-gradient(90deg, #289EB6 0%, #248E5E 100%); color: white;">Search</button>
            </form>
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
                    <h3 class="font-semibold text-xl text-center">{{ $product->product_name }}</h3>
                   
                    <p class="text-gray-600 font-bold text-center">{{ number_format($product->price, 2) }} €</p>
                    
                    <!-- Affichage des catégories -->
                    <p class="text-gray-500 text-center">
                        Catégories :
                        {{ $product->categories->pluck('category_name')->join(', ') }}
                    </p>

                    <!-- Affichage des plateformes -->
                    <p class="text-gray-500 text-center">
                        Plateformes :
                        {{ $product->platforms->pluck('name')->join(', ') }}
                    </p>

                    <!-- Bouton pour accéder à la page détail -->
                    <div class="button-container">
                        <a href="{{ route('products.show', $product->id) }}" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded-md shadow-md hover:bg-blue-600 inline-block">
                            Voir le produit
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-6 flex justify-center">
        {{ $products->links() }}
        </div>
    </div>

</body>
</html>