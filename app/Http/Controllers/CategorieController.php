<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         // Récupérer toutes les catégories depuis la base de données
         $categories = Categorie::all();

         // Retourner les catégories en réponse JSON
         return response()->json($categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Les données des catégories
       // Les données des catégories
$categories = [
    [
        'name' => 'TENUE TRADITIONNELLE',
        'image' => 'tradi.jpeg',
        'count' => 10,
        'description' => 'Vêtements traditionnels reflétant l’héritage culturel et artisanal.',
        'href' => '/categorie-1'
    ],
    [
        'name' => 'TAILLEUR FEMME',
        'image' => 'tailleur.jpg',
        'count' => 5,
        'description' => 'Ensembles élégants et professionnels pour femmes.',
        'href' => '/categorie-2'
    ],
    [
        'name' => 'TAILLEUR HOMME',
        'image' => 'tailleurh.jpeg',
        'count' => 7,
        'description' => 'Costumes et ensembles raffinés pour hommes.',
        'href' => '/categorie-3'
    ],
    [
        'name' => 'ROBE DE SOIREE',
        'image' => 'robe.jpeg',
        'count' => 15,
        'description' => 'Robes élégantes pour des occasions spéciales et soirées.',
        'href' => '/categorie-4'
    ],
    [
        'name' => 'PATALON',
        'image' => 'patalon.jpeg',
        'count' => 2,
        'description' => 'Pantalons tendance et confortables pour tous les styles.',
        'href' => '/categorie-5'
    ],
    [
        'name' => 'JUPE',
        'image' => 'jupe.jpeg',
        'count' => 8,
        'description' => 'Jupes variées, du casual au chic.',
        'href' => '/categorie-6'
    ],
    [
        'name' => 'ROBE COURTE',
        'image' => 'R.jpeg',
        'count' => 3,
        'description' => 'Robes courtes stylées et modernes.',
        'href' => '/categorie-7'
    ],
    [
        'name' => 'MODE ETHIQUE ET DURABLE',
        'image' => 'ethique.jpeg',
        'count' => 20,
        'description' => 'Mode respectueuse de l’environnement et du commerce équitable.',
        'href' => '/categorie-8'
    ],
    [
        'name' => 'MODEL ENFANT',
        'image' => 'enfant.jpeg',
        'count' => 12,
        'description' => 'Vêtements adaptés au style et au confort des enfants.',
        'href' => '/categorie-9'
    ],
    [
        'name' => 'CHEMISE',
        'image' => 'chemis.jpeg',
        'count' => 18,
        'description' => 'Chemises élégantes et décontractées pour toutes les occasions.',
        'href' => '/categorie-10'
    ]
];


        foreach ($categories as $category) {
            // Initialisation du chemin de l'image
            $imagePath = null;
    
            // Vérifier si le fichier existe dans storage/app/public
            $sourcePath = $category['image']; // Le fichier source dans storage/app/public
    
            // Vérifier si le fichier existe dans le dossier public
            if (Storage::disk('public')->exists($sourcePath)) {
    
                // Hachage du nom du fichier (générer un nom unique)
                $hashedName = md5(time() . Str::random(10)) . '.jpg';  // Nom unique haché avec extension .jpg
    
                // Définir le chemin de destination dans categories_images
                $destinationPath = 'categories_images/' . $hashedName;
    
                // Utiliser store() pour copier le fichier dans categories_images
                Storage::disk('public')->put($destinationPath, Storage::disk('public')->get($sourcePath));
    
                // Enregistrer le chemin relatif de l'image dans la base de données
                $imagePath = $destinationPath;
    
            } else {
                // Gérer l'absence de l'image, par exemple utiliser une image par défaut
                $imagePath = 'categories_images/default.jpg';  // Utiliser une image par défaut
            }
    
            // Création de la catégorie avec le chemin de l'image
            Categorie::create([
                'name' => $category['name'],
                'image' => $imagePath,  // Chemin relatif de l'image
                'count' => $category['count'],
                'href' => $category['href'],
                'description' => $category['description'],
            ]);
        }

        return response()->json(['message' => 'Les catégories ont été ajoutées avec succès!']);
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
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function show(Categorie $categorie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function edit(Categorie $categorie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categorie $categorie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categorie $categorie)
    {
        //
    }
}
