<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Les attributs qui peuvent être massivement assignés.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'ville',
        'rue',
        'codepostal',
    ];

    /**
     * Les attributs masqués pour la sérialisation.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Les attributs qui doivent être castés.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Relation : Un utilisateur peut avoir plusieurs numéros de téléphone.
     */
    public function phones()
    {
        return $this->hasMany(Phone::class);
    }
}
