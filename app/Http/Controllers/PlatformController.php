<?php 


namespace App\Http\Controllers;

use App\Models\Platform;
use Illuminate\Http\Request;

class PlatformController extends Controller
{
    // Affiche la liste des plateformes
    public function index()
    {
        $platforms = Platform::all();
        return view('admin.platforms.index', compact('platforms'));
    }

    // Affiche le formulaire pour créer une nouvelle plateforme
    public function create()
    {
        return view('admin.platforms.create');
    }

    // Enregistre une nouvelle plateforme dans la base de données
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
        ]);

        Platform::create($request->all());
        return redirect()->route('admin.platforms.index')->with('success', 'Plateforme créée avec succès.');
    }

    // Affiche le formulaire pour modifier une plateforme
    public function edit(Platform $platform)
    {
        return view('admin.platforms.edit', compact('platform'));
    }

    // Met à jour une plateforme existante
    public function update(Request $request, Platform $platform)
    {
        $request->validate([
            'name' => 'required|string|max:50',
        ]);

        $platform->update($request->all());
        return redirect()->route('admin.platforms.index')->with('success', 'Plateforme mise à jour avec succès.');
    }

    // Supprime une plateforme
    public function destroy(Platform $platform)
    {
        $platform->delete();
        return redirect()->route('admin.platforms.index')->with('success', 'Plateforme supprimée avec succès.');
    }
}
