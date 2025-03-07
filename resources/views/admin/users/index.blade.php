@extends('layouts.admin')

@section('title', 'Utilisateurs')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Utilisateurs</h1>
    <button class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#addUserModal">Ajouter</button>
    
    @component('components.admin-table', [
        'id' => 'usersTable',
        'headers' => ['ID', 'Nom', 'Mail', 'Role', 'Operations']
    ])
        @slot('slot')
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
        @endslot
    @endcomponent

    <!-- Add User Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addUserForm" method="POST" action="{{ route('admin.users.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="addName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="addName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="addEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="addEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="addRole" class="form-label">Role</label>
                            <select class="form-control" id="addRole" name="user_role" required>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="addPassword" class="form-label">Mot de Passe</label>
                            <input type="password" class="form-control" id="addPassword" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="addPasswordConfirmation" class="form-label">Confirmer</label>
                            <input type="password" class="form-control" id="addPasswordConfirmation" name="password_confirmation" required>
                        </div>
                        <button type="submit" class="btn btn-success">Ajouter</button>
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
                            <label for="editEmail" class="form-label">Mail</label>
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
                            <label for="editPassword" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" id="editPassword" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="editPasswordConfirmation" class="form-label">Confirmer</label>
                            <input type="password" class="form-control" id="editPasswordConfirmation" name="password_confirmation">
                        </div>
                        <button type="submit" class="btn btn-primary">Sauvegarder</button>
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
                    <h5 class="modal-title" id="deleteUserModalLabel">Supprimer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Êtes vous sûr ? </p>
                    <form id="deleteUserForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection