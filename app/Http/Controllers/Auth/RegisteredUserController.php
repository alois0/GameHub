<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User; // Utilisation uniquement du modèle User
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
            'ville' => ['required', 'string', 'max:255'],
            'rue' => ['required', 'string', 'max:255'],
            'codepostal' => ['required', 'string', 'max:5'],
            'phone' => ['nullable', 'array'],
            'phone.*' => ['nullable', 'string', 'max:15', 'unique:phone,tel'],
        ]);
    
        // Création de l'utilisateur
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'ville' => $request->ville,
            'rue' => $request->rue,
            'codepostal' => $request->codepostal,
        ]);
    
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
