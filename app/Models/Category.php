<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories'; // Nom de la table
    protected $primaryKey = 'category_id'; // Clé primaire personnalisée

    // Attributs assignables
    protected $fillable = [
        'category_name',
        'description',
    ];

    // Relation : Une catégorie peut avoir plusieurs produits
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}

