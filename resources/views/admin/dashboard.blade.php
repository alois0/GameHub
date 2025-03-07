<!-- filepath: /c:/xampp/htdocs/GameHub/resources/views/admin/dashboard.blade.php -->
@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Administration</h1>

    <!-- Section Utilisateurs -->
    <h2 class="text-xl font-bold mb-4">Liste des Utilisateurs</h2>
    <div class="overflow-x-auto mb-8 max-h-64 overflow-y-scroll">
        <table id="usersTable" class="min-w-full bg-white fixed-header">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">ID</th>
                    <th class="py-2 px-4 border-b">Nom</th>
                    <th class="py-2 px-4 border-b">Email</th>
                    <th class="py-2 px-4 border-b">Role</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users ?? [] as $user)
                <tr>
                    <td class="py-2 px-4 border-b text-center">{{ $user->id }}</td>
                    <td class="py-2 px-4 border-b text-center">{{ $user->name }}</td>
                    <td class="py-2 px-4 border-b text-center">{{ $user->email }}</td>
                    <td class="py-2 px-4 border-b text-center">{{ $user->user_role }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Section Commandes -->
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
                @foreach($orders ?? [] as $order)
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
                @foreach($categories ?? [] as $category)
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
                    <th class="py-2 px-4 border-b">Catégories</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products ?? [] as $product)
                <tr>
                    <td class="py-2 px-4 border-b text-center">{{ $product->id }}</td>
                    <td class="py-2 px-4 border-b text-center">{{ $product->product_name }}</td>
                    <td class="py-2 px-4 border-b text-center">{{ number_format($product->price, 2) }} €</td>
                    <td class="py-2 px-4 border-b text-center">
                        @forelse($product->categories as $category)
                            {{ $category->category_name }}{{ !$loop->last ? ', ' : '' }}
                        @empty
                            <span class="text-gray-500">Non catégorisé</span>
                        @endforelse
                    </td>
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
                </tr>
            </thead>
            <tbody>
                @foreach($platforms ?? [] as $platform)
                <tr>
                    <td class="py-2 px-4 border-b text-center">{{ $platform->id }}</td>
                    <td class="py-2 px-4 border-b text-center">{{ $platform->name }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection