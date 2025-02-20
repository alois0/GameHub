<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="absolute top-4 left-4">
        <a href="{{ url()->previous() }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 text-sm">
            ← Retour
        </a>
    </div>

    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
            <h1 class="text-2xl font-semibold text-center mb-6">Connectez-vous</h1>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Adresse mail</label>
                    <input type="email" name="email" id="email" placeholder="Entrez votre adresse mail" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                    <input type="password" name="password" id="password" placeholder="Entrez votre mot de passe" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center mb-6">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <label for="remember_me" class="ml-2 text-sm text-gray-600">Se souvenir de moi</label>
                </div>

                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit" 
                        class="w-full py-3 rounded-full text-white"
                        style="background-color: rgba(70, 6, 35, 0.25); font-size: 1rem; transition: background-color 0.3s ease;"
                        onmouseover="this.style.backgroundColor='rgba(70, 6, 35, 0.45)';"
                        onmouseout="this.style.backgroundColor='rgba(70, 6, 35, 0.25)';">
                        Se connecter
                    </button>
                </div>
                
                <div class="flex items-center justify-center mb-4">
                    <a href="{{ route('password.request') }}" class="text-sm text-indigo-500 hover:underline">Mot de passe oublié ?</a>
                </div>
                
            </form>

            <p class="text-center text-sm text-gray-600 mt-4">
                Vous n'avez pas de compte ? <a href="{{ route('register') }}" class="text-indigo-500 hover:underline">Créez un compte</a>
            </p>
        </div>


    </div>
</body>
</html>
