<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choisir une adresse</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-2xl">
            <h1 class="text-2xl font-semibold text-center mb-6">Choisissez une adresse</h1>

            <form method="POST" action="{{ route('checkout.store_address') }}">
                @csrf

                <!-- Option 1: Choisir une adresse existante -->
                <h2 class="text-lg font-medium">Adresse enregistrée :</h2>
                @foreach ($addresses as $address)
                    <div class="mb-4 p-4 border rounded">
                        <label class="flex items-center">
                            <input type="radio" name="address_id" value="{{ $address->id }}" class="existing-address" required>
                            <span class="ml-2">
                                {{ $address->street_number }} {{ $address->street_name }}, {{ $address->city }}, {{ $address->postal_code }}
                                @if ($address->pivot->is_default)
                                    <span class="text-green-600 font-bold">(Adresse par défaut)</span>
                                @endif
                            </span>
                        </label>
                    </div>
                @endforeach

                <!-- 🔹 Option 2: Ajouter une nouvelle adresse -->
                <div class="mb-4 p-4 border rounded">
                    <label class="flex items-center">
                        <input type="radio" name="address_id" value="new" id="new_address_radio">
                        <span class="ml-2 font-medium">Entrer une nouvelle adresse</span>
                    </label>

                    <!-- Formulaire nouvelle adresse -->
                    <div id="new_address_form" class="mt-4 hidden">
                        <input type="text" name="street_number" placeholder="Numéro de rue" class="w-full px-3 py-2 border rounded mb-2">
                        <input type="text" name="street_name" placeholder="Rue" class="w-full px-3 py-2 border rounded mb-2">
                        <input type="text" name="city" placeholder="Ville" class="w-full px-3 py-2 border rounded mb-2">
                        <input type="text" name="postal_code" placeholder="Code Postal" class="w-full px-3 py-2 border rounded mb-2">
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit" class="w-full py-3 rounded-full text-white bg-indigo-600 hover:bg-indigo-700">
                        Continuer vers le paiement
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let newAddressRadio = document.getElementById("new_address_radio");
            let newAddressForm = document.getElementById("new_address_form");
            let existingAddressRadios = document.querySelectorAll(".existing-address");

            // Masquer/afficher les champs de nouvelle adresse
            function toggleNewAddressForm() {
                if (newAddressRadio.checked) {
                    newAddressForm.classList.remove("hidden");
                } else {
                    newAddressForm.classList.add("hidden");
                }
            }

            // Événement lorsque l'utilisateur change son choix d'adresse
            newAddressRadio.addEventListener("change", toggleNewAddressForm);
            existingAddressRadios.forEach(radio => {
                radio.addEventListener("change", toggleNewAddressForm);
            });

            // Vérifie si l'utilisateur avait déjà sélectionné "Nouvelle adresse" au chargement
            toggleNewAddressForm();
        });
    </script>

</body>
</html>
