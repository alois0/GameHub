<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Platform;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Affiche tous les produits disponibles.
     */
    public function index()
    {
        // Récupérer tous les produits
        $products = Product::paginate(9);
        
        // Retourner la vue avec les produits
        return view('products.index', compact('products')); // Passer les produits à la vue
    }

    public function show($id)
    {
        $product = Product::with(['images','categories', 'platforms', 'reviews.user'])->findOrFail($id);

        // Fetch similar products based on the category of the current product
        $similarProducts = Product::whereHas('categories', function ($query) use ($product) {
            return $query->whereIn('categories.category_id', $product->categories->pluck('category_id'));
        })->where('id', '!=', $product->id)->take(5)->get();

        return view('products.show', compact('product', 'similarProducts'));
    }


    public function create()
    {
        $categories = Category::all();
        $platforms = Platform::all();
        return view('admin.products.create', compact('categories', 'platforms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|max:100',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'category_id' => 'required|exists:categories,category_id',
            'platforms' => 'required|array',
            'platforms.*' => 'exists:platforms,id',
        ]);

        $product = Product::create($request->all());
        $product->platforms()->attach($request->platforms);

        return redirect()->route('admin.products.index')->with('success', 'Produit créé avec succès.');
    }
    

   public function search(Request $request)
   {
       $query = $request->input('query');
       $products = Product::where('product_name', 'LIKE', "%{$query}%")
           ->orWhere('description', 'LIKE', "%{$query}%")
           ->paginate(9)
           ->appends(['query' => $query]);

       return view('products.index', compact('products'));
   }




}
