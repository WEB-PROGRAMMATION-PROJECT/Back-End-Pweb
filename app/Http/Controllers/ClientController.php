<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
    }
    public function getClientDetails($id)
    {
        // Récupérer l'ID de l'utilisateur connecté


        // Trouver le client associé à cet utilisateur
        $client = Client::where('user_id', $id)->first();

        if ($client) {
            return response()->json([
                'status' => 'success',
                'data' => $client
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Client non trouvé.'
            ], 404);
        }
    }
    public function saveMeasurements(Request $request)
    {
        // Validation des données
        $request->validate([
            'tour_poitrine' => 'required|numeric',
            'tour_taille' => 'required|numeric',
            'tour_hanches' => 'required|numeric',
            'hauteur_totale' => 'required|numeric',
            'longueur_bras' => 'required|numeric',
            'tour_cou' => 'required|numeric',
            'largeur_dos' => 'required|numeric',
            'longueur_jambe' => 'required|numeric',
            'tour_cuisse' => 'required|numeric',
            'tour_cheville' => 'required|numeric',
            'tour_poignet' => 'required|numeric',
            'largeur_poitrine' => 'required|numeric',
            'longueur_clavicule' => 'required|numeric',
            'mesures_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Récupérer l'ID de l'utilisateur envoyé depuis Angular
        $userId = $request->input('user_id'); // L'ID envoyé dans la requête

        // Gestion de l'upload de la photo (si présente)
        $photoPath = null;
        if ($request->hasFile('mesures_photo')) {
            $photoPath = $request->file('mesures_photo')->store('measurements_photos', 'public');
        }

        // Recherche du client existant pour cet utilisateur
        $client = Client::where('user_id', $userId)->first();

        if ($client) {
            // Mise à jour des données si le client existe
            $client->tour_poitrine = $request->tour_poitrine;
            $client->tour_taille = $request->tour_taille;
            $client->tour_hanches = $request->tour_hanches;
            $client->hauteur_totale = $request->hauteur_totale;
            $client->longueur_bras = $request->longueur_bras;
            $client->tour_cou = $request->tour_cou;
            $client->largeur_dos = $request->largeur_dos;
            $client->longueur_jambe = $request->longueur_jambe;
            $client->tour_cuisse = $request->tour_cuisse;
            $client->tour_cheville = $request->tour_cheville;
            $client->tour_poignet = $request->tour_poignet;
            $client->largeur_poitrine = $request->largeur_poitrine;
            $client->longueur_clavicule = $request->longueur_clavicule;

            // Mise à jour de la photo si présente
            if ($photoPath) {
                $client->mesures_photo = $photoPath;
            }

            $client->save(); // Sauvegarde des modifications
        } else {
            // Création d'un nouveau client si aucun n'existe
            return response()->json([
                'message' => 'Client introuvable. Veuillez vérifier l\'ID utilisateur.',
            ], 404);
        }

        return response()->json(['message' => 'Mesures enregistrées avec succès'], 200);
    }


    public function updateClientDetails(Request $request, $userId)
    {
        $client = Client::where('user_id', $userId)->first();

        if (!$client) {
            return response()->json([
                'status' => 'error',
                'message' => 'Client non trouvé'
            ], 404);
        }

        // Validation des données envoyées (vous pouvez ajuster les règles de validation)
        $validatedData = $request->validate([
            'bust' => 'nullable|numeric',
            'waist' => 'nullable|numeric',
            'hips' => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'armLength' => 'nullable|numeric',
            'neckCircumference' => 'nullable|numeric',
            'backWidth' => 'nullable|numeric',
            'legLength' => 'nullable|numeric',
            'thighCircumference' => 'nullable|numeric',
            'ankleCircumference' => 'nullable|numeric',
            'wristCircumference' => 'nullable|numeric',
            'chestWidth' => 'nullable|numeric',
            'clavicleLength' => 'nullable|numeric',
            // Autres validations nécessaires
        ]);

        // Mise à jour des données du client
        $client->update($validatedData);

        return response()->json([
            'status' => 'success',
            'message' => 'Données mises à jour avec succès',
            'data' => $client
        ]);
    }
}
