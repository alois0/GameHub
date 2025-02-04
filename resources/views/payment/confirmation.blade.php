<!-- resources/views/confirmation.blade.php -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation - GameHub</title>
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

    <!-- Contenu de la confirmation -->
    <div class="container mx-auto mt-12 max-w-lg">
        <div class="bg-white shadow-lg rounded-lg p-6 text-center">
            <!-- Icône de succès -->
            <div class="flex justify-center">
                <svg class="w-16 h-16 text-green-500 animate-bounce" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>

            <h1 class="text-3xl font-bold text-gray-800 mt-4">Merci pour votre commande !</h1>
            <p class="text-lg text-gray-600 mt-2">Votre paiement a été effectué avec succès.</p>
            <p class="text-gray-600">Vous recevrez bientôt un email de confirmation avec les détails de votre commande.</p>

            <!-- Boutons d'action -->
            <div class="mt-6 flex flex-col space-y-4">
                <a href="{{ route('orders.index') }}" class="bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600 transition-all">
                    Voir mes commandes
                </a>
                <a href="/" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition-all">
                    Retour à l'accueil
                </a>
            </div>
        </div>
    </div>

</body>
</html>
