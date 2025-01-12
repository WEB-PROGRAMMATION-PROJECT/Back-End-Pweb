<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Stylist;

class UserController extends Controller
{
    /**
     * Récupérer les informations de l'utilisateur (nom, email, etc.)
     */
    public function getUserInfo($id)
    {
        // Récupérer les informations de l'utilisateur de la table 'users'
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Utilisateur non trouvé'], 404);
        }

        return response()->json($user);
    }

    /**
     * Récupérer les informations du styliste (détails spécifiques)
     */
    public function getStylistInfo($userId)
    {
        // Récupérer les informations du styliste liées à l'utilisateur
        $stylist = Stylist::where('user_id', $userId)->first();

        if (!$stylist) {
            return response()->json(['message' => 'Styliste non trouvé'], 404);
        }

        return response()->json($stylist);
    }
}
