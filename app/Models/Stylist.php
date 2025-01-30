<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stylist extends Model
{
    use HasFactory;

    // Déclarer les champs mass-assignables
    protected  $table = "stylistes";
    protected $fillable = [
        'user_id',
        'phone_number',
        'collections',
        'description',
        'titre',
        'specializations',
        'social_links',
        'profile_picture_url',
        'cover_image_url',
    ];

    /**
     * Relation : Un styliste appartient à un utilisateur.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
