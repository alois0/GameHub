<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    /**
     * Les champs pouvant être remplis.
     */
    protected $fillable = [
        'street_number',
        'street_name',
        'city',
        'postal_code',
    ];

    /**
     * Désactiver les timestamps automatiques.
     */
    public $timestamps = false;


    /**
     * Relation avec les utilisateurs (many-to-many via table pivot).
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'address_user')
                    ->withPivot('is_default');

    }
    

}
