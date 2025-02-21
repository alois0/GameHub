<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choisir une adresse - GameHub</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <!-- Navigation -->
    @include('components.nav')

    

    <!-- Contenu principal -->
    <div class="container mx-auto mt-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Choisissez une adresse</h1>

        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-2xl mx-auto">
            <form method="POST" action="{{ route('checkout.store_address') }}">
                @csrf

                <!-- 🔹 Option 1: Choisir une adresse existante -->
                <h2 class="text-lg font-medium mb-2">Adresse enregistrée :</h2>
                @forelse ($addresses as $address)
                    <div class="mb-4 p-4 border rounded-lg bg-gray-50 flex items-center">
                        <input type="radio" name="address_id" value="{{ $address->id }}" class="existing-address accent-blue-500" required>
                        <span class="ml-3 text-gray-700">
                            {{ $address->street_number }} {{ $address->street_name }}, {{ $address->city }}, {{ $address->postal_code }}
                            @if ($address->pivot->is_default)
                                <span class="text-green-600 font-bold">(Adresse par défaut)</span>
                            @endif
                        </span>
                    </div>
                @empty
                    <p class="text-gray-600 mb-4">Vous n'avez aucune adresse enregistrée.</p>
                @endforelse

                <!-- 🔹 Option 2: Ajouter une nouvelle adresse -->
                <div class="mb-4 p-4 border rounded-lg bg-gray-50">
                    <label class="flex items-center">
                        <input type="radio" name="address_id" value="new" id="new_address_radio" class="accent-blue-500">
                        <span class="ml-2 font-medium text-gray-800">Entrer une nouvelle adresse</span>
                    </label>

                    <!-- Formulaire nouvelle adresse -->
                    <div id="new_address_form" class="mt-4 hidden space-y-3">
                        <input type="text" name="street_number" placeholder="Numéro de rue" class="w-full px-3 py-2 border rounded">
                        <input type="text" name="street_name" placeholder="Rue" class="w-full px-3 py-2 border rounded">
                        <input type="text" name="city" placeholder="Ville" class="w-full px-3 py-2 border rounded">
                        <input type="text" name="postal_code" placeholder="Code Postal" class="w-full px-3 py-2 border rounded">
                    </div>
                </div>

                <!-- Bouton de soumission -->
                <div class="mt-6">
                    <button type="submit" class="w-full py-3 rounded-lg text-white bg-blue-500 hover:bg-blue-600 font-semibold">
                        Continuer vers le paiement
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="h-32"></div>

    @include('components.footer')

    <!-- Script pour afficher/cacher le formulaire de nouvelle adresse -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let newAddressRadio = document.getElementById("new_address_radio");
            let newAddressForm = document.getElementById("new_address_form");
            let existingAddressRadios = document.querySelectorAll(".existing-address");

            function toggleNewAddressForm() {
                if (newAddressRadio.checked) {
                    newAddressForm.classList.remove("hidden");
                } else {
                    newAddressForm.classList.add("hidden");
                }
            }

            newAddressRadio.addEventListener("change", toggleNewAddressForm);
            existingAddressRadios.forEach(radio => {
                radio.addEventListener("change", toggleNewAddressForm);
            });

            toggleNewAddressForm();
        });
    </script>

</body>
</html>
