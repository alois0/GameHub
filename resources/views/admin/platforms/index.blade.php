@extends('layouts.admin')

@section('title', 'Platforms')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Platforms</h1>
    <button class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#addPlatformModal">Add Platform</button>

    <!-- Display Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
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

    <div class="overflow-x-auto mb-8" style="max-height: 80vh;">
        <table id="platformsTable" class="min-w-full bg-white table-fixed">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b w-1/12 text-center">ID</th>
                    <th class="py-2 px-4 border-b w-8/12 text-center">Name</th>
                    <th class="py-2 px-4 border-b w-3/12 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($platforms as $platform)
                <tr>
                    <td class="py-2 px-4 border-b text-center">{{ $platform->id }}</td>
                    <td class="py-2 px-4 border-b text-center">{{ $platform->name }}</td>
                    <td class="py-2 px-4 border-b text-center">
                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#viewProductsModal{{ $platform->id }}">View Products</button>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editPlatformModal{{ $platform->id }}">Edit</button>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletePlatformModal{{ $platform->id }}">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modals -->
    @foreach($platforms as $platform)
    <!-- View Products Modal -->
    <div class="modal fade" id="viewProductsModal{{ $platform->id }}" tabindex="-1" aria-labelledby="viewProductsModalLabel{{ $platform->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewProductsModalLabel{{ $platform->id }}">Products for {{ $platform->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5>Products:</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Price</th>
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
                    <h5 class="modal-title" id="editPlatformModalLabel{{ $platform->id }}">Edit Platform</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editPlatformForm{{ $platform->id }}" method="POST" action="{{ route('admin.platforms.update', $platform->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="editPlatformName{{ $platform->id }}" class="form-label">Name</label>
                            <input type="text" class="form-control" id="editPlatformName{{ $platform->id }}" name="name" value="{{ $platform->name }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
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
                    <h5 class="modal-title" id="deletePlatformModalLabel{{ $platform->id }}">Delete Platform</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this platform?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <form method="POST" action="{{ route('admin.platforms.destroy', $platform->id) }}" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete Platform</button>
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
                    <h5 class="modal-title" id="addPlatformModalLabel">Add Platform</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addPlatformForm" method="POST" action="{{ route('admin.platforms.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="addPlatformName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="addPlatformName" name="name" required>
                        </div>
                        <button type="submit" class="btn btn-success">Add Platform</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#platformsTable').DataTable({
                "pageLength": 25
            });
        });
    </script>
@endsection