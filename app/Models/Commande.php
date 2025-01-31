<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Commande extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'reference',
        'client_id',
        'modele_id',
        'adresse_livraison_id',
        'state',
        'prix_total',
        'date_commande',
        'date_livraison_estimee',
        'status',
        'notes',
    ];

    /**
     * Relation : une commande appartient à un modèle.
     */
    public function modele()
    {
        return $this->belongsTo(Modele::class, 'modele_id');
    }
}
