<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tour_poitrine',
        'tour_taille',
        'tour_hanches',
        'hauteur_totale',
        'longueur_bras',
        'tour_cou',
        'largeur_dos',
        'longueur_jambe',
        'tour_cuisse',
        'tour_cheville',
        'tour_poignet',
        'largeur_poitrine',
        'longueur_clavicule',
        'mesures_photo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favoris()
    {
        return $this->belongsToMany(Modele::class, 'favoris');
    }

    public function adresseLivraisons()
    {
        return $this->hasMany(AdresseLivraison::class);
    }
}
