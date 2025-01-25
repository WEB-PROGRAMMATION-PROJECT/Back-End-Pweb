<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $commades = Commande::with(['client', 'styliste', 'modele'])->get();

        return response()->json($commades);
    }

    /**
     * Display the specified resource.
     *
     * @param  \int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $commande = Commande::with(['client', 'styliste', 'modele'])->findOrFail($id);
        return response()->json($commande);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:users,id',
            'styliste_id' => 'required|exists:users,id',
            'modele_id' => 'required|exists:modeles,id',
            'adresse_livraison_id' => 'required|exists:adresse_livraisons,id',
            'prix_total' => 'required|numeric|min:0',
            'notes' => 'nullable|string|max:255',
        ]);

        // Génération d'une référence unique pour la commande
        $reference = 'CMD-' . strtoupper(uniqid());

        // Création de la commande
        $commande = Commande::create(array_merge($validated, [
            'reference' => $reference,
            'state' => 0,
            'date_commande' => now(),
            'status' => 'pending',
        ]));

        return response()->json(['message' => 'Commande créée avec succès', 'commande' => $commande], 201);
        // return response()->json(['message' => 'Requête reçue'], 200);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $commande = Commande::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:pending,in_progress,completed,cancelled',
        ]);

        $commande->update(['status' => $validated['status']]);

        return response()->json(['message' => 'Commande mise à jour avec succès', 'commande' => $commande]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $commande
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $commande = Commande::findOrFail($id);

        $commande->delete();

        return response()->json(['message' => 'Commande supprimée avec succès']);
    }

    /**
     * Récupère les commandes d'un styliste spécifique.
     *
     * @param int $stylistId
     * @return \Illuminate\Http\Response
     */
    public function getByStylist($stylistId)
    {
        $commandes = Commande::whereHas('modele', function ($query) use ($stylistId) {
            $query->where('styliste_id', $stylistId);
        })->with(['client:id,first_name', 'client:id,tour_poitrine', 'client:id,tour_taille', 'client:id,tour_hanches', 'client:id,hauteur', 'modele:id,name', 'modele:id,image1'])->get();

        if ($commandes->isEmpty()) {
            return response()->json([
                'message' => 'Aucune commande trouvée pour ce styliste.',
            ], 404);
        }

        return response()->json($commandes, 200);
    }


    /**
     * Récupère les commandes d'un client spécifique.
     *
     * @param int $clientId
     * @return \Illuminate\Http\Response
     */
    public function getByClient($clientId)
    {
        $commandes = Commande::where('client_id', $clientId)->get();

        if ($commandes->isEmpty()) {
            return response()->json([
                'message' => 'Aucune commande trouvée pour ce client.',
            ], 404);
        }

        return response()->json($commandes, 200);
    }


}
