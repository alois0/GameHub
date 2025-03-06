
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
                    <td class="py-2 px-4 border-b text-center">
                        @foreach($product->categories as $category)
                            {{ $category->category_name }}
                        @endforeach
                    </td>
                    <td class="py-2 px-4 border-b text-center">
                        <button type="button" class="text-blue-500 hover:text-blue-700" data-bs-toggle="modal" data-bs-target="#editProductModal{{ $product->id }}">Edit</button>

                        <!-- Edit Product Modal -->
                        <div class="modal fade" id="editProductModal{{ $product->id }}" tabindex="-1" aria-labelledby="editProductModalLabel{{ $product->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editProductModalLabel{{ $product->id }}">Edit Product</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="editProductForm{{ $product->id }}" method="POST" action="{{ route('admin.products.update', $product->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label for="editProductName{{ $product->id }}" class="form-label">Nom</label>
                                                <input type="text" class="form-control" id="editProductName{{ $product->id }}" name="product_name" value="{{ $product->product_name }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="editProductDescription{{ $product->id }}" class="form-label">Description</label>
                                                <textarea class="form-control" id="editProductDescription{{ $product->id }}" name="description" required>{{ $product->description }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="editProductPrice{{ $product->id }}" class="form-label">Prix</label>
                                                <input type="number" step="0.01" class="form-control" id="editProductPrice{{ $product->id }}" name="price" value="{{ $product->price }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="editProductStock{{ $product->id }}" class="form-label">Quantité en stock</label>
                                                <input type="number" class="form-control" id="editProductStock{{ $product->id }}" name="stock_quantity" value="{{ $product->stock_quantity }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="editProductCategory{{ $product->id }}" class="form-label">Catégorie</label>
                                                <select class="form-control" id="editProductCategory{{ $product->id }}" name="category_id[]" multiple required>
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->category_id }}" {{ $product->categories->contains($category->category_id) ? 'selected' : '' }}>{{ $category->category_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div></div>
                        <button type="button" class="text-red-500 hover:text-red-700" data-bs-toggle="modal" data-bs-target="#deleteProductModal{{ $product->id }}">Delete</button>
                        <div class="modal fade" id="deleteProductModal{{ $product->id }}" tabindex="-1" aria-labelledby="deleteProductModalLabel{{ $product->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteProductModalLabel{{ $product->id }}">Delete Product</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete this product?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                        <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete Product</button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                        
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
                            <select class="form-control" id="addProductCategory" name="category_id[]" multiple required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
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

    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this product?');
        }
    </script>
@endsection