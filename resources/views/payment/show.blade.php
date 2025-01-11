<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                <li><a href="{{ route('profile.edit') }}" class="hover:text-green-500">Profile</a></li>
                <li><a href="{{ route('cart.index') }}" class="hover:text-green-500">Panier</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="hover:text-green-500">Logout</button>
                    </form>
                </li>
            @else
                <li><a href="{{ route('login') }}" class="hover:text-green-500">Login</a></li>
                <li><a href="{{ route('register') }}" class="hover:text-green-500">Register</a></li>
            @endauth
        </ul>
    </nav>

    <!-- Formulaire de paiement -->
    <div class="container mx-auto mt-8 p-6 max-w-lg bg-white shadow-lg rounded-lg">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Détails du Paiement</h1>

        <!-- Affichage du total du panier -->
        <div class="bg-gray-100 shadow-md rounded-lg p-4">
            <h2 class="text-xl font-semibold text-gray-800">Total à Payer : {{ number_format($totalPrice, 2) }} €</h2>
        </div>

        <form action="{{ route('payment.process') }}" method="POST" id="payment-form" class="mt-6">
            @csrf
            <div id="card-element" class="my-4">
                <!-- Le champ de carte de crédit sera inséré ici par Stripe -->
            </div>

            <div id="card-errors" role="alert" class="text-red-500 mb-4"></div>

            <button id="submit" class="w-full py-2 bg-green-500 text-white rounded-md hover:bg-green-600 transition-all">
                Payer
            </button>
        </form>
    </div>

<script>
    // Créer une instance Stripe
    var stripe = Stripe('{{ $stripePublicKey }}'); // Utilisation de la clé publique Stripe passée depuis le contrôleur
    var elements = stripe.elements();

    // Créer un élément de carte
    var card = elements.create('card');
    card.mount('#card-element');

    // Gérer la soumission du formulaire
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        stripe.confirmCardPayment('{{ $clientSecret }}', {
            payment_method: {
                card: card,
            },
        }).then(function(result) {
            if (result.error) {
                // Afficher une erreur à l'utilisateur
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                if (result.paymentIntent.status === 'succeeded') {
                    // Le paiement a réussi
                    alert('Paiement réussi');
                }
            }
        });
    });
</script>

</body>
</html>
