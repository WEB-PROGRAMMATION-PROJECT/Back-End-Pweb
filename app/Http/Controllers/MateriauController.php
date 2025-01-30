<?php

namespace App\Http\Controllers;

use App\Models\Materiaux;
use Illuminate\Http\Request;

class MateriauController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Récupérer tous les matériaux
        $materiaux = Materiaux::all();

        // Retourner les matériaux en réponse JSON
        return response()->json($materiaux);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showByIds(Request $request)
    {
        // Récupérer les IDs des matériaux directement du corps de la requête
        $ids = $request->input('materiaux_ids'); // { "materiaux_ids": [1, 2, 3] }

        // Vérifier si l'array d'IDs est valide
        if (!is_array($ids) || empty($ids)) {
            return response()->json(['error' => 'IDs invalides ou manquants'], 400);
        }

        // Récupérer les matériaux correspondant aux IDs
        $materiaux = Materiaux::whereIn('id', $ids)->get();

        // Retourner les matériaux en réponse JSON
        return response()->json($materiaux);
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
     * @param  \App\Models\Materiau  $materiau
     * @return \Illuminate\Http\Response
     */
    public function show(Materiaux $materiau)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Materiaux  $materiau
     * @return \Illuminate\Http\Response
     */
    public function edit(Materiaux $materiau)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Materiau  $materiau
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Materiaux $materiau)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Materiau  $materiau
     * @return \Illuminate\Http\Response
     */
    public function destroy(Materiaux $materiau)
    {
        //
    }
}
