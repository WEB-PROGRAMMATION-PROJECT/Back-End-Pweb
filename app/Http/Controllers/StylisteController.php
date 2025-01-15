<?php

namespace App\Http\Controllers;

use App\Models\Stylist;
use App\Models\User;
use Illuminate\Http\Request;


class StylisteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getStylistProfile($id)
    {
        // Trouver le styliste avec son utilisateur associé
        $stylist = Stylist::where('user_id', $id)->first();

        if (!$stylist) {
            return response()->json(['message' => 'Styliste introuvable'], 404);
        }

        return response()->json($stylist);
    }
    public function updateProfile(Request $request, $id)
    {
        $stylist = Stylist::findOrFail($id);

        // Vérifier si les liens sociaux sont présents et valides
        $socialLinks = $request->has('social_links') ? json_encode($request->input('social_links')) : null;

        $stylist->update([
            'phone_number' => $request->input('phone_number'),
            'whatsapp' => $request->input('whatsapp'),
            'description' => $request->input('description'),
            'titre' => $request->input('titre'),
            'specializations' => $request->input('specializations'), // Convertir en JSON
            'social_links' => $request->input('social_links'), // Sauvegarder les liens sociaux en format JSON
        ]);

        return response()->json($stylist);
    }

    // Mettre à jour la photo de profil
    public function updateProfilePhoto(Request $request, $id)
    {
        $stylist = Stylist::findOrFail($id);

        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures');
            $stylist->profile_picture_url = $path;
            $stylist->save();
        }

        return response()->json($stylist);
    }

    // Mettre à jour la photo de couverture
    public function updateCoverPhoto(Request $request, $id)
    {
        $stylist = Stylist::findOrFail($id);

        if ($request->hasFile('cover_photo')) {
            $path = $request->file('cover_photo')->store('cover_photos');
            $stylist->cover_image_url = $path;
            $stylist->save();
        }

        return response()->json($stylist);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stylist  $styliste
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stylist $styliste)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stylist  $styliste
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stylist $styliste)
    {
        //
    }
}
