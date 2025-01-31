<?php

namespace App\Http\Controllers;

use App\Models\ProductReview;
use Illuminate\Http\Request;

class ProductReviewController extends Controller
{
    public function store(Request $request, $productId)
    {
        $request->validate([
            'review_text' => 'required|string|max:1000',
            'rating' => 'required|integer|between:1,5',
        ]);

        ProductReview::create([
            'product_id' => $productId,
            'user_id' => auth()->id(),
            'rating' => $request->input('rating'),
            'review_text' => $request->input('review_text'),
            'created_at' => now(),
        ]);

        return redirect()->route('products.show', $productId)->with('success', 'Votre avis a été ajouté.');
    }
}


