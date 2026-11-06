<?php

use App\Mcp\Servers\TriviaServer;
use Illuminate\Support\Facades\Route;
use Laravel\Mcp\Facades\Mcp;

/*
 * Un seul client autorisé : ton Claude. Pas d'enregistrement dynamique, donc
 * pas de route publique ouverte à n'importe quel client. Le client OAuth est
 * créé à la main (php artisan passport:client) et ses identifiants sont saisis
 * dans les paramètres avancés du connecteur claude.ai.
 */
Route::middleware('throttle:10,1')->group(function () {
    Mcp::oauthRoutes(registration: false);
});

Mcp::web('/mcp/trivia', TriviaServer::class)
    ->middleware(['auth:api', 'throttle:60,1']);

/*
 * Même serveur en local, pour Claude Code sur la machine de développement :
 * php artisan mcp:start trivia
 * Aucune authentification : le processus tourne déjà sous ton identité.
 */
Mcp::local('trivia', TriviaServer::class);
