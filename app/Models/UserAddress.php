<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserAddress extends Pivot
{
    use HasFactory;

    protected $table = 'address_user'; // Vérifie bien le nom exact !
    
    public $timestamps = false; // Désactive les timestamps si absents dans la table

    protected $fillable = ['user_id', 'address_id', 'is_default'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id' );
    }

    public function addresses()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }
}
