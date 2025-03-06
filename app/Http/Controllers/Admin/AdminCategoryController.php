<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminCategoryController extends Controller
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
            'category_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = null;
        if ($request->hasFile('category_image')) {
            $image = $request->file('category_image');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('image'), $imageName);
        }

        Category::create([
            'category_name' => $request->category_name,
            'description' => $request->description,
            'category_image' => $request->$imageName,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $category = Category::findOrFail($id);

        $imageName = $category->category_image;
        if ($request->hasFile('category_image')) {
            // Delete the old image if it exists
            if ($category->category_image) {
                Storage::disk('public')->delete('image/' . $category->category_image);
            }
            $image = $request->file('category_image');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('image'), $imageName);
        }

        $category->update([
            'category_name' => $request->category_name,
            'description' => $request->description,
            'category_image' => $imageName,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        if ($category->category_image) {
            Storage::disk('public')->delete('image/' . $category->category_image);
        }
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}