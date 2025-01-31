<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|unique:categories|max:50',
            'description' => 'nullable',
        ]);

        Category::create($request->all());
        return redirect()->route('admin.categories.index')->with('success', 'Catégorie créée avec succès.');
    }

    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'category_name' => 'required|max:50|unique:categories,category_name,' . $category->id,
            'description' => 'nullable',
        ]);

        $category->update($request->all());
        return redirect()->route('admin.categories.index')->with('success', 'Catégorie mise à jour avec succès.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Catégorie supprimée avec succès.');
    }
}
