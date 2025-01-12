<?php

namespace App\Http\Controllers;

use App\Models\Client;
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
        $clients = Client::all();
        return response()->json($clients);
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
        // Validation des données reçues dans la requête
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'tour_poitrine' => 'required|numeric',
            'tour_taille' => 'required|numeric',
            'tour_hanches' => 'required|numeric',
        ]);

        // Création d'un nouvel utilisateur pour le client
        $user = User::create([
            'nom' => $validatedData['nom'],
            'prenom' => $validatedData['prenom'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'password' => bcrypt(''),
            'type' => 'client',
        ]);

        // Création du client associé à l'utilisateur
        $client = Client::create([
            'id' => $user->id,
            'tour_poitrine' => $validatedData['tour_poitrine'],
            'tour_taille' => $validatedData['tour_taille'],
            'tour_hanches' => $validatedData['tour_hanches'],
        ]);

        // Retourner une réponse avec les détails du client créé
        return response()->json([
            'success' => true,
            'data' => $client
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        // Charger les relations du client (ex : commandes)
        $client->load('user', 'commandes'); // Assurez-vous que ces relations sont définies dans le modèle Client

        // Retourner les données du client
        return response()->json([
            'success' => true,
            'data' => $client
        ], 200);
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
}
