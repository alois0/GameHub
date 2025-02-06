<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    use HasFactory;

    protected $primaryKey = 'platform_id'; // Specify custom primary key

    protected $fillable = ['platform_name', 'description'];

    public function products()
    {
        return $this->hasMany(Product::class, 'platform_id', 'platform_id'); // Specify foreign key and owner key
    }
}
