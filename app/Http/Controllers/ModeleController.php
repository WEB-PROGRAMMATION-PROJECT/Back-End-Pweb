<?php

namespace App\Http\Controllers;

use App\Models\Modele;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

use Illuminate\Http\Request;

class ModeleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function store(Request $request)
     {
         Log::info('Received request:', $request->all());
     
         // Si 'materiaux_ids' est une chaîne JSON, la convertir en tableau
         if (is_string($request->materiaux_ids)) {
             $decodedMateriaux = json_decode($request->materiaux_ids, true);
             // Vérification si le décodage a réussi
             if (json_last_error() !== JSON_ERROR_NONE) {
                 return response()->json([
                     'errors' => ['materiaux_ids' => 'Le format de materiaux_ids est invalide.']
                 ], 422);
             }
             $request->merge(['materiaux_ids' => $decodedMateriaux]);
         }
     
         // Validation des données
         try {
             $validated = $request->validate([
                 'styliste_id' => 'required|exists:users,id',
                 'categorie_id' => 'required|exists:categories,id',
                 'name' => 'required|string|min:3|max:255',
                 'description' => 'nullable',
                 'story' => 'nullable|string',
                 'materiaux_ids' => 'nullable|array',// Validation que chaque élément est un entier
                 'prix_min' => 'required|numeric|min:0',
                 'prix_max' => 'required|numeric|min:0|gte:prix_min',
                 'temps_min' => 'required|integer|min:1',
                 'temps_max' => 'required|integer|min:1|gte:temps_min',
                 'unite_temps' => 'required|string|in:jours,semaines,mois',
                 'styles' => 'nullable|string',
                 'status' => 'nullable|in:available,unavailable,archived',
                 'image1' => 'required|image',
                 'image2' => 'required|image',
                 'image3' => 'nullable|image',
                 'image4' => 'nullable|image',
                 'image5' => 'nullable|image',
             ]);
         } catch (\Illuminate\Validation\ValidationException $e) {
             Log::error('Validation errors:', $e->errors());
             return response()->json([
                 'errors' => $e->errors()
             ], 422);
         }
     
         // Initialisation du tableau des images
         $imagePaths = [];
     
         // Traitement des fichiers images
         for ($i = 0; $i < 5; $i++) {
             $imageKey = 'image' . ($i + 1);
             if ($request->hasFile($imageKey)) {
                 // Si une image est présente, on la stocke dans le dossier 'modele_pictures/modeimage'
                 $imagePaths[$imageKey] = $request->file($imageKey)->store('modele_pictures', 'public');
             } else {
                 $imagePaths[$imageKey] = null; // Si pas d'image, on attribue une valeur nulle
             }
         }
     
         // Vérification si des images ont été téléchargées
         if (empty(array_filter($imagePaths))) {
             return response()->json([
                 'errors' => ['images' => 'Aucune image valide n\'a été téléchargée.']
             ], 422);
         }
     
         // Préparation des données à insérer dans la base de données
         $dataToInsert = array_merge(
             $validated,
             [
                 'materiaux_ids' => isset($validated['materiaux_ids']) ? implode(',', $validated['materiaux_ids']) : null
             ]
         );
     
         // Ajouter les chemins des images dans les données à insérer
         foreach ($imagePaths as $key => $path) {
             $dataToInsert[$key] = $path;
         }
     
         // Création du modèle
         $modele = Modele::create($dataToInsert);
     
         return response()->json([
             'message' => 'Modèle créé avec succès.',
             'modele' => $modele,
         ], 201);
     }
     public function index()
    {
         // Récupérer toutes les catégories depuis la base de données
         $modeles = Modele::all();

         // Retourner les catégories en réponse JSON
         return response()->json($modeles);
    }
    public function getModelesWithMateriaux()
    {
        // Récupérer les modèles avec uniquement les IDs des matériaux associés
        $modeles = Modele::with('materiaux_ids:id')->get();
    
        // Retourner les modèles avec les IDs des matériaux en réponse JSON
        return response()->json($modeles);
    }
    public function show($id)
{
    // Récupérer le modèle avec l'ID spécifié
    $modele = Modele::find($id);

    // Si le modèle n'existe pas, renvoyer une réponse 404
    if (!$modele) {
        return response()->json([
            'error' => 'Modèle non trouvé.'
        ], 404);
    }

    // Retourner le modèle trouvé en réponse JSON
    return response()->json($modele);
}
 

}
