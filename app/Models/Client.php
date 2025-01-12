<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    /**
     * Les attributs pouvant être remplis via une requête.
     *
     * @var array
     */
    protected $fillable = [
        'id', // Correspond à l'ID de l'utilisateur associé
        'tour_poitrine',
        'tour_taille',
        'tour_hanches',
        'hauteur_totale',
        'longueur_bras',
        'tour_cou',
        'mesures_photo',
    ];

    /**
     * Relation avec le modèle User.
     * Un client appartient à un utilisateur.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id'); // La clé étrangère est `id`
    }

    /**
     * Relation avec le modèle Commande.
     * Un client peut avoir plusieurs commandes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function commandes()
    {
        return $this->hasMany(Commande::class, 'client_id');
    }

    /**
     * Relation avec le modèle AdresseLivraison.
     * Un client peut avoir plusieurs adresses de livraison.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function adressesLivraison()
    {
        return $this->hasMany(AdresseLivraison::class, 'client_id');
    }
}
