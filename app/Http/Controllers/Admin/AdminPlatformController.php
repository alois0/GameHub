<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Platform;
use Illuminate\Http\Request;

class AdminPlatformController extends Controller
{
    public function index()
    {
        $platforms = Platform::all();
        return view('admin.platforms.index', compact('platforms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
        ]);

        Platform::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.platforms.index')->with('success', 'Platform created successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:50',
        ]);

        $platform = Platform::findOrFail($id);
        $platform->name = $request->input('name');
        $platform->save();

        return redirect()->route('admin.platforms.index')->with('success', 'Platform updated successfully.');
    }

    public function destroy($id)
    {
        $platform = Platform::findOrFail($id);
        $platform->delete();

        return redirect()->route('admin.platforms.index')->with('success', 'Platform deleted successfully.');
    }
}