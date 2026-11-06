<?php

namespace App\Mcp\Tools;

use App\Models\Fiche;
use Illuminate\Contracts\JsonSchema\JsonSchema;
use Illuminate\Support\Facades\Validator;
use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Attributes\Description;
use Laravel\Mcp\Server\Tool;

#[Description('Modifie une fiche existante et republie aussitôt. Seuls les champs fournis sont touchés. L\'état précédent est archivé automatiquement.')]
class ModifierFicheTool extends Tool
{
    public function handle(Request $request): Response
    {
        if (! $request->user()?->can('ecrire-fiches')) {
            return Response::error('Permission refusée.');
        }

        $fiche = Fiche::where('slug', $request->get('slug'))->first();

        if (! $fiche) {
            return Response::error('Aucune fiche avec ce slug.');
        }

        $champs = [
            'terme' => 'terme',
            'categorie' => 'categorie',
            'date' => 'date_libelle',
            'teaser' => 'teaser',
            'retenir' => 'retenir',
            'aujourdhui' => 'aujourdhui',
            'recit_1' => 'recit_1',
            'recit_2' => 'recit_2',
            'recit_3' => 'recit_3',
        ];

        $modifs = [];
        foreach ($champs as $entree => $colonne) {
            if ($request->get($entree) !== null) {
                $modifs[$colonne] = $request->get($entree);
            }
        }

        if ($modifs === []) {
            return Response::error('Aucun champ à modifier.');
        }

        $validation = Validator::make($modifs, [
            'terme' => 'sometimes|string|max:120',
            'categorie' => ['sometimes', 'in:' . implode(',', Fiche::CATEGORIES)],
            'date_libelle' => 'sometimes|string|max:120',
            'teaser' => 'sometimes|string|max:170',
            'retenir' => 'sometimes|string|max:200',
            'aujourdhui' => 'sometimes|string|min:40',
            'recit_1' => 'sometimes|string|min:120',
            'recit_2' => 'sometimes|string|min:120',
            'recit_3' => 'sometimes|string|min:120',
        ]);

        if ($validation->fails()) {
            return Response::error(implode(' ', $validation->errors()->all()));
        }

        $fiche->update($modifs);

        return Response::text(sprintf(
            'Fiche « %s » mise à jour : %s. L\'état précédent est dans l\'historique.',
            $fiche->terme,
            implode(', ', array_keys($modifs))
        ));
    }

    /**
     * @return array<string, \Illuminate\JsonSchema\Types\Type>
     */
    public function schema(JsonSchema $schema): array
    {
        return [
            'slug' => $schema->string()
                ->description('La fiche à modifier.')
                ->required(),

            'terme' => $schema->string()->description('Nouveau titre.'),
            'categorie' => $schema->string()->enum(Fiche::CATEGORIES)->description('Nouvelle famille.'),
            'date' => $schema->string()->description('Nouveau libellé de datation.'),
            'teaser' => $schema->string()->description('Nouvelle accroche, 170 signes maximum.'),
            'recit_1' => $schema->string()->description('Nouveau premier paragraphe.'),
            'recit_2' => $schema->string()->description('Nouveau deuxième paragraphe.'),
            'recit_3' => $schema->string()->description('Nouveau troisième paragraphe.'),
            'retenir' => $schema->string()->description('Nouvelle phrase à retenir, une seule.'),
            'aujourdhui' => $schema->string()->description('Nouveau « ce qu\'il en reste ».'),
        ];
    }
}
