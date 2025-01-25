<?php

use App\Http\Controllers\CategorieController;
use App\Http\Controllers\CommandeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\StylisteController;
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
    Route::get('client/{id}', [ClientController::class, 'getClientDetails']);
    Route::put('client/{userId}/update', [ClientController::class, 'updateClientDetails']);
    ROUTE::post('save-measurements', [ClientController::class, 'saveMeasurements']);
    Route::get('stylist-profile/{id}', [StylisteController::class, 'getStylistProfile']);
    Route::put('Modif_stylist/{id}', [StylisteController::class, 'updateProfile']);
    Route::post('stylist/{id}/update-profile-photo', [StylisteController::class, 'updateProfilePhoto']);
    Route::post('stylist/{id}/update-cover-photo', [StylisteController::class, 'updateCoverPhoto']);

    // Autres routes API...
});

Route::prefix('commandes')->group( function () {
    Route::get('/', [CommandeController::class,'index'])->name('commandes.index');
    Route::get('/{id}', [CommandeController::class,'show'])->name('commandes.show');
    Route::post('/create', [CommandeController::class,'store'])->name('commandes.store');
    Route::put('/update/{id}', [CommandeController::class,'update'])->name('commandes.update');
    Route::delete('/delete/{id}', [CommandeController::class,'delete'])->name('commandes.delete');

    Route::get('/styliste/{stylistId}', [CommandeController::class,'getByStylist'])->name('commandes.getByStylist');
    Route::get('/client/{clientId}', [CommandeController::class,'getByClient'])->name('commandes.getByClient');
});

Route::get('/categories', [CategorieController::class,'index']);

