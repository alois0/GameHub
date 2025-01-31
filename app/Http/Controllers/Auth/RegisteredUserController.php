<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User; // Utilisation uniquement du modèle User
use App\Models\Address;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Affiche le formulaire d'enregistrement.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Gère l'enregistrement d'un nouvel utilisateur ou ajoute un champ téléphone.
     */
    public function store(Request $request): RedirectResponse
    {
        // Si l'utilisateur clique sur "Ajouter un autre numéro"
        if ($request->input('action') === 'add_phone') {
            $phones = $request->input('phone', []); // Récupère les numéros existants
            $phones[] = ''; // Ajoute un nouveau champ vide
    
            // Recharge la vue avec les champs existants et le nouveau champ
            return back()->withInput($request->except('action'))->withInput(['phone' => $phones]);
        }
    
        // Validation et enregistrement lors du clic sur "Enregistrer"
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'street_number' => 'required|string|max:10',
            'street_name' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'postal_code' => 'required|numeric|digits:5',
            'phone' => ['nullable', 'array'],
            'phone.*' => ['nullable', 'string', 'max:15', 'unique:phone,tel'],
        ]);
    
        // Création de l'utilisateur
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),

        ]);

        // Création de l'adresse
        $address = Address::create([
        'street_number' => $request->street_number,
        'street_name' => $request->street_name,
        'city' => $request->city,
        'postal_code' => $request->postal_code,
    ]);

    // Associer l'utilisateur à l'adresse via la table pivot avec "is_default"
    $user->addresses()->attach($address->id, ['is_default' => true]);
    
        // Ajout des téléphones
        if ($request->has('phone')) {
            foreach ($request->phone as $tel) {
                if (!empty($tel)) {
                    $user->phones()->create(['tel' => $tel]);
                }
            }
        }
    
        event(new Registered($user));
        Auth::login($user);
    
        return redirect()->route('home')->with('success', 'Utilisateur enregistré avec succès.');
    }
    

}
