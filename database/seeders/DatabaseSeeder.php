<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Modele;
use App\Models\Categorie;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Création d'une catégorie par défaut
        $categorie = Categorie::create([
            'name' => 'Vêtements',
            'description' => 'Catégorie regroupant les vêtements de mode.',
        ]);

        // Création du client
        $client = User::create([
            'nom' => 'Doe',
            'prenom' => 'John',
            'email' => 'john.doe@example.com',
            'password' => bcrypt('jim'),
            'type' => 'client',
        ]);

        // Création du styliste
        $styliste = User::create([
            'nom' => 'Smith',
            'prenom' => 'Jane',
            'email' => 'jane.smith@example.com',
            'password' => bcrypt('jim'),
            'type' => 'styliste',
        ]);

        // Création de modèles associés au styliste
        $models = [
            [
                'name' => 'Robe élégante',
                'description' => 'Une robe élégante parfaite pour les soirées.',
                'story' => 'Inspirée par les années 20, cette robe est un mélange de tradition et de modernité.',
                'points' => 150,
                'status' => 'available',
                'prix_min' => 120.50,
                'prix_max' => 145.00,
                'temps_min' => 7,
                'temps_max' => 14,
                'styles' => 'élégant, chic',
                'image1' => 'iamges/dress1.jpg',
                'image2' => 'iamges/dress1.jpg',
                'image3' => 'iamges/dress1.jpg',
                'image4' => 'iamges/dress1.jpg',
                'image5' => 'iamges/dress1.jpg',
            ],
            [
                'name' => 'Costume classique',
                'description' => 'Un costume intemporel pour les grandes occasions.',
                'story' => 'Inspiré des coupes italiennes traditionnelles.',
                'points' => 200,
                'status' => 'available',
                'prix_min' => 200.00,
                'prix_max' => 235.00,
                'temps_min' => 10,
                'temps_max' => 20,
                'styles' => 'classique, formel',
                'image1' => 'iamges/costume.jpg',
                'image2' => 'iamges/costume.jpg',
                'image3' => 'iamges/costume.jpg',
                'image4' => 'iamges/costume.jpg',
                'image5' => null,
            ],
        ];

        foreach ($models as $model) {
            Modele::create(array_merge($model, [
                'styliste_id' => $styliste->id,
                'categorie_id' => $categorie->id,
                'devise' => 'XAF',
                'unite_temps' => 'jours',
            ]));
        }
    }
}
