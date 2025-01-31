<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Catégories</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .fixed-header thead th {
            position: sticky;
            top: 0;
            background-color: white;
            z-index: 1;
        }
    </style>
</head>
<body href="/admin/dashboard" class="bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-gray-900 text-white py-4 px-8 flex justify-between items-center">
        <div class="text-xl font-bold">
            <a href="/admin/dashboard" class="hover:text-green-500">Admin</a>
        </div>
        <ul class="flex gap-4">
            @auth
                <li>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="hover:text-green-500">Logout</button>
                    </form>
                </li>
            @else
                <li>
                    <a href="{{ route('login') }}" class="hover:text-green-500">Login</a>
                </li>
                <li>
                    <a href="{{ route('register') }}" class="hover:text-green-500">Register</a>
                </li>
            @endauth
        </ul>
    </nav>

    <div class="container mx-auto mt-8">
        <h1 class="text-2xl font-bold mb-4">Gestion des Catégories</h1>
        
        <!-- Bouton Ajouter une catégorie -->
        <div class="mb-4">
            <a href="{{ route('admin.categories.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                Ajouter une catégorie
            </a>
        </div>
        
        <!-- Table des catégories -->
        <div class="overflow-x-auto mb-8 max-h-64 overflow-y-scroll">
            <table class="min-w-full bg-white fixed-header">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">ID</th>
                        <th class="py-2 px-4 border-b">Nom</th>
                        <th class="py-2 px-4 border-b">Description</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td class="py-2 px-4 border-b text-center">{{ $category->id }}</td>
                        <td class="py-2 px-4 border-b text-center">{{ $category->category_name }}</td>
                        <td class="py-2 px-4 border-b text-center">{{ $category->description }}</td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
