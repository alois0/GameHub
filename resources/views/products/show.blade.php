<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détail du Produit - GameHub</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Style pour la barre de défilement */
        #reviews-list::-webkit-scrollbar {
            width: 8px;
        }

        #reviews-list::-webkit-scrollbar-thumb {
            background-color: #888;
            border-radius: 4px;
        }

        #reviews-list::-webkit-scrollbar-thumb:hover {
            background-color: #555;
        }

        #reviews-list::-webkit-scrollbar-track {
            background: #f1f1f1;
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

    <!-- Contenu du produit -->
    <div class="container mx-auto mt-8">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h3 class="font-semibold text-xl">{{ $product->product_name }}</h3>
            <p class="text-gray-700">{{ $product->description }}</p>
            <p class="text-gray-600 font-bold">{{ number_format($product->price, 2) }} €</p>
            <p class="text-gray-500">Catégorie : {{ $product->category->category_name }}</p>
            <p>Disponible sur :</p>
<ul>
    @foreach($product->platforms as $platform)
        <li>{{ $platform->name }}</li>
    @endforeach
</ul>
       

<form action="{{ route('cart.add', ['productId' => $product->id]) }}" method="POST">
    @csrf
    <div class="mb-4">
        <label for="platform" class="block font-semibold">Choisissez votre plateforme</label>
        <select name="platform" id="platform" class="border rounded w-full px-4 py-2" required>
            @foreach($product->platforms as $platform)
                <option value="{{ $platform->id }}">{{ $platform->name }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="mt-2 px-4 py-2 bg-green-500 text-white rounded-md shadow-md hover:bg-green-600">
        Ajouter au panier
    </button>
</form>



        <!-- Section Avis des clients -->
        <div class="mt-8 bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-4">Avis des clients</h2>

            <!-- Bouton pour afficher/masquer la liste des avis -->
            <button id="toggle-reviews" class="px-4 py-2 bg-blue-500 text-white rounded-md shadow-md hover:bg-blue-600">
                Voir les avis
            </button>

            <!-- Liste des avis avec barre de défilement -->
            <div id="reviews-list" class="mt-4 hidden bg-gray-100 p-4 rounded-md overflow-y-auto max-h-64">
                @if($product->reviews->isEmpty())
                    <p class="text-gray-600">Aucun avis pour ce produit pour le moment.</p>
                @else
                    @foreach($product->reviews as $review)
                        <div class="mb-4 border-b pb-4">
                            <p class="font-semibold">{{ $review->user->name }}</p>
                            <p class="text-gray-700">{{ $review->review_text }}</p>
                            <p class="text-yellow-500">Note : {{ $review->rating }}/5</p>
                            <p class="text-gray-500 text-sm">Posté le {{ $review->created_at }}</p>
                        </div>
                    @endforeach
                @endif
            </div>

            <!-- Formulaire pour laisser un avis -->
            @auth
                <h3 class="text-xl font-bold mt-6">Laisser un avis</h3>
                <form action="{{ route('reviews.store', $product->id) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="rating" class="block font-semibold">Note</label>
                        <select name="rating" id="rating" class="border rounded w-full px-4 py-2">
                            @for ($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="review_text" class="block font-semibold">Votre Avis</label>
                        <textarea name="review_text" id="review_text" class="border rounded w-full px-4 py-2"></textarea>
                    </div>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md shadow-md hover:bg-blue-600">
                        Envoyer
                    </button>
                </form>
            @else
                <p class="mt-4 text-gray-700">Veuillez <a href="{{ route('login') }}" class="text-blue-500 hover:underline">vous connecter</a> pour laisser un avis.</p>
            @endauth
        </div>
    </div>

    <!-- Script pour afficher/masquer la liste des avis -->
    <script>
        document.getElementById('toggle-reviews').addEventListener('click', function() {
            const reviewsList = document.getElementById('reviews-list');
            if (reviewsList.classList.contains('hidden')) {
                reviewsList.classList.remove('hidden');
                this.textContent = 'Masquer les avis';
            } else {
                reviewsList.classList.add('hidden');
                this.textContent = 'Voir les avis';
            }
        });
    </script>
</body>
</html>
