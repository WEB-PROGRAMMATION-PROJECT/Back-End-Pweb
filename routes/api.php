<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\StylisteController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\MateriauController;
use App\Http\Controllers\ModeleController;
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
Route::get('stylists', [StylisteController::class, 'index']);

Route::middleware(['CORS'])->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('user/{id}', [UserController::class, 'getUserInfo']);
    Route::get('stylist/{userId}', [UserController::class, 'getStylistInfo']);
    Route::get('client/{id}', [ClientController::class, 'getClientDetails']);
    Route::put('client/{userId}/update', [ClientController::class, 'updateClientDetails']);
    ROUTE::post('save-measurements', [ClientController::class, 'saveMeasurements']);
    Route::get('stylist-profile/{id}', [StylisteController::class, 'getStylistProfile']);
    Route::put('Modif_stylist/{id}', [StylisteController::class, 'updateProfile']);
    Route::get('add-categories-manually', [CategorieController::class, 'create']);
    Route::post('stylist/{id}/update-profile-photo', [StylisteController::class, 'updateProfilePhoto']);
    Route::post('stylist/{id}/update-cover-photo', [StylisteController::class, 'updateCoverPhoto']);
    Route::get('categories', [CategorieController::class, 'index']);
    Route::get('modeles', [ModeleController::class, 'index']);
    Route::get('modeles/{id}', [ModeleController::class, 'show']);
    Route::get('materiaux', [MateriauController::class, 'index']);
    Route::get('materiaux/{id}', [MateriauController::class, 'showByIds']);
    Route::post('addmodel', [ModeleController::class, 'store']);
    // Autres routes API...
});



