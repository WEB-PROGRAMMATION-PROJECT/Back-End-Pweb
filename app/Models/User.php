<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Ajout de l'authentification
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable // L'extension de Authenticatable est nécessaire
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'country',
        'city',
        'address',
        'user_type',
        'terms_accepted',
    ];

    // Relations
    public function stylist()
    {
        return $this->hasOne(Stylist::class);
    }

    public function client()
    {
        return $this->hasOne(Client::class);
    }

    // La méthode getAuthPassword permet de récupérer le mot de passe haché de l'utilisateur
    public function getAuthPassword()
    {
        return $this->password;
    }
}
