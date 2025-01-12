<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\ClientController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route pour tester l'API
Route::get('/test', function () {
    return response()->json(['message' => 'API Laravel fonctionnelle']);
});

Route::prefix('commandes')->group(function () {
    // Liste de toutes les commandes (index)
    Route::get('/', [CommandeController::class, 'index'])->name('commandes.index');

    // Afficher une commande spécifique (show)
    Route::get('/{commande}', [CommandeController::class, 'show'])->name('commandes.show');

    // Créer une commande (store)
    Route::post('/create', [CommandeController::class, 'store'])->name('commandes.store');

    // Mettre à jour une commande (update)
    Route::put('/update/{commande}', [CommandeController::class, 'update'])->name('commandes.update');

    // Supprimer une commande (destroy)
    Route::delete('/delete/{commande}', [CommandeController::class, 'destroy'])->name('commandes.destroy');

    // Récupérer les commandes d’un styliste spécifique
    Route::get('/styliste/{styliste}', [CommandeController::class, 'getByStylist'])->name('commandes.getByStylist');

    // Récupérer les commandes d'un client spécifique
    Route::get('/client/{clientId}', [CommandeController::class, 'getByClient'])->name('commandes.getByClient');
});

Route::prefix('clients')->group(function () {
    Route::get('/', [ClientController::class, 'index'])->name('clients.index');
    Route::post('/create', [ClientController::class, 'store'])->name('clients.store');
});


Route::prefix('modeles')->group(function () {
    Route::get('/', [ModeleController::class, 'index'])->name('modeles.index');
    Route::post('/create', [ModeleController::class, 'store'])->name('modeles.store');
    Route::get('/{modele}', [ModeleController::class, 'show'])->name('modeles.show');
    Route::put('/update/{modele}', [ModeleController::class, 'update'])->name('modeles.update');
    Route::put('/delete/{modele}', [ModeleController::class, 'destroy'])->name('modeles.destroy');
});
