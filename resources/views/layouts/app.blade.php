<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased flex flex-col min-h-screen">
    <div class="min-h-screen bg-gray-100">
        <!-- Navigation -->
        <nav class="bg-gray-900 text-white py-4 px-8 flex justify-between items-center">
            <div class="text-xl font-bold">
                <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('image/LOgo.png') }}" alt="image"></a>
            </div>
            <ul class="flex gap-4">
                @auth
                    <li><a href="{{ route('products.index') }}" class="hover:text-green-500">Produits</a></li>
                    <li><a href="{{ route('profile.edit') }}" class="hover:text-green-500">Profile</a></li>
                    <li><a href="{{ route('cart.index') }}" class="hover:text-green-500">Panier</a></li>
                    <li><a href="{{ route('orders.index') }}" class="hover:text-green-500">Commandes</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="hover:text-green-500">Déconnexion</button>
                        </form>
                    </li>
                @else
                    <li><a href="{{ route('login') }}" class="hover:text-green-500">Se connecter</a></li>
                    <li><a href="{{ route('register') }}" class="hover:text-green-500">Créer un compte</a></li>
                @endauth
            </ul>
        </nav>

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main class="flex-grow">
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white py-6 mt-8">
            <div class="container mx-auto px-4">
                <div class="flex justify-between items-center">
                    <div class="text-xl font-bold">
                        <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('image/LOgo.png') }}" alt="image"></a>
                    </div>
                    <ul class="flex gap-4">
                        <li><a href="{{ route('products.index') }}" class="hover:text-green-500">Produits</a></li>
                        <li><a href="{{ route('profile.edit') }}" class="hover:text-green-500">Profile</a></li>
                        <li><a href="{{ route('cart.index') }}" class="hover:text-green-500">Panier</a></li>
                        <li><a href="{{ route('orders.index') }}" class="hover:text-green-500">Commandes</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-green-500">Contact</a></li>
                    </ul>
                </div>
                <div class="mt-4 text-center">
                    <p>&copy; {{ date('Y') }} GameHub. Tous droits réservés.</p>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
