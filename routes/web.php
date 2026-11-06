<?php

use App\Http\Controllers\ConnexionController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SiteController::class, 'index'])->name('site');
Route::get('/fiches.json', [SiteController::class, 'donnees'])->name('site.donnees');

// Connexion seule : aucune route d'inscription, le compte unique est créé à la main.
Route::middleware('guest')->group(function () {
    Route::get('/connexion', [ConnexionController::class, 'formulaire'])->name('login');
    Route::post('/connexion', [ConnexionController::class, 'connecter'])->middleware('throttle:5,1');
});
