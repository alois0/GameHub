<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\AddressUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    /**
     * Afficher la liste des adresses de l'utilisateur.
     */
    public function index()
    {
        $user = Auth::user();
        $addresses = $user->addresses; // Récupère toutes les adresses de l'utilisateur

        return view('addresses.index', compact('addresses'));
    }

    /**
     * Afficher le formulaire pour créer une nouvelle adresse.
     */
    public function create()
    {
        return view('addresses.create');
    }

    /**
     * Enregistrer une nouvelle adresse dans la base de données.
     */
    public function store(Request $request)
    {
        $request->validate([
            'street_number' => 'required|string|max:10',
            'street_name' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'postal_code' => 'required|numeric|digits:5',
        ]);

        $user = Auth::user();

        // Créer ou récupérer une adresse
        $address = Address::firstOrCreate([
            'street_number' => $request->street_number,
            'street_name' => $request->street_name,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
        ]);

        // Lier l'adresse à l'utilisateur avec "is_default"
        $user->addresses()->attach($address->id, [
            'is_default' => $request->has('is_default'),
        ]);

        // Si c'est l'adresse par défaut, mettre à jour les autres
        if ($request->has('is_default')) {
            $user->addresses()->where('id', '!=', $address->id)->update(['is_default' => false]);
        }

        return redirect()->route('addresses.index')->with('success', 'Adresse ajoutée avec succès');
    }

    /**
     * Afficher le formulaire pour modifier une adresse existante.
     */
    public function edit(Address $address)
    {
        return view('addresses.edit', compact('address'));
    }

    /**
     * Mettre à jour une adresse existante dans la base de données.
     */
    public function update(Request $request, Address $address)
    {
        $request->validate([
            'street_number' => 'required|string|max:10',
            'street_name' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'postal_code' => 'required|numeric|digits:5',
        ]);

        $address->update([
            'street_number' => $request->street_number,
            'street_name' => $request->street_name,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
        ]);

        return redirect()->route('addresses.index')->with('success', 'Adresse mise à jour avec succès');
    }

    /**
     * Supprimer une adresse de la base de données.
     */
    public function destroy(Address $address)
    {
        $user = Auth::user();

        // Détacher l'adresse de l'utilisateur connecté
        $user->addresses()->detach($address->id);

        // Supprimer l'adresse si elle n'est liée à aucun utilisateur
        if ($address->users()->count() == 0) {
            $address->delete();
        }

        return redirect()->route('addresses.index')->with('success', 'Adresse supprimée avec succès');
    }
}
