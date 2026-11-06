<?php

namespace App\Http\Controllers;

use App\Support\Fiches;
use Illuminate\Http\Response;

class SiteController extends Controller
{
    /**
     * La page entière sort du cache. Aucune requête SQL sur le chemin de
     * lecture tant qu'aucune fiche n'a changé.
     */
    public function index(): Response
    {
        return response(Fiches::page())
            ->header('Content-Type', 'text/html; charset=utf-8')
            ->header('Cache-Control', 'public, max-age=300');
    }

    /** Les fiches en JSON, pour un flux ou un autre consommateur. */
    public function donnees(): Response
    {
        return response(
            json_encode(Fiches::toutes(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
        )->header('Content-Type', 'application/json');
    }
}
