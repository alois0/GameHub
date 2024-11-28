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

    <!-- Informations utilisateur -->
    <div class="mb-4">
        <label for="name" class="block text-sm font-medium text-gray-700">Nom d'utilisateur</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" required
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
    </div>

    <div class="mb-4">
        <label for="email" class="block text-sm font-medium text-gray-700">Adresse mail</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" required
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
    </div>

    <div class="mb-4">
        <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
        <input type="password" name="password" id="password" required
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
    </div>

    <div class="mb-4">
        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmez le mot de passe</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
    </div>

    <!-- Adresse -->
    <div class="mb-4">
        <label for="ville" class="block text-sm font-medium text-gray-700">Ville</label>
        <input type="text" name="ville" id="ville" value="{{ old('ville') }}" required
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
    </div>

    <div class="mb-4">
        <label for="rue" class="block text-sm font-medium text-gray-700">Rue</label>
        <input type="text" name="rue" id="rue" value="{{ old('rue') }}" required
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
    </div>

    <div class="mb-4">
        <label for="codepostal" class="block text-sm font-medium text-gray-700">Code Postal</label>
        <input type="text" name="codepostal" id="codepostal" value="{{ old('codepostal') }}" required
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
    </div>

    <!-- Téléphones -->
    <h2 class="text-lg font-medium mb-4">Téléphones</h2>
    <div id="phone-fields">
        @php
            $phones = old('phone', ['']); // Récupère les anciennes valeurs ou un champ vide
        @endphp
        @foreach ($phones as $index => $tel)
            <div class="mb-4">
                <label for="phone_{{ $index }}" class="block text-sm font-medium text-gray-700">Numéro de téléphone</label>
                <input type="text" name="phone[]" id="phone_{{ $index }}" value="{{ $tel }}"
                    placeholder="Numéro de téléphone"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>
        @endforeach
    </div>

    <!-- Bouton pour ajouter un autre champ -->
    <div class="mt-4">
        <button type="button" id="add-phone"
            class="mt-2 px-4 py-2 bg-indigo-500 text-white rounded-md shadow-md hover:bg-indigo-600">
            Ajouter un autre numéro
        </button>
    </div>

    <!-- Bouton Enregistrer -->
    <div class="mt-6">
        <button type="submit" class="w-full py-3 rounded-full text-white bg-indigo-600 hover:bg-indigo-700">
            Enregistrer
        </button>
    </div>
</form>

<script>
    document.getElementById('add-phone').addEventListener('click', function () {
        const phoneFields = document.getElementById('phone-fields');
        const index = phoneFields.children.length;
        const newPhoneField = `
            <div class="mb-4">
                <label for="phone_${index}" class="block text-sm font-medium text-gray-700">Numéro de téléphone</label>
                <input type="text" name="phone[]" id="phone_${index}" placeholder="Numéro de téléphone"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>`;
        phoneFields.insertAdjacentHTML('beforeend', newPhoneField);
    });
</script>






            <p class="text-center text-sm text-gray-600 mt-4">
                Vous avez déjà un compte ? <a href="{{ route('login') }}" class="text-indigo-500 hover:underline">Connectez-vous</a>
            </p>
        </div>
    </div>
</body>
</html>
