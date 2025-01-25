<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stylist extends Model
{
    protected $table = 'stylistes'; // Assurez-vous que cela correspond à la table dans la base de données
    protected $fillable = [
        'user_id',
        'phone_number',
        'specializations',
        'description',
        'profile_picture_url',
    ];
}
