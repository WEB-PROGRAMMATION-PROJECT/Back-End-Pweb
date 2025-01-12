<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('create-user', [AdminController::class, 'createUser']);
Route::middleware(['CORS'])->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('user/{id}', [UserController::class, 'getUserInfo']);
    Route::get('stylist/{userId}', [UserController::class, 'getStylistInfo']);
    // Autres routes API...
});

Route::post('/update-profile-picture', function (Request $request) {
    $request->validate([
        'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $image = $request->file('profile_picture');
    $imageName = time().'.'.$image->getClientOriginalExtension();
    $imagePath = $image->storeAs('profile_pictures', $imageName, 'public');

    // Mettre à jour l'image de profil de l'utilisateur
    $user = auth()->user();
    $user->profile_picture_url = $imagePath;
    $user->save();

    return response()->json(['profile_picture_url' => $imageName]);
});

