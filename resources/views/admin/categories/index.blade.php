<!-- filepath: /c:/xampp/htdocs/GameHub/resources/views/admin/categories/index.blade.php -->
@extends('layouts.admin')

@section('title', 'Catégories')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Gestion des Catégories</h1>
    
    <!-- Bouton Ajouter une catégorie -->
    <div class="mb-4">
        <a href="{{ route('admin.categories.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
            Ajouter une catégorie
        </a>
    </div>
    
    <!-- Table des catégories -->
    <div class="overflow-x-auto mb-8 max-h-64 overflow-y-scroll">
        <table id="categoriesTable" class="min-w-full bg-white fixed-header">
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
@endsection