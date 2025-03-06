@extends('layouts.admin')

@section('title', 'Utilisateurs')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Utilisateurs</h1>
    <button class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#addUserModal">Nouveau Utilisateur</button>
    <div class="overflow-x-auto mb-8" style="max-height: 80vh;">
        <table id="usersTable" class="min-w-full bg-white table-fixed datatable">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b w-1/12 text-center">ID</th>
                    <th class="py-2 px-4 border-b w-3/12 text-center">Nom</th>
                    <th class="py-2 px-4 border-b w-3/12 text-center">Mail</th>
                    <th class="py-2 px-4 border-b w-2/12 text-center">Role</th>
                    <th class="py-2 px-4 border-b w-3/12 text-center">Operations</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td class="py-2 px-4 border-b text-center">{{ $user->id }}</td>
                    <td class="py-2 px-4 border-b text-center">{{ $user->name }}</td>
                    <td class="py-2 px-4 border-b text-center">{{ $user->email }}</td>
                    <td class="py-2 px-4 border-b text-center">{{ $user->user_role }}</td>
                    <td class="py-2 px-4 border-b text-center">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editUserModal" data-id="{{ $user->id }}" data-name="{{ $user->name }}" data-email="{{ $user->email }}" data-role="{{ $user->user_role }}">Edit</button>
                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteUserModal" data-id="{{ $user->id }}">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Add User Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Ajouter</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addUserForm" method="POST" action="{{ route('admin.users.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="addName" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="addName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="addEmail" class="form-label">Mail</label>
                            <input type="email" class="form-control" id="addEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="addRole" class="form-label">Role</label>
                            <select class="form-control" id="addRole" name="user_role" required>
                                <option value="admin">Admin</option>
                                <option value="user">Utilisateur</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="addPassword" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" id="addPassword" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="addPasswordConfirmation" class="form-label">Confirmation</label>
                            <input type="password" class="form-control" id="addPasswordConfirmation" name="password_confirmation" required>
                        </div>
                        <button type="submit" class="btn btn-success">Ajouter Utilisateur</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Modifier</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editUserForm" method="POST" action="">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="editName" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="editName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="editEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="editEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="editRole" class="form-label">Role</label>
                            <select class="form-control" id="editRole" name="user_role" required>
                                <option value="admin">Admin</option>
                                <option value="user">Utilisateur</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editPassword" class="form-label">Mot de Passe</label>
                            <input type="password" class="form-control" id="editPassword" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="editPasswordConfirmation" class="form-label">Confirmation</label>
                            <input type="password" class="form-control" id="editPasswordConfirmation" name="password_confirmation">
                        </div>
                        <button type="submit" class="btn btn-primary">Sauvgarder</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete User Modal -->
    <div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteUserModalLabel">Suprimer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Êtes vous sûr?</p>
                    <form id="deleteUserForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Suprimer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Edit User Modal
        var editUserModal = document.getElementById('editUserModal');
        editUserModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var id = button.getAttribute('data-id');
            var name = button.getAttribute('data-name');
            var email = button.getAttribute('data-email');
            var role = button.getAttribute('data-role');

            var modalTitle = editUserModal.querySelector('.modal-title');
            var editName = editUserModal.querySelector('#editName');
            var editEmail = editUserModal.querySelector('#editEmail');
            var editRole = editUserModal.querySelector('#editRole');
            var editUserForm = editUserModal.querySelector('#editUserForm');

            modalTitle.textContent = 'Edit User ' + name;
            editName.value = name;
            editEmail.value = email;
            editRole.value = role;
            editUserForm.action = '/admin/users/' + id;
        });

        // Delete User Modal
        var deleteUserModal = document.getElementById('deleteUserModal');
        deleteUserModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var id = button.getAttribute('data-id');

            var deleteUserForm = deleteUserModal.querySelector('#deleteUserForm');
            deleteUserForm.action = '/admin/users/' + id;
        });

        // Initialize DataTables
        $(document).ready(function() {
            $('#usersTable').DataTable({
                "pageLength": 25
            });
        });
    </script>
@endsection