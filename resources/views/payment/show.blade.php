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
    <div class="container mx-auto mt-8 p-6 max-w-lg bg-white shadow-lg rounded-lg">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Détails du Paiement</h1>

        <div class="bg-gray-100 shadow-md rounded-lg p-4 mb-6">
            <h2 class="text-xl font-semibold text-gray-800">Total à Payer : {{ number_format($totalPrice, 2) }} €</h2>
        </div>

        <!-- Formulaire de paiement Stripe -->
        <form id="payment-form">
            @csrf
            <div id="card-element" class="my-4"></div> <!-- Champ de carte Stripe -->

            <div id="card-errors" role="alert" class="text-red-500 mb-4"></div>

            <button id="submit" type="button" class="w-full py-2 bg-green-500 text-white rounded-md hover:bg-green-600 transition-all">
                Payer et Valider la Commande
            </button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var stripe = Stripe('{{ $stripePublicKey }}'); // Clé publique Stripe
            var elements = stripe.elements();
            var card = elements.create('card'); // Champ de carte Stripe
            card.mount('#card-element'); // Attacher le champ à l'élément HTML

            // Gestion du clic sur le bouton de paiement
            document.getElementById('submit').addEventListener('click', function(event) {
                event.preventDefault();

                var clientSecret = '{{ $clientSecret }}'; // Transmis depuis le backend

                stripe.confirmCardPayment(clientSecret, {
                    payment_method: {
                        card: card,
                        billing_details: {
                            name: 'Nom du Client', // Vous pouvez le récupérer dynamiquement si nécessaire
                        }
                    },
                }).then(function(result) {
                    if (result.error) {
                        // Affiche les erreurs dans l'interface utilisateur
                        document.getElementById('card-errors').textContent = result.error.message;
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
    }
})
.catch(error => console.error('Erreur de communication avec le backend', error));

                    }
                });
            });
        });
    </script>
</body>
</html>
