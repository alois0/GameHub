<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;



class ProfileController extends Controller
{



    public function index()
{
    $user = Auth::user(); // Récupérer l'utilisateur connecté

    $latestOrders = $user->orders()->latest()->take(3)->get(); // Récupérer les 3 dernières commandes

    // Récupérer l'adresse par défaut via la table pivot
    $defaultAddress = $user->addresses()
                          ->wherePivot('is_default', true) // Utiliser true pour l'adresse par défaut
                          ->first(); // Récupérer la première adresse par défaut

    return view('profile.index', compact('latestOrders', 'defaultAddress')); // Envoyer les données à la vue
}

    

    

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
{
    // Récupérer l'utilisateur connecté
    $user = $request->user();

    // Récupérer toutes les adresses de l'utilisateur
    $addresses = $user->addresses;

    // Récupérer l'adresse par défaut
    $defaultAddress = $user->addresses()->where('is_default', true)->first();

    // Retourner la vue avec les données
    return view('profile.edit', [
        'user' => $user,
        'addresses' => $addresses,
        'defaultAddress' => $defaultAddress,  // Adresse par défaut
    ]);
}


    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function updateDefaultAddress(Request $request)
{
    $user = $request->user(); // Récupérer l'utilisateur connecté
    $addressId = $request->input('address_id'); // ID de l'adresse sélectionnée

    // Réinitialiser toutes les adresses de l'utilisateur à "non par défaut"
    DB::table('address_user')
        ->where('user_id', $user->id)
        ->update(['is_default' => false]);

    // Mettre l'adresse spécifique comme par défaut
    DB::table('address_user')
        ->where('user_id', $user->id)
        ->where('address_id', $addressId)
        ->update(['is_default' => true]);

    return redirect()->route('profile.edit')->with('status', 'Adresse par défaut mise à jour');
}





    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
