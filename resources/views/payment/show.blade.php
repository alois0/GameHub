<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Pour sécuriser les requêtes AJAX -->
    <title>Paiement - GameHub</title>
    <script src="https://js.stripe.com/v3/"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <!-- Navigation -->
    <nav class="bg-gray-900 text-white py-4 px-8 flex justify-between items-center">
        <div class="text-xl font-bold">
            <a href="/" class="hover:text-green-500">GameHub</a>
        </div>
        <ul class="flex gap-4">
            @auth
                <li><a href="{{ route('profile.edit') }}" class="hover:text-green-500">Profil</a></li>
                <li><a href="{{ route('cart.index') }}" class="hover:text-green-500">Panier</a></li>
                <li><a href="{{ route('orders.index') }}" class="hover:text-green-500">Commandes</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="hover:text-green-500">Déconnexion</button>
                    </form>
                </li>
            @else
                <li><a href="{{ route('login') }}" class="hover:text-green-500">Connexion</a></li>
                <li><a href="{{ route('register') }}" class="hover:text-green-500">Inscription</a></li>
            @endauth
        </ul>
    </nav>

    <!-- Contenu du Paiement -->
    <div class="container mx-auto mt-8 max-w-lg">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Détails du Paiement</h1>

            <!-- Affichage du total à payer -->
            <div class="bg-gray-100 shadow-md rounded-lg p-4 mb-6 text-center">
                <h2 class="text-xl font-semibold text-gray-800">Total à Payer : {{ number_format($totalPrice, 2) }} €</h2>
            </div>

            <!-- Formulaire de paiement Stripe -->
            <form id="payment-form">
                @csrf
                <div class="mb-4">
        <label for="cardholder-name" class="block text-gray-700">Nom du Client</label>
        <input type="text" id="cardholder-name" name="cardholder-name" class="w-full p-2 border rounded" required>
    </div>


                <div id="card-element" class="my-4 border p-3 rounded bg-gray-50"></div> <!-- Champ de carte Stripe -->

                <div id="card-errors" role="alert" class="text-red-500 mb-4"></div>

                <button id="submit" type="button" class="w-full py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-all flex items-center justify-center">
                    <span id="submit-text">Payer et Valider la Commande</span>
                    <svg id="loading-icon" class="ml-2 hidden animate-spin h-5 w-5 text-white" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                    </svg>
                </button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var stripe = Stripe('{{ $stripePublicKey }}'); // Clé publique Stripe
            var elements = stripe.elements();
            var card = elements.create('card'); // Champ de carte Stripe
            card.mount('#card-element'); // Attacher le champ à l'élément HTML

            var submitButton = document.getElementById('submit');
            var submitText = document.getElementById('submit-text');
            var loadingIcon = document.getElementById('loading-icon');
            var cardholderName = document.getElementById('cardholder-name');

            // Gestion du clic sur le bouton de paiement
            submitButton.addEventListener('click', function(event) {
                event.preventDefault();
                submitButton.disabled = true;
                submitText.textContent = "Paiement en cours...";
                loadingIcon.classList.remove("hidden");

                var clientSecret = '{{ $clientSecret }}'; // Transmis depuis le backend

                stripe.confirmCardPayment(clientSecret, {
                    payment_method: {
                        card: card,
                        billing_details: {
                            name: cardholderName.value, // Peut être récupéré dynamiquement
                        }
                    },
                }).then(function(result) {
                    if (result.error) {
                        // Affiche les erreurs dans l'interface utilisateur
                        document.getElementById('card-errors').textContent = result.error.message;
                        submitButton.disabled = false;
                        submitText.textContent = "Payer et Valider la Commande";
                        loadingIcon.classList.add("hidden");
                    } else {
                        // Paiement réussi, informer le backend
                        fetch('/payment/process', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            },
                            body: JSON.stringify({
                                paymentIntentId: result.paymentIntent.id, // ID du PaymentIntent
                            }),
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                window.location.href = '/confirmation';
                            } else {
                                alert(data.message);
                                submitButton.disabled = false;
                                submitText.textContent = "Payer et Valider la Commande";
                                loadingIcon.classList.add("hidden");
                            }
                        })
                        .catch(error => {
                            console.error('Erreur de communication avec le backend', error);
                            submitButton.disabled = false;
                            submitText.textContent = "Payer et Valider la Commande";
                            loadingIcon.classList.add("hidden");
                        });
                    }
                });
            });
        });
    </script>

</body>
</html>
