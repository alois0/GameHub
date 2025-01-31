<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){

        $user = User::all();
        return view('users.index', compact('users'));
    }

    public function showAddresses()
{
    // Récupérer l'utilisateur connecté
    $user = auth()->user();

    // Récupérer les adresses associées
    $addresses = $user->addresses;

    // Passer les adresses à la vue
    return view('addresses.index', compact('addresses'));
}
}
