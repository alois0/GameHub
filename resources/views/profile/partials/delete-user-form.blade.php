<section class="bg-white shadow-lg rounded-lg p-6">
    <header class="border-b pb-4 mb-4">
        <h2 class="text-2xl font-semibold text-gray-800">Suppression du compte</h2>
        <p class="mt-1 text-sm text-gray-600">
            Une fois votre compte supprimé, toutes vos données seront effacées définitivement.  
            Pensez à sauvegarder toute information importante avant de continuer.
        </p>
    </header>

    <!-- Bouton d'ouverture du modal -->
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

            <!-- Formulaire de suppression -->
            <form method="post" action="{{ route('profile.destroy') }}" class="mt-4">
                @csrf
                @method('delete')

                <!-- Champ mot de passe -->
                <div>
                    <label for="password" class="block text-gray-700 font-semibold">Mot de passe</label>
                    <input id="password" name="password" type="password"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                        placeholder="Entrez votre mot de passe" required>
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Boutons Annuler / Supprimer -->
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

<script>
    // Affichage du modal
    document.getElementById('open-delete-modal').addEventListener('click', function () {
        document.getElementById('delete-modal').classList.remove('hidden');
    });

    // Fermeture du modal
    document.getElementById('close-delete-modal').addEventListener('click', function () {
        document.getElementById('delete-modal').classList.add('hidden');
    });
</script>
