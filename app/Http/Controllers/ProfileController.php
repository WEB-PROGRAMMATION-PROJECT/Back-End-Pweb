<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function getProfile(Request $request)
    {
        // Obtenir l'utilisateur authentifié
        $user = Auth::user();

        // Si l'utilisateur n'est pas un styliste, renvoyer une erreur
        if ($user->user_type !== 'stylist') {
            return response()->json(['error' => 'Utilisateur non autorisé'], 403);
        }

        // Récupérer les informations du styliste
        $stylist = $user->stylist;  // Accède à la relation 'stylist' du modèle 'User'

        // Si le styliste n'existe pas, renvoyer une erreur
        if (!$stylist) {
            return response()->json(['error' => 'Styliste non trouvé'], 404);
        }

        // Retourner les informations du profil du styliste
        return response()->json([
            'firstName' => $user->first_name,
            'lastName' => $user->last_name,
            'email' => $user->email,
            'country' => $user->country,
            'city' => $user->city,
            'address' => $user->address,
            'phoneNumber' => $stylist->phone_number,
            'specializations' => $stylist->specializations,
            'description' => $stylist->description,
            'profilePictureUrl' => $stylist->profile_picture_url,
            'points' => $stylist->points,
            'collections' => $stylist->collections,
            'awards' => $stylist->awards,
            'rating' => $stylist->rating,
            'responseTime' => $stylist->response_time,
            'completedOrders' => $stylist->completed_orders,
            'specialites' => $stylist->specialites
        ]);
    }
}
