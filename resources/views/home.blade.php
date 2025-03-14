<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - GameHub</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
    <style>
        .carousel-image {
            width: 800px; 
            height: 400px; 
            object-fit: cover; 
        }
        .image-frame {
            width: 100%;
            height: 300px;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto; 
            border-radius: 10px;
        }
        .image-frame img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .button-container {
            display: flex;
            justify-content: center;
            margin-top: 1rem;
        }
        .slick-prev, .slick-next {
            color: black; /* Set the arrow color to black */
        }
        .slick-prev:before, .slick-next:before {
            color: black; /* Set the arrow icon color to black */
        }
        .category-slider .slick-slide {
            margin: 0 10px; /* Add gap between frames */
        }
        .best-sellers-slider .slick-slide {
            margin: 0 10px; /* Add gap between frames */
        }
        .slick-list {
            margin: 0 -10px; /* Adjust the margin to account for the gap */
        }
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        .section-header h1 {
            margin: 0;
        }

        .title {
            font-size: 50px;
            text-align: center;
            font-weight: bold;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Navigation -->
    @include('components.nav')

    <!-- Content -->
    <div class="container mx-auto">
        @if(isset($query))
            <h1 class="text-2xl font-bold mb-4">Résultats de recherche pour "{{ $query }}"</h1>
            @if($products->isEmpty())
                <p>Aucun produit trouvé.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($products as $product)
                        <div class="bg-white p-4 rounded-lg shadow">
                            <h2 class="text-xl font-bold">{{ $product->product_name }}</h2>
                            <p>{{ $product->description }}</p>
                            <a href="{{ route('products.show', $product->id) }}" class="text-green-500 hover:underline">Voir le produit</a>
                        </div>
                    @endforeach
                </div>
            @endif
        @else

            <div style="height:40px; padding: 20px;">
                <!-- <h1 class="title">GameHub</h1> -->
            </div>
            <!-- Carousel Slider -->
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Jeux recents</h1>
            <div class="carousel-slider">
                @foreach($latestProducts as $index => $product)
                    <div>
                        <img src="{{ asset('image/' . $product->image_path) }}" class="d-block w-100 carousel-image" alt="{{ $product->product_name }}">
                    </div>
                @endforeach
            </div>

            <!-- Categories -->
            <div class="Categories">
                <div class="container mx-auto mt-8">
                    <h1 class="text-3xl font-bold text-gray-800 mb-6">Toutes les Categories</h1>
                    <div class="category-slider">
                        @foreach($categories as $category)
                            <div class="bg-white shadow-lg rounded-lg p-4">
                                <div class="image-frame">
                                    <img src="{{ asset('image/' . $category->category_image) }}" alt="{{ $category->category_name }}">
                                </div>
                                <h2 class="text-xl font-bold text-gray-800 mt-2">{{ $category->category_name }}</h2>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Meilleures Ventes -->
            <div class="BestSellers">
                <div class="container mx-auto mt-8">
                    <div class="section-header">
                        <h1 class="text-3xl font-bold text-gray-800">Meilleures Ventes</h1>
                        <a href="{{ route('products.index') }}" class="text-blue-500 hover:underline">Voir tous les produits</a>
                    </div>
                    <div class="best-sellers-slider">
                        @foreach($bestSellingProducts as $product)
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
                </div>
            </div>
        @endif
    </div>

    <div class="h-32"></div>

    @include('components.footer')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+e5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.carousel-slider').slick({
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000,
                dots: true,
                arrows: true,
                prevArrow: '<button type="button" class="slick-prev">Previous</button>',
                nextArrow: '<button type="button" class="slick-next">Next</button>',
            });

            $('.category-slider').slick({
                infinite: true,
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 5000,
                dots: true,
                arrows: true,
                prevArrow: '<button type="button" class="slick-prev">Previous</button>',
                nextArrow: '<button type="button" class="slick-next">Next</button>',
            });

            $('.best-sellers-slider').slick({
                infinite: true,
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 5000,
                dots: true,
                arrows: true,
                prevArrow: '<button type="button" class="slick-prev">Previous</button>',
                nextArrow: '<button type="button" class="slick-next">Next</button>',
            });
        });
    </script>
</body>
</html>
