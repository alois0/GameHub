<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use App\Models\User;
use Illuminate\Http\Request;

class PhoneController extends Controller
{
    /**
     * Affiche tous les numéros associés à un utilisateur.
     */
    public function index($userId)
    {
        // Charge l'utilisateur avec ses numéros de téléphone
        $user = User::with('phones')->findOrFail($userId);

        return view('phone.index', compact('user'));
    }

    /**
     * Affiche le formulaire pour ajouter un ou plusieurs numéros.
     */
    public function create($userId)
    {
        $user = User::findOrFail($userId);

        return view('phone.create', compact('user'));
    }

    /**
     * Enregistre un ou plusieurs numéros pour un utilisateur.
     */
    public function store(Request $request, $userId)
    {
        $request->validate([
            'phones' => 'required|array|min:1', // Valide que des numéros sont fournis
            'phones.*' => 'required|string|max:15|unique:phone,tel', // Valide chaque numéro
        ]);

        $user = User::findOrFail($userId);

        // Ajout de chaque numéro de téléphone
        foreach ($request->phones as $phone) {
            $user->phones()->create([
                'tel' => $phone,
            ]);
        }

        return redirect()
            ->route('phones.index', $userId)
            ->with('success', 'Numéros ajoutés avec succès.');
    }

    /**
     * Ajoute dynamiquement un champ de téléphone au formulaire.
     */
    public function addPhone(Request $request)
    {
        // Récupère les téléphones existants ou initialise un tableau vide
        $phones = $request->input('phones', []);
        $phones[] = ''; // Ajoute un champ vide pour un nouveau numéro

        // Renvoie les anciens champs avec le nouveau champ ajouté
        return redirect()
            ->back()
            ->withInput(['phones' => $phones]);
    }

    /**
     * Affiche le formulaire pour modifier un numéro existant.
     */
    public function edit($phoneId)
    {
        // Charge le numéro à modifier
        $phone = Phone::findOrFail($phoneId);

        return view('phone.edit', compact('phone'));
    }

    /**
     * Met à jour un numéro de téléphone existant.
     */
    public function update(Request $request, $phoneId)
    {
        $phone = Phone::findOrFail($phoneId);

        $request->validate([
            'tel' => 'required|string|max:15|unique:phone,tel,' . $phoneId, // Valide le numéro
        ]);

        $phone->update([
            'tel' => $request->input('tel'),
        ]);

        return redirect()
            ->route('phones.index', $phone->user_id)
            ->with('success', 'Numéro mis à jour avec succès.');
    }

    /**
     * Supprime un numéro de téléphone.
     */
    public function destroy($phoneId)
    {
        $phone = Phone::findOrFail($phoneId);
        $userId = $phone->user_id;

        $phone->delete();

        return redirect()
            ->route('phones.index', $userId)
            ->with('success', 'Numéro supprimé avec succès.');
    }
}
