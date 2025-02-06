<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $primaryKey = 'category_id'; // Specify custom primary key

    protected $fillable = ['category_name', 'description'];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'category_id'); // Specify foreign key and owner key
    }
}
