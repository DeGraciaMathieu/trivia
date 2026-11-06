<?php

namespace Database\Seeders;

use App\Models\Fiche;
use Illuminate\Database\Seeder;

/**
 * Importe les 71 fiches depuis contenu/*.md, une seule fois, pour amorcer la
 * base. Le markdown n'est plus la source après ça — le MCP écrit en base.
 * Garder le dossier comme archive de la migration, ou le supprimer.
 */
class FichesSeeder extends Seeder
{
    public function run(): void
    {
        $fichiers = glob(base_path('contenu/*.md'));

        if ($fichiers === false || $fichiers === []) {
            $this->command->warn('Aucun fichier dans contenu/. Rien à importer.');

            return;
        }

        foreach ($fichiers as $chemin) {
            $slug = basename($chemin, '.md');
            $brut = file_get_contents($chemin);

            if (! preg_match('/^---\R(.*?)\R---\R(.*)$/s', $brut, $trouve)) {
                $this->command->error("$slug : frontmatter illisible, ignoré.");
                continue;
            }

            $entete = $this->entete($trouve[1]);
            $paragraphes = preg_split('/\R{2,}/', trim($trouve[2]), -1, PREG_SPLIT_NO_EMPTY) ?: [];
            $paragraphes = array_map('trim', $paragraphes);

            // Le gabarit impose trois paragraphes : on fusionne le surplus
            // dans le dernier plutôt que de perdre du texte.
            while (count($paragraphes) > 3) {
                $dernier = array_pop($paragraphes);
                $paragraphes[count($paragraphes) - 1] .= ' ' . $dernier;
            }

            if (count($paragraphes) < 3) {
                $this->command->error("$slug : moins de trois paragraphes, ignoré.");
                continue;
            }

            Fiche::updateOrCreate(['slug' => $slug], [
                'terme' => $entete['terme'] ?? $slug,
                'categorie' => $entete['categorie'] ?? 'Culture',
                'date_libelle' => $entete['date'] ?? '',
                'teaser' => mb_substr($entete['teaser'] ?? '', 0, 170),
                'retenir' => $entete['retenir'] ?? '',
                'aujourdhui' => $entete['aujourdhui'] ?? '',
                'recit_1' => $paragraphes[0],
                'recit_2' => $paragraphes[1],
                'recit_3' => $paragraphes[2],
                'ordre' => (int) ($entete['ordre'] ?? 0),
            ]);
        }

        $this->command->info(Fiche::count() . ' fiches en base.');
    }

    private function entete(string $texte): array
    {
        $entete = [];
        foreach (preg_split('/\R/', $texte) as $ligne) {
            if (! preg_match('/^([a-z]+)\s*:\s*(.*)$/u', trim($ligne), $t)) {
                continue;
            }
            $valeur = trim($t[2]);
            if (str_starts_with($valeur, '"') && str_ends_with($valeur, '"')) {
                $valeur = str_replace('\\"', '"', substr($valeur, 1, -1));
            }
            $entete[$t[1]] = $valeur;
        }

        return $entete;
    }
}
