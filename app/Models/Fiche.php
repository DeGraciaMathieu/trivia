<?php

namespace App\Models;

use App\Support\Fiches;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Fiche extends Model
{
    public const CATEGORIES = [
        'HTTP', 'Web', 'Réseau', 'Unix', 'Matériel',
        'Langages & outils', 'Méthodes', 'Culture', 'Contresens',
    ];

    protected $guarded = [];

    protected static function booted(): void
    {
        // Avant toute modification ou suppression, on garde l'état précédent.
        static::updating(fn (Fiche $fiche) => $fiche->archiver('modification'));
        static::deleting(fn (Fiche $fiche) => $fiche->archiver('suppression'));

        // Toute écriture périme le cache des pages.
        static::saved(fn () => Fiches::oublier());
        static::deleted(fn () => Fiches::oublier());
    }

    public function archiver(string $operation): void
    {
        FicheRevision::create([
            'slug' => $this->getOriginal('slug') ?? $this->slug,
            'avant' => $this->getOriginal(),
            'operation' => $operation,
            'auteur' => Auth::user()?->email,
            'created_at' => now(),
        ]);
    }

    /** Les trois paragraphes, dans l'ordre. */
    public function recit(): array
    {
        return [$this->recit_1, $this->recit_2, $this->recit_3];
    }

    /** La forme consommée par la vue et par le JSON embarqué dans la page. */
    public function pourLaVue(): array
    {
        return [
            'slug' => $this->slug,
            'ordre' => $this->ordre,
            'terme' => $this->terme,
            'categorie' => $this->categorie,
            'date' => $this->date_libelle,
            'teaser' => $this->teaser,
            'retenir' => $this->retenir,
            'aujourdhui' => $this->aujourdhui,
            'recit' => $this->recit(),
        ];
    }
}
