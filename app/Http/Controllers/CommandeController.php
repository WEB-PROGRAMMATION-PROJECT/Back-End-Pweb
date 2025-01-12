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
        $commades = Commande::all();
        return response()->json($commades);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        ]);

        $commande = Commande::create(array_merge($validated, ['status' => 'pending']));

        return response()->json(['message' => 'Commande créée avec succès', 'commande' => $commande], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function show(Commande $commande)
    {
        return response()->json($commande);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function edit(Commande $commande)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Commande $commande)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,in_progress,completed,cancelled',
        ]);

        $commande->update(['status' => $validated['status']]);

        return response()->json(['message' => 'Commande mise à jour avec succès', 'commande' => $commande]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commande $commande)
    {
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
        })->get();

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
