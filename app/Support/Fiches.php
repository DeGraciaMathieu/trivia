<?php

namespace App\Support;

use App\Models\Fiche;
use Illuminate\Support\Facades\Cache;

/**
 * Le site public ne touche jamais la base. Il lit deux entrées de cache,
 * écrites une fois et conservées jusqu'à la prochaine écriture d'une fiche.
 *
 * Utiliser un store qui supporte rememberForever et un flush ciblé :
 * redis ou file. Pas array en production.
 */
class Fiches
{
    public const CLE_DONNEES = 'fiches.donnees';
    public const CLE_PAGE = 'fiches.page';

    /** Toutes les fiches, triées, dans la forme attendue par la vue. */
    public static function toutes(): array
    {
        return Cache::rememberForever(self::CLE_DONNEES, fn () => Fiche::query()
            ->orderBy('ordre')
            ->get()
            ->map->pourLaVue()
            ->all());
    }

    /** Le HTML complet de la page d'accueil. */
    public static function page(): string
    {
        return Cache::rememberForever(self::CLE_PAGE, function () {
            $fiches = self::toutes();

            return view('site', [
                'fiches' => $fiches,
                'json' => json_encode($fiches, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
                'categories' => array_values(array_intersect(
                    Fiche::CATEGORIES,
                    array_column($fiches, 'categorie')
                )),
            ])->render();
        });
    }

    /** Appelé automatiquement par le modèle à chaque écriture. */
    public static function oublier(): void
    {
        Cache::forget(self::CLE_DONNEES);
        Cache::forget(self::CLE_PAGE);
    }

    /** Le prochain numéro d'ordre libre. */
    public static function prochainOrdre(): int
    {
        return (int) Fiche::max('ordre') + 1;
    }
}
