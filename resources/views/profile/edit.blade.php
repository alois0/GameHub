<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier mon profil - GameHub</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    
    <!-- Navigation -->
    @include('components.nav')

    

    <div class="container mx-auto mt-8 p-6 max-w-4xl bg-white shadow-lg rounded-lg">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Modifier mon profil</h1>

        <!-- Formulaire de mise à jour des informations du profil -->
        <section class="bg-white shadow-lg rounded-lg p-6 mb-6">
            <header class="border-b pb-4 mb-4">
                <h2 class="text-2xl font-semibold text-gray-800">Informations du profil</h2>
                <p class="mt-1 text-sm text-gray-600">
                    Mettez à jour les informations de votre compte et votre adresse e-mail.
                </p>
            </header>

            <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                @csrf
                @method('patch')

                <div>
                    <label for="name" class="block text-gray-700 font-semibold">Nom</label>
                    <input id="name" name="name" type="text" 
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                           value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-gray-700 font-semibold">Email</label>
                    <input id="email" name="email" type="email" 
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                           value="{{ old('email', $user->email) }}" required autocomplete="username">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" 
                        class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
                    Enregistrer
                </button>
            </form>
        </section>

        <!-- Formulaire pour mettre à jour l'adresse par défaut -->
<section class="bg-white shadow-lg rounded-lg p-6 mb-6">
    <header class="border-b pb-4 mb-4">
        <h2 class="text-2xl font-semibold text-gray-800">Adresse par défaut</h2>
        <p class="mt-1 text-sm text-gray-600">
            Choisissez une adresse comme adresse par défaut.
        </p>
    </header>

    <form method="POST" action="{{ route('profile.updateDefaultAddress') }}" class="space-y-6">
        @csrf
        @method('PATCH')

        <div>
            <label for="address_id" class="block text-gray-700 font-semibold">Sélectionner une adresse par défaut</label>
            <select id="address_id" name="address_id" 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Sélectionner une adresse</option>
                @foreach($addresses as $address)
                    <option value="{{ $address->id }}" {{ $address->is_default ? 'selected' : '' }}>
                        {{ $address->street_name }}, {{ $address->street_number }}, {{ $address->city }} - {{ $address->postal_code }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" 
                class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
            Mettre à jour l'adresse par défaut
        </button>
    </form>
</section>






<section class="bg-white shadow-lg rounded-lg p-6">
    <header class="border-b pb-4 mb-4">
        <h2 class="text-2xl font-semibold text-gray-800">Mettre à jour le mot de passe</h2>
        <p class="mt-1 text-sm text-gray-600">
            Assurez-vous que votre compte utilise un mot de passe fort et sécurisé.
        </p>
    </header>

    @if (session('status') === 'password-updated')
    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded shadow-sm">
        <p class="text-sm">Mot de passe mis à jour avec succès.</p>
    </div>
@endif



    <form method="post" action="{{ route('profile.password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <!-- Mot de passe actuel -->
        <div>
            <label for="current_password" class="block text-gray-700 font-semibold">Mot de passe actuel</label>
            <input id="current_password" name="current_password" type="password" 
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                   autocomplete="current-password" required>
            @error('current_password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Nouveau mot de passe -->
        <div>
            <label for="password" class="block text-gray-700 font-semibold">Nouveau mot de passe</label>
            <input id="password" name="password" type="password" 
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                   autocomplete="new-password" required>
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirmation du mot de passe -->
        <div>
            <label for="password_confirmation" class="block text-gray-700 font-semibold">Confirmer le mot de passe</label>
            <input id="password_confirmation" name="password_confirmation" type="password" 
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                   autocomplete="new-password" required>
            @error('password_confirmation')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Bouton Enregistrer -->
        <div class="flex items-center justify-between">
            <button type="submit" 
                    class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
                Enregistrer
            </button>

            @if (session('status') === 'password-updated')
                <p class="text-sm text-green-600">
                    Mot de passe mis à jour avec succès.
                </p>
            @endif
        </div>
    </form>
</section>

        <!-- Formulaire de suppression de compte -->
        <section class="bg-white shadow-lg rounded-lg p-6">
            <header class="border-b pb-4 mb-4">
                <h2 class="text-2xl font-semibold text-gray-800">Suppression du compte</h2>
                <p class="mt-1 text-sm text-gray-600">
                    Une fois votre compte supprimé, toutes vos données seront effacées définitivement.  
                    Pensez à sauvegarder toute information importante avant de continuer.
                </p>
            </header>

            <button id="open-delete-modal"
                    class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                Supprimer mon compte
            </button>

            <!-- Modal de confirmation -->
            <div id="delete-modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden flex items-center justify-center">
                <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
                    <h2 class="text-xl font-semibold text-gray-900">Confirmer la suppression</h2>
                    <p class="mt-2 text-sm text-gray-600">
                        Cette action est **irréversible**. Veuillez entrer votre mot de passe pour confirmer la suppression.
                    </p>

                    <form method="post" action="{{ route('profile.destroy') }}" class="mt-4">
                        @csrf
                        @method('delete')

                        <div>
                            <label for="password" class="block text-gray-700 font-semibold">Mot de passe</label>
                            <input id="password" name="password" type="password"
                                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                                placeholder="Entrez votre mot de passe" required>
                            @error('password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-6 flex justify-end">
                            <button type="button" id="close-delete-modal"
                                    class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">
                                Annuler
                            </button>

                            <button type="submit"
                                    class="ml-3 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                                Supprimer définitivement
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>

    <div class="h-32"></div>

    @include('components.footer')

    <script>
        document.getElementById('open-delete-modal').addEventListener('click', function () {
            document.getElementById('delete-modal').classList.remove('hidden');
        });

        document.getElementById('close-delete-modal').addEventListener('click', function () {
            document.getElementById('delete-modal').classList.add('hidden');
        });
    </script>
</body>
</html>
