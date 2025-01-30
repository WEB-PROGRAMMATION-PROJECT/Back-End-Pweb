<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modele extends Model
{
    use HasFactory;

    protected $table = 'modeles';
    
    // Colonnes modifiables
    protected $fillable = [
        'styliste_id',
        'categorie_id',
        'name',
        'description',
        'story',
        'materiaux_ids',
        'points',
        'status',
        'prix_min',
        'prix_max',
        'devise',
        'temps_min',
        'temps_max',
        'unite_temps',
        'styles',
        'image1',
        'image2',
        'image3',
        'image4',
        'image5',
    ];

    // Colonnes qui doivent être traitées comme des dates
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    // Relations avec le modèle Styliste
    public function user()
    {
        return $this->belongsTo(User::class, 'styliste_id');
    }

    // Relations avec le modèle Categorie
    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'categorie_id');
    }
    public function materiaux()
    {
        return $this->belongsToMany(Materiaux::class, 'materiaux_ids');
                      // Sélectionner uniquement l'ID des matériaux
    }

}
