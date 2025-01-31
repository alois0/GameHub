<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Dashboard</title>
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
            <a class="hover:text-green-500">Admin</a>
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
        <h1 class="text-2xl font-bold mb-4">Dashboard</h1>
        <h2 class="text-xl font-bold mb-4">Liste des Utilisateurs</h2>
        <div class="overflow-x-auto mb-8 max-h-64 overflow-y-scroll">
            <table class="min-w-full bg-white fixed-header">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">ID</th>
                        <th class="py-2 px-4 border-b">Nom</th>
                       
                        <th class="py-2 px-4 border-b">Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td class="py-2 px-4 border-b text-center">{{ $user->id }}</td>
                        <td class="py-2 px-4 border-b text-center">{{ $user->name }}</td>

                        <td class="py-2 px-4 border-b text-center">{{ $user->email }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <h2 class="text-xl font-bold mb-4">Liste des Commandes</h2>
        <div class="overflow-x-auto max-h-64 overflow-y-scroll">
            <table class="min-w-full bg-white fixed-header">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">ID</th>
                        <th class="py-2 px-4 border-b">Date</th>
                        <th class="py-2 px-4 border-b">Statut</th>
                        <th class="py-2 px-4 border-b">Total</th>
                        <th class="py-2 px-4 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td class="py-2 px-4 border-b text-center">{{ $order->id }}</td>
                        <td class="py-2 px-4 border-b text-center">{{ $order->order_date }}</td>
                        <td class="py-2 px-4 border-b text-center">{{ $order->status }}</td>
                        <td class="py-2 px-4 border-b text-center">{{ number_format($order->total_price, 2) }} €</td>
                        <td class="py-2 px-4 border-b text-center">
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="text-blue-500 hover:text-blue-700">Voir les détails</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

         <!-- Section Catégories -->
         <h2 class="text-xl font-bold mb-4">Liste des Catégories</h2>
        <div class="overflow-x-auto max-h-64 overflow-y-scroll">
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
                        <td class="py-2 px-4 border-b text-center">{{ $category->category_id }}</td>
                        <td class="py-2 px-4 border-b text-center">{{ $category->category_name }}</td>
                        <td class="py-2 px-4 border-b text-center">{{ $category->description }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>



        <!-- Section Produits -->
        <h2 class="text-xl font-bold mb-4">Liste des Produits</h2>
        <div class="overflow-x-auto mb-8 max-h-64 overflow-y-scroll">
            <table class="min-w-full bg-white fixed-header">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">ID</th>
                        <th class="py-2 px-4 border-b">Nom</th>
                        <th class="py-2 px-4 border-b">Prix</th>
                        <th class="py-2 px-4 border-b">Catégorie</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td class="py-2 px-4 border-b text-center">{{ $product->id }}</td>
                        <td class="py-2 px-4 border-b text-center">{{ $product->product_name }}</td>
                        <td class="py-2 px-4 border-b text-center">{{ number_format($product->price, 2) }} €</td>
                        <td class="py-2 px-4 border-b text-center">{{ $product->category->category_name }}</td>

                       
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        

         <!-- Section Plateformes -->
         <h2 class="text-xl font-bold mb-4">Liste des Plateformes</h2>
        <div class="overflow-x-auto mb-8 max-h-64 overflow-y-scroll">
            <table class="min-w-full bg-white fixed-header">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">ID</th>
                        <th class="py-2 px-4 border-b">Nom</th>
                        <th class="py-2 px-4 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($platforms as $platform)
                    <tr>
                        <td class="py-2 px-4 border-b text-center">{{ $platform->id }}</td>
                        <td class="py-2 px-4 border-b text-center">{{ $platform->name }}</td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-8">
    <a href="{{ route('admin.categories.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
        Voir les Catégories
    </a>
</div>
    </div>
</body>
</html>
