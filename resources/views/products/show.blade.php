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
        .image-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-template-rows: auto auto;
            gap: 10px;
        }
        .image-grid img {
            object-fit: cover;
        }
        .image-grid .top-image {
            width: 100%;
            height: 400px; 
            border-radius: 15px;
        }
        .image-grid .large-image {
            grid-column: span 2;
            width: 100%;
            height: 700px; 
            border-radius: 15px;
        }
        .text-2xl {
            font-size: 40px;
            font-weight: 700px;
            margin-bottom: 1rem;
            text-align: center;
        }
        .mt-8 {
            margin-top: 100px;
        }
        .mb-4 {
            margin-bottom: 100px;
        }
        .gap-6 {
            gap: 1.5rem;
        }
        .product-details h1{
            text-align: center;
            font-size: 40px;
        }
        .product-details h2{
            font-size: 25px;
        }
        .description{
            align-items: center;
            text-align: center;
        }
        .product-image{
            border-radius: 20px;
        }
       
       
    </style>
</head>
<body class="bg-gray-100">
    <!-- Navigation -->
    @include('components.nav')

    <!-- Contenu du produit -->
    <div class="container mx-auto mt-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                @if($product->image_path)
                    <img src="{{ asset('image/' . $product->image_path) }}" class="img-fluid product-image" alt="{{ $product->product_name }}">
                @else
                    <img src="{{ asset('image/default.png') }}" class="img-fluid product-image" alt="Image par défaut">
                @endif
            </div>
            <div class="product-details">
                <h1 class="text-3xl font-bold">{{ $product->product_name }}</h1>
                <h2 class="text-2xl font-bold">€{{ number_format($product->price, 2) }}</h2>
                <p class="text-gray-500"><strong>Catégories :</strong> {{ $product->categories->pluck('category_name')->join(', ') }}</p>
                <p class="text-gray-500"><strong>Plateformes :</strong> {{ $product->platforms->pluck('name')->join(', ') }}</p>
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
            </div>
        </div>
    </div>

    <div class="description">
        <div class="container mx-auto mt-8">
            <h2 class="text-2xl font-bold mb-4">Description</h2>
            <p>{{ $product->description }}</p>
        </div>

    </div>
    
    <!-- Visuels -->
    <div class="container mx-auto mt-8">
        <h2 class="text-2xl font-bold mb-4">Visuels</h2>
        <div class="image-grid mb-8">
            @foreach($product->images as $index => $image)
                @if($index < 2)
                    <img src="{{ asset('image/products/' . $image->image_path) }}" class="top-image" alt="{{ $product->product_name }}">
                @elseif($index == 2)
                    <img src="{{ asset('image/products/' . $image->image_path) }}" class="large-image" alt="{{ $product->product_name }}">
                @endif
            @endforeach
        </div>
    </div>
    
    <!-- Section Avis des clients -->
    <div class="container mx-auto mt-8">
        <div class="bg-white shadow-lg rounded-lg p-6">
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
            reviewsList.classList.toggle('hidden');
            this.textContent = reviewsList.classList.contains('hidden') ? 'Voir les avis' : 'Masquer les avis';
        });
    </script>
</body>
</html>