<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Adresses</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-2xl">
            <h1 class="text-2xl font-semibold text-center mb-6">Mes Adresses</h1>

            @if ($addresses->isEmpty())
                <p class="text-gray-600 text-center">Vous n'avez pas encore ajouté d'adresse.</p>
            @else
                <ul>
                    @foreach ($addresses as $address)
                        <li class="mb-4 border-b pb-4">
                            <p><strong>Numéro de rue :</strong> {{ $address->street_number }}</p>
                            <p><strong>Rue :</strong> {{ $address->street_name }}</p>
                            <p><strong>Ville :</strong> {{ $address->city }}</p>
                            <p><strong>Code Postal :</strong> {{ $address->postal_code }}</p>
                            @if ($address->pivot->is_default)
                                <span class="text-green-600 font-bold">(Adresse par défaut)</span>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endif

            <div class="mt-6 text-center">
                <a href="{{ route('home') }}" class="text-indigo-600 hover:underline">Retour à l'accueil</a>
            </div>
        </div>
    </div>
</body>
</html>
