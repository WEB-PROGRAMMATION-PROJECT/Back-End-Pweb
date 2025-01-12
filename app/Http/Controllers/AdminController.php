<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Stylist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function createUser()
    {
        // Créer un utilisateur manuellement
        $user = User::create([
            'first_name' => 'Gates',
            'last_name' => 'Tems',
            'email' => 'temgouaguethe@gmail.com',
            'password' => Hash::make('G@tes1234'), // Assurez-vous de hasher le mot de passe
            'country' => 'Cameroun',
            'city' => 'Yaoundé',
            'address' => 'DAMAS',
            'user_type' => 'stylist',
            'terms_accepted' => true,
        ]);

        // Vérifier que l'utilisateur a bien été créé
        if ($user) {
            // Créer un styliste associé à l'utilisateur
            $stylist = Stylist::create([
                'user_id' => $user->id, // Associe l'ID du styliste à l'utilisateur
                'phone_number' => '1234567890', // Numéro de téléphone
                'specializations' => 'Hair, Beard', // Spécialités du styliste
                'description' => 'Styliste professionnel', // Description du styliste
                'profile_picture_url' => null, // URL de l'image de profil, peut être null
            ]);

            // Réponse après création
            return response()->json(['message' => 'Utilisateur et styliste créés avec succès!', 'user' => $user, 'stylist' => $stylist], 201);
        }

        return response()->json(['message' => 'Erreur lors de la création de l\'utilisateur.'], 500);
    }
}
