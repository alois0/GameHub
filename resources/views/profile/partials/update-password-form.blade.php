<section class="bg-white shadow-lg rounded-lg p-6">
    <header class="border-b pb-4 mb-4">
        <h2 class="text-2xl font-semibold text-gray-800">Mettre à jour le mot de passe</h2>
        <p class="mt-1 text-sm text-gray-600">
            Assurez-vous que votre compte utilise un mot de passe fort et sécurisé.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
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
