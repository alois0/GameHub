<!-- filepath: /c:/xampp/htdocs/GameHub/resources/views/admin/products/index.blade.php -->
@extends('layouts.admin')

@section('title', 'Produits')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Produits</h1>
    <button class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#addProductModal">Add Product</button>

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

    <div class="overflow-x-auto mb-8" style="max-height: 80vh;">
        <table id="productsTable" class="min-w-full bg-white table-fixed">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b w-1/12 text-center">ID</th>
                    <th class="py-2 px-4 border-b w-2/12 text-center">Nom</th>
                    <th class="py-2 px-4 border-b w-3/12 text-center">Description</th>
                    <th class="py-2 px-4 border-b w-1/12 text-center">Prix</th>
                    <th class="py-2 px-4 border-b w-1/12 text-center">Quantité en stock</th>
                    <th class="py-2 px-4 border-b w-2/12 text-center">Catégorie</th>
                    <th class="py-2 px-4 border-b w-2/12 text-center">Actions</th>
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

    <!-- Add Product Modal -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addProductForm" method="POST" action="{{ route('admin.products.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="addProductName" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="addProductName" name="product_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="addProductDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="addProductDescription" name="description" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="addProductPrice" class="form-label">Prix</label>
                            <input type="number" step="0.01" class="form-control" id="addProductPrice" name="price" required>
                        </div>
                        <div class="mb-3">
                            <label for="addProductStock" class="form-label">Quantité en stock</label>
                            <input type="number" class="form-control" id="addProductStock" name="stock_quantity" required>
                        </div>
                        <div class="mb-3">
                            <label for="addProductCategory" class="form-label">Catégorie</label>
                            <select class="form-control" id="addProductCategory" name="category_id" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">Add Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Initialize DataTables
        $(document).ready(function() {
            $('#productsTable').DataTable({
                "pageLength": 25
            });
        });
    </script>
@endsection