<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un compte</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
            <h1 class="text-2xl font-semibold text-center mb-6">Créer un compte</h1>

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <!-- Username -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nom d'utilisateur</label>
                    <input type="text" name="name" id="name" placeholder="Entrez un nom d'utilisateur" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                </div>

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

                <!-- Confirm Password -->
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmez le mot de passe</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirmez votre mot de passe" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                </div>

                <!-- Terms and conditions -->
                <div class="text-xs text-gray-600 mb-6">
                    En créant un compte, vous acceptez les <a href="#" class="underline">Conditions d'utilisation</a> et la <a href="#" class="underline">Politique de confidentialité</a>.
                </div>

                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit" 
                        class="w-full py-3 rounded-full text-white"
                        style="background-color: rgba(70, 6, 35, 0.25); font-size: 1rem; transition: background-color 0.3s ease;"
                        onmouseover="this.style.backgroundColor='rgba(70, 6, 35, 0.45)';"
                        onmouseout="this.style.backgroundColor='rgba(70, 6, 35, 0.25)';">
                        Créer mon compte
                    </button>
                </div>
            </form>

            <p class="text-center text-sm text-gray-600 mt-4">
                Vous avez déjà un compte ? <a href="{{ route('login') }}" class="text-indigo-500 hover:underline">Connectez-vous</a>
            </p>
        </div>
    </div>
</body>
</html>
