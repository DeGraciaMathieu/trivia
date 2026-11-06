<?php

use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SiteController::class, 'index'])->name('site');
Route::get('/fiches.json', [SiteController::class, 'donnees'])->name('site.donnees');
