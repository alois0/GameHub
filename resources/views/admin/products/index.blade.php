<!-- filepath: /c:/xampp/htdocs/GameHub/resources/views/admin/products/index.blade.php -->
@extends('layouts.admin')

@section('title', 'Produits')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Produits</h1>
    <div class="overflow-x-auto mb-8 max-h-64 overflow-y-scroll">
        <table id="productsTable" class="min-w-full bg-white fixed-header">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">ID</th>
                    <th class="py-2 px-4 border-b">Nom</th>
                    <th class="py-2 px-4 border-b">Description</th>
                    <th class="py-2 px-4 border-b">Prix</th>
                    <th class="py-2 px-4 border-b">Quantité en stock</th>
                    <th class="py-2 px-4 border-b">Catégorie</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td class="py-2 px-4 border-b text-center">{{ $product->id }}</td>
                    <td class="py-2 px-4 border-b text-center">{{ $product->product_name }}</td>
                    <td class="py-2 px-4 border-b text-center">{{ $product->description }}</td>
                    <td class="py-2 px-4 border-b text-center">{{ number_format($product->price, 2) }} €</td>
                    <td class="py-2 px-4 border-b text-center">{{ $product->stock_quantity }}</td>
                    <td class="py-2 px-4 border-b text-center">{{ $product->category ? $product->category->category_name : 'Non catégorisé' }}</td>
                    <td class="py-2 px-4 border-b text-center">
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection