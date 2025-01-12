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
    public function store(Request $request)
    {
        // app/Models/Stylist.php
        namespace App\Models;

        use Illuminate\Database\Eloquent\Factories\HasFactory;
        use Illuminate\Database\Eloquent\Model;

        class Stylist extends Model
        {
            use HasFactory;

            protected $fillable = [
                'user_id',
                'phone_number',
                'specializations',
                'description',
                'profile_picture_url',
                'points',
                'collections',
                'awards',
                'rating',
                'response_time',
                'completed_orders',
                'specialites',
            ];
        }

        }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stylist  $styliste
     * @return \Illuminate\Http\Response
     */
    public function show(Stylist $styliste)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stylist  $styliste
     * @return \Illuminate\Http\Response
     */
    public function edit(Stylist $styliste)
    {
        //
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
