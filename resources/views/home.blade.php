<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - GameHub</title>
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
                <li><li><a href="{{ route('products.index') }}" class="hover:text-green-500">Produits</a></li> <!-- Lien ajouté pour produits -->
                <a href="{{ route('profile.edit') }}" class="hover:text-green-500">Profile</a>
                <a href="{{ route('cart.index') }}" class="hover:text-green-500">Panier</a>
                <li><a href="{{ route('orders.index') }}" class="hover:text-green-500">Commandes</a></li>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="hover:text-green-500">Déconnexion</button>
                    </form>
                </li>
            @else
                <li>
                    <a href="{{ route('login') }}" class="hover:text-green-500">Se connecter</a>
                </li>
                <li>
                    <a href="{{ route('register') }}" class="hover:text-green-500">Créer un compte</a>
                </li>
            @endauth
        </ul>
    </nav>

    <!-- Hero Section -->
    <div class="min-h-screen flex items-center justify-center bg-gray-800 text-white">
        <div class="text-center px-8">
            <h1 class="text-4xl font-bold mb-4">Bienvenue sur GameHub</h1>
            <p class="text-lg mb-6">Votre destination ultime pour les tendances de jeux vidéo</p>
        </div>
    </div>
    
    
    
</body>
</html>
