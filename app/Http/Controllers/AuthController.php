<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Client;
use App\Models\Stylist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    // Inscription d'un utilisateur (client ou styliste)
    // Inscription d'un utilisateur (client ou styliste)

    /**
     * @Route("/api/register", name="register", methods={"POST"})
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'specializations' => 'nullable|string', // Accepter une chaîne sérialisée
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'profile_picture_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validation du fichier image
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Traitement du fichier image
        if ($request->hasFile('profile_picture_url')) {
            $imagePath = $request->file('profile_picture_url')->store('profile_pictures', 'public');
        } else {
            $imagePath = null;
        }

        // Créer un utilisateur
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'country' => $request->country,
            'city' => $request->city,
            'address' => $request->address,
            'user_type' => $request->user_type,
            'profile_picture_url' => $imagePath,
            'terms_accepted' => $request->terms_accepted,
        ]);

        // Créer un styliste ou un client selon le type d'utilisateur
        if ($request->user_type === 'stylist') {
            $stylist = new Stylist([
                'user_id' => $user->id,
                'phone_number' => $request->phone_number,
                'specializations' => $request->specializations,
                'description' => $request->description,
                'profile_picture_url' => $imagePath,
            ]);
            $stylist->save();
        } else if ($request->user_type === 'client') {
            $client = new Client([
                'user_id' => $user->id,
                'tour_poitrine' => $request->tour_poitrine,
                'tour_taille' => $request->tour_taille,
                'tour_hanches' => $request->tour_hanches,
                'hauteur_totale' => $request->hauteur_totale,
                'longueur_bras' => $request->longueur_bras,
                'tour_cou' => $request->tour_cou,
                'mesures_photo' => $request->mesures_photo,
            ]);
            $client->save();
        }

        return response()->json(['message' => 'Inscription réussie', 'user' => $user], 201);
    }


    /**
     * @Route("/api/login", name="login", methods={"POST"})
     */
    // Connexion d'un utilisateur

    public function login(Request $request)
    {
        try {
            // Validation des données envoyées par le client
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:6',
            ]);

            // Vérification de l'utilisateur dans la base de données
            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return response()->json(['error' => 'Email ou mot de passe incorrect'], 401);
            }

            // Hachage du mot de passe reçu pour le log avant la comparaison
            $hashedPassword = Hash::make($request->password);

            // Affichage du mot de passe haché dans les logs
            \Log::info('Mot de passe reçu haché: ' . $hashedPassword);

            // Comparer le mot de passe haché reçu avec celui stocké dans la base de données
            if (!Hash::check($request->password, $user->password)) {
                return response()->json(['error' => 'Email ou mot de passe incorrect'], 401);
            }

            // Authentifier l'utilisateur
            Auth::login($user);

            // Renvoyer une réponse avec les informations de l'utilisateur
            return response()->json([
                'message' => 'Connexion réussie',
                'user' => $user,
            ], 200);

        } catch (\Exception $e) {
            // Retour d'une erreur générale en cas de problème
            return response()->json([
                'error' => 'Une erreur est survenue',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ], 500);
        }
    }
    // Déconnexion de l'utilisateur
    public function logout(Request $request)
    {
        // Déconnecter l'utilisateur
        Auth::logout();


        return response()->json(['message' => 'Déconnexion réussie'], 200);
    }

    // Récupérer les détails de l'utilisateur connecté
    public function userDetails(Request $request)
    {
        return response()->json(['user' => $request->user()]);
    }
}
