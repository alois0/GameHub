@extends('layouts.admin')

@section('title', 'Catégories')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Catégories</h1>
    <button class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#addCategoryModal">Ajouter</button>
    <div class="overflow-x-auto mb-8" style="max-height: 80vh;">
        <table id="categoriesTable" class="min-w-full bg-white table-fixed">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b w-1/12 text-center">ID</th>
                    <th class="py-2 px-4 border-b w-3/12 text-center">Nom</th>
                    <th class="py-2 px-4 border-b w-4/12 text-center">Description</th>
                    <th class="py-2 px-4 border-b w-2/12 text-center">Image</th>
                    <th class="py-2 px-4 border-b w-2/12 text-center">Operations</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td class="py-2 px-4 border-b text-center">{{ $category->id }}</td>
                    <td class="py-2 px-4 border-b text-center">{{ $category->category_name }}</td>
                    <td class="py-2 px-4 border-b text-center">{{ $category->description }}</td>
                    <td class="py-2 px-4 border-b text-center">
                        @if($category->category_image)
                            <img src="{{ asset('image/' . $category->category_image) }}" alt="{{ $category->category_image }}" class="w-16 h-16 object-cover">
                        @else
                            No Image
                        @endif
                    </td>
                    <td class="py-2 px-4 border-b text-center">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editCategoryModal" data-id="{{ $category->id }}" data-name="{{ $category->category_name }}" data-description="{{ $category->description }}" data-image="{{ $category->category_image }}">Modifier</button>
                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteCategoryModal" data-id="{{ $category->id }}">Supprimer</button>
                        </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Add Category Modal -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalLabel">Ajouter</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addCategoryForm" method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="addCategoryName" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="addCategoryName" name="category_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="addCategoryDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="addCategoryDescription" name="description" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="addCategoryImage" class="form-label">Image</label>
                            <input type="file" class="form-control" id="addCategoryImage" name="category_image">
                        </div>
                        <button type="submit" class="btn btn-success">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Category Modal -->
    <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCategoryModalLabel">Modifier</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editCategoryForm" method="POST" action="" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="editCategoryName" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="editCategoryName" name="category_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="editCategoryDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="editCategoryDescription" name="description" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="editCategoryImage" class="form-label">Image</label>
                            <input type="file" class="form-control" id="editCategoryImage" name="category_image">
                        </div>
                        <button type="submit" class="btn btn-primary">Sauvegarder</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Category Modal -->
    <div class="modal fade" id="deleteCategoryModal" tabindex="-1" aria-labelledby="deleteCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteCategoryModalLabel">Supprimer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Êtes vous sûre ? </p>
                    <form id="deleteCategoryForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Edit Category Modal
        var editCategoryModal = document.getElementById('editCategoryModal');
        editCategoryModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var id = button.getAttribute('data-id');
            var name = button.getAttribute('data-name');
            var description = button.getAttribute('data-description');
            var image = button.getAttribute('data-image');

            var modalTitle = editCategoryModal.querySelector('.modal-title');
            var editName = editCategoryModal.querySelector('#editCategoryName');
            var editDescription = editCategoryModal.querySelector('#editCategoryDescription');
            var editCategoryForm = editCategoryModal.querySelector('#editCategoryForm');

            modalTitle.textContent = 'Modifier Catégorie ' + name;
            editName.value = name;
            editDescription.value = description;
            editCategoryForm.action = '/admin/categories/' + id;
        });

        // Delete Category Modal
        var deleteCategoryModal = document.getElementById('deleteCategoryModal');
        deleteCategoryModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var id = button.getAttribute('data-id');

            var deleteCategoryForm = deleteCategoryModal.querySelector('#deleteCategoryForm');
            deleteCategoryForm.action = '/admin/categories/' + id;
        });

        // Initialize DataTables
        $(document).ready(function() {
            $('#categoriesTable').DataTable({
                "pageLength": 25
            });
        });
    </script>
@endsection