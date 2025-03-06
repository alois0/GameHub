@extends('layouts.admin')

@section('title', 'Platformes')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Platformes</h1>
    <button class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#addPlatformModal">Ajouter</button>

    <!-- Display Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Display Validation Errors -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <x-admin-table id="platformsTable" :headers="['ID', 'Nom', 'Operations']">
        @foreach($platforms as $platform)
        <tr>
            <td class="py-2 px-4 border-b text-center">{{ $platform->id }}</td>
            <td class="py-2 px-4 border-b text-center">{{ $platform->name }}</td>
            <td class="py-2 px-4 border-b text-center">
                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#viewProductsModal{{ $platform->id }}">Voir Produits</button>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editPlatformModal{{ $platform->id }}">Modifier</button>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletePlatformModal{{ $platform->id }}">Supprimer</button>
            </td>
        </tr>
        @endforeach
    </x-admin-table>

    <!-- Modals -->
    @foreach($platforms as $platform)
    <!-- View Products Modal -->
    <div class="modal fade" id="viewProductsModal{{ $platform->id }}" tabindex="-1" aria-labelledby="viewProductsModalLabel{{ $platform->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewProductsModalLabel{{ $platform->id }}">Produits pour {{ $platform->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5>Produits : </h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Description</th>
                                <th>Prix</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($platform->products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $product->description }}</td>
                                <td>{{ number_format($product->price, 2) }} €</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Platform Modal -->
    <div class="modal fade" id="editPlatformModal{{ $platform->id }}" tabindex="-1" aria-labelledby="editPlatformModalLabel{{ $platform->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPlatformModalLabel{{ $platform->id }}">Modifier</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editPlatformForm{{ $platform->id }}" method="POST" action="{{ route('admin.platforms.update', $platform->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="editPlatformName{{ $platform->id }}" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="editPlatformName{{ $platform->id }}" name="name" value="{{ $platform->name }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Sauvegarder</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Platform Modal -->
    <div class="modal fade" id="deletePlatformModal{{ $platform->id }}" tabindex="-1" aria-labelledby="deletePlatformModalLabel{{ $platform->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deletePlatformModalLabel{{ $platform->id }}">Supprimer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Êtes vous sûre ? </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
                    <form method="POST" action="{{ route('admin.platforms.destroy', $platform->id) }}" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Add Platform Modal -->
    <div class="modal fade" id="addPlatformModal" tabindex="-1" aria-labelledby="addPlatformModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPlatformModalLabel">Ajouter</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addPlatformForm" method="POST" action="{{ route('admin.platforms.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="addPlatformName" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="addPlatformName" name="name" required>
                        </div>
                        <button type="submit" class="btn btn-success">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection