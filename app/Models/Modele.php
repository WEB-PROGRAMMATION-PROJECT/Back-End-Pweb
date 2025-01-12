<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Modele extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * La table associée au modèle.
     *
     * @var string
     */
    protected $table = 'modeles';

    /**
     * Les attributs qui sont assignables en masse.
     *
     * @var array
     */
    protected $fillable = [
        'styliste_id',
        'categorie_id',
        'name',
        'description',
        'story',
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

    /**
     * Les relations de temps pour le modèle.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Les relations avec les autres modèles.
     */

    // Relation avec le styliste
    public function styliste()
    {
        return $this->belongsTo(Stylist::class, 'styliste_id');
    }

    // Relation avec la catégorie
    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'categorie_id');
    }
}
