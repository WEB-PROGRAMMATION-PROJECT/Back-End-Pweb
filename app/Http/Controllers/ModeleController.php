<?php

namespace App\Http\Controllers;

use App\Models\Modele;
use Illuminate\Http\Request;

class ModeleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modeles = Modele::all();
        return response()->json($modeles, 200);
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
            'styliste_id' => 'required|exists:users,id',
            'categorie_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'story' => 'nullable|string',
            'points' => 'nullable|integer',
            'status' => 'required|in:available,unavailable,archived',
            'prix_min' => 'required|numeric|min:0',
            'prix_max' => 'required|numeric|min:0',
            'temps_min' => 'required|integer|min:0',
            'temps_max' => 'required|integer|min:0',
            'styles' => 'nullable|string',
            'image1' => 'required|string|max:255',
            'image2' => 'required|string|max:255',
            'image3' => 'required|string|max:255',
            'image4' => 'nullable|string|max:255',
            'image5' => 'nullable|string|max:255',
        ]);

        $modele = Modele::create($validated);
        return response()->json($modele, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Modele  $modele
     * @return \Illuminate\Http\Response
     */
    public function show(Modele $modele)
    {
        return response()->json($modele, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Modele  $modele
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Modele $modele)
    {
        $validated = $request->validate([
            'styliste_id' => 'sometimes|exists:users,id',
            'categorie_id' => 'sometimes|exists:categories,id',
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'story' => 'nullable|string',
            'points' => 'nullable|integer',
            'status' => 'sometimes|in:available,unavailable,archived',
            'prix_min' => 'sometimes|numeric|min:0',
            'prix_max' => 'sometimes|numeric|min:0',
            'temps_min' => 'sometimes|integer|min:0',
            'temps_max' => 'sometimes|integer|min:0',
            'styles' => 'nullable|string',
            'image1' => 'sometimes|string|max:255',
            'image2' => 'sometimes|string|max:255',
            'image3' => 'sometimes|string|max:255',
            'image4' => 'nullable|string|max:255',
            'image5' => 'nullable|string|max:255',
        ]);

        $modele->update($validated);
        return response()->json($modele, 200);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Modele  $modele
     * @return \Illuminate\Http\Response
     */
    public function destroy(Modele $modele)
    {
        $modele->delete();
        return response()->json(['message' => 'Modèle supprimé avec succès'], 200);
    }
}
