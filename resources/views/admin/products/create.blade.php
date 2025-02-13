<!-- filepath: /c:/xampp/htdocs/GameHub/resources/views/admin/products/create.blade.php -->
@extends('layouts.admin')

@section('title', 'Créer un Produit')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Créer un Produit</h1>
    <form method="POST" action="{{ route('admin.products.store') }}">
        @csrf
        <div class="mb-4">
            <label for="product_name" class="block text-gray-700 font-bold mb-2">Nom du produit :</label>
            <input type="text" name="product_name" id="product_name" class="block w-full bg-white border border-gray-300 rounded py-2 px-4" required>
        </div>
        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-bold mb-2">Description :</label>
            <textarea name="description" id="description" class="block w-full bg-white border border-gray-300 rounded py-2 px-4"></textarea>
        </div>
        <div class="mb-4">
            <label for="price" class="block text-gray-700 font-bold mb-2">Prix :</label>
            <input type="number" step="0.01" name="price" id="price" class="block w-full bg-white border border-gray-300 rounded py-2 px-4" required>
        </div>
        <div class="mb-4">
            <label for="stock_quantity" class="block text-gray-700 font-bold mb-2">Quantité en stock :</label>
            <input type="number" name="stock_quantity" id="stock_quantity" class="block w-full bg-white border border-gray-300 rounded py-2 px-4" required>
        </div>
        <div class="mb-4">
            <label for="category_id" class="block text-gray-700 font-bold mb-2">Catégorie :</label>
            <select name="category_id" id="category_id" class="block w-full bg-white border border-gray-300 rounded py-2 px-4" required>
                @foreach($categories as $category)
                    <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="platforms" class="block text-gray-700 font-bold mb-2">Plateformes :</label>
            <select name="platforms[]" id="platforms" class="block w-full bg-white border border-gray-300 rounded py-2 px-4" multiple required>
                @foreach($platforms as $platform)
                    <option value="{{ $platform->id }}">{{ $platform->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Créer</button>
    </form>
@endsection