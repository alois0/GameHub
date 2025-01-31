<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    use HasFactory;

    protected $table = 'product_reviews'; // Nom de la table
    public $timestamps = false; // Désactiver les timestamps automatiques (créés manuellement)
    protected $fillable = [
        'product_id',
        'user_id',
        'rating',
        'review_text',
        'created_at',
    ];

    // Relation avec le produit
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
