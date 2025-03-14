<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Utilisateur avec Panier</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-100">
@include('layouts.alerts')
@include('layouts.quantity-null-modal')


<!-- Navbar -->
<nav class="bg-gray-900 text-white py-4 px-8 flex justify-between items-center relative">
        <a href="{{ route('home') }}" class="navbar-brand">
            <img src="{{ asset('image/LOgo.png') }}" alt="Logo" class="h-10">
            <p style="font-family: 'Times New Roman', Times, serif; font-size: 30px; margin-left: 10px;">Gamehub</>
        </a>

        

        @if(Route::currentRouteName() == 'home' || Route::currentRouteName() == 'products.index')
    <div class="flex justify-center w-full">
        <form action="{{ route('search') }}" method="GET" class="d-flex ml-8" role="search">
            <input class="form-control me-2" type="search" name="query" placeholder="Search" aria-label="Search" style="width: 300px;">
            <button class="btn btn-outline-success" type="submit" style="border-radius: 20px;background: linear-gradient(90deg, #289EB6 0%, #248E5E 100%);color:white">Search</button>
        </form>
    </div>
    @endif
    
    
    </div>


    <ul class="flex gap-4 items-center ml-8">
        <li><a href="{{ route('products.index') }}" class="hover:text-green-500">Produits</a></li>

        <!-- Icône Panier -->
        <li class="relative"> 
            <a href="{{ route('cart.index') }}" class="hover:text-green-500 flex items-center space-x-1"> 
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7"> 
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l3.6 9.59a1 1 0 00.93.65h7.84a1 1 0 00.93-.65L21 6H7"></path> 
                    <circle cx="9" cy="21" r="1.5"></circle> <circle cx="17" cy="21" r="1.5"></circle> 
                </svg> 
                @if(session('cart') && count(session('cart')) > 0) 
                <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full"> {{ count(session('cart')) }} 
                </span> 
                @endif 
            </a> 
        </li>

        <!-- Icône Utilisateur -->
        <li>
            <button id="user-menu-button" class="flex items-center space-x-2 hover:text-green-500 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 15.75a6 6 0 10-7.5 0m-3 2.25a9 9 0 1113.5 0"></path>
                </svg>
            </button>
        </li>
    </ul>

    <!-- Menu déroulant sous la navbar -->
    <div id="user-menu" class="absolute top-full right-0 w-48 bg-white text-black rounded-md shadow-lg py-2 z-20 overflow-hidden transform scale-y-0 origin-top transition-all duration-300 ease-in-out hidden">
        @auth
            <a href="{{ route('profile.index') }}" class="block px-4 py-2 hover:bg-gray-200">Profil</a>
            <form method="POST" action="{{ route('logout') }}" class="block px-4 py-2 hover:bg-gray-200">
                @csrf
                <button type="submit" class="w-full text-left">Déconnexion</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="block px-4 py-2 hover:bg-gray-200">Se connecter</a>
            <a href="{{ route('register') }}" class="block px-4 py-2 hover:bg-gray-200">Créer un compte</a>
        @endauth
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const userMenuButton = document.getElementById('user-menu-button');
        const userMenu = document.getElementById('user-menu');

        // Ouvrir/fermer le menu au clic
        userMenuButton.addEventListener('click', function (event) {
            event.stopPropagation();

            if (userMenu.classList.contains('hidden')) {
                userMenu.classList.remove('hidden');
                setTimeout(() => {
                    userMenu.classList.remove('scale-y-0'); // Appliquer l'effet de déploiement
                }, 10);
            } else {
                userMenu.classList.add('scale-y-0'); // Replier le menu
                setTimeout(() => {
                    userMenu.classList.add('hidden');
                }, 300);
            }
        });

        // Fermer si on clique en dehors
        document.addEventListener('click', function (event) {
            if (!userMenu.contains(event.target) && !userMenuButton.contains(event.target)) {
                userMenu.classList.add('scale-y-0');
                setTimeout(() => {
                    userMenu.classList.add('hidden');
                }, 300);
            }
        });
    });
</script>

</body>
</html>
