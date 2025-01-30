<?php

namespace App\Http\Controllers;

use App\Models\Stylist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StylisteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Récupérer tous les stylistes avec les informations des utilisateurs associés
        $stylists = Stylist::with('user')->get();
        return response()->json($stylists);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Non pertinent pour une API REST (généralement utilisé pour des formulaires HTML)
        return response()->json(['message' => 'Méthode non utilisée'], 405);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Valider les données entrantes
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'phone_number' => 'required|string|max:15',
            'description' => 'nullable|string',
            'titre' => 'nullable|string|max:255',
            'specializations' => 'nullable|array',
            'social_links' => 'nullable|array',
        ]);

        // Créer un nouveau styliste
        $stylist = Stylist::create([
            'user_id' => $validated['user_id'],
            'phone_number' => $validated['phone_number'],
            'description' => $validated['description'],
            'titre' => $validated['titre'],
            'specializations' => json_encode($validated['specializations']),
            'social_links' => json_encode($validated['social_links']),
        ]);

        return response()->json($stylist, 201);
    }

    /**
     * Afficher le profil d'un styliste spécifique.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getStylistProfile($id)
    {
        $stylist = Stylist::where('user_id', $id)->with('user')->first();

        if (!$stylist) {
            return response()->json(['message' => 'Styliste introuvable'], 404);
        }

        return response()->json($stylist);
    }

    /**
     * Mettre à jour le profil d'un styliste.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request, $id)
    {
        $stylist = Stylist::findOrFail($id);

        $validated = $request->validate([
            'phone_number' => 'nullable|string|max:15',
            'description' => 'nullable|string',
            'email' => 'nullable|string',
            'specializations' => 'nullable|array',
            'social_links' => 'nullable|array',
        ]);

        $stylist->update([
            'phone_number' => $validated['phone_number'] ?? $stylist->phone_number,
            'description' => $validated['description'] ?? $stylist->description,
            'email' => $validated['email'] ?? $stylist->titre,
            'specializations' => isset($validated['specializations']) ? json_encode($validated['specializations']) : $stylist->specializations,
            'social_links' => isset($validated['social_links']) ? json_encode($validated['social_links']) : $stylist->social_links,
        ]);

        return response()->json($stylist);
    }

    /**
     * Mettre à jour la photo de profil d'un styliste.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProfilePhoto(Request $request, $id)
    {
        $stylist = Stylist::findOrFail($id);

        $request->validate([
            'profile_picture' => 'required|image|max:2048', // Valider l'image
        ]);

        if ($request->hasFile('profile_picture')) {
            // Supprimer l'ancienne photo si elle existe
            if ($stylist->profile_picture_url) {
                Storage::delete($stylist->profile_picture_url);
            }

            $path = $request->file('profile_picture')->store('profile_pictures', 'public' );
            $stylist->profile_picture_url = $path;
            $stylist->save();
        }

        return response()->json($stylist);
    }

    /**
     * Mettre à jour la photo de couverture d'un styliste.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateCoverPhoto(Request $request, $id)
    {
        $stylist = Stylist::findOrFail($id);

        $request->validate([
            'cover_photo' => 'required|image|max:2048',
        ]);

        if ($request->hasFile('cover_photo')) {
            // Supprimer l'ancienne photo si elle existe
            if ($stylist->cover_image_url) {
                Storage::delete($stylist->cover_image_url);
            }

            $path = $request->file('cover_photo')->store('cover_photos', 'public');
            $stylist->cover_image_url = $path;
            $stylist->save();
        }

        return response()->json($stylist);
    }

    /**
     * Supprimer un styliste.
     *
     * @param  \App\Models\Stylist  $styliste
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stylist $styliste)
    {
        $styliste->delete();
        return response()->json(['message' => 'Styliste supprimé avec succès']);
    }
}
