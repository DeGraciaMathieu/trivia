<?php

namespace App\Mcp\Tools;

use App\Models\Fiche;
use App\Support\Fiches;
use Illuminate\Contracts\JsonSchema\JsonSchema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Attributes\Description;
use Laravel\Mcp\Server\Attributes\Name;
use Laravel\Mcp\Server\Tool;

#[Name('creer_fiche')]
#[Description('Crée une fiche et la publie immédiatement sur le site. Appeler lister_fiches avant, pour vérifier que le sujet n\'est pas déjà traité.')]
class CreerFicheTool extends Tool
{
    public function handle(Request $request): Response
    {
        if (! $request->user()?->can('ecrire-fiches')) {
            return Response::error('Permission refusée.');
        }

        $donnees = [
            'slug' => Str::slug($request->get('slug') ?: $request->get('terme')),
            'terme' => $request->get('terme'),
            'categorie' => $request->get('categorie'),
            'date_libelle' => $request->get('date'),
            'teaser' => $request->get('teaser'),
            'retenir' => $request->get('retenir'),
            'aujourdhui' => $request->get('aujourdhui'),
            'recit_1' => $request->get('recit_1'),
            'recit_2' => $request->get('recit_2'),
            'recit_3' => $request->get('recit_3'),
            'ordre' => Fiches::prochainOrdre(),
        ];

        $validation = Validator::make($donnees, [
            'slug' => 'required|string|max:80|unique:fiches,slug',
            'terme' => 'required|string|max:120',
            'categorie' => ['required', 'in:' . implode(',', Fiche::CATEGORIES)],
            'date_libelle' => 'required|string|max:120',
            'teaser' => 'required|string|max:170',
            'retenir' => 'required|string|max:200',
            'aujourdhui' => 'required|string|min:40',
            'recit_1' => 'required|string|min:120',
            'recit_2' => 'required|string|min:120',
            'recit_3' => 'required|string|min:120',
        ]);

        if ($validation->fails()) {
            return Response::error(implode(' ', $validation->errors()->all()));
        }

        $fiche = Fiche::create($donnees);

        return Response::text(sprintf(
            'Fiche « %s » publiée (n° %d, %s). Elle est en ligne.',
            $fiche->terme,
            $fiche->ordre,
            $fiche->categorie
        ));
    }

    /**
     * Le gabarit est porté par le schéma, pas par une consigne : trois champs
     * de récit distincts rendent une fiche à quatre paragraphes impossible,
     * et l'énumération des catégories interdit d'en inventer une.
     *
     * @return array<string, \Illuminate\JsonSchema\Types\Type>
     */
    public function schema(JsonSchema $schema): array
    {
        return [
            'terme' => $schema->string()
                ->description('Le terme tel qu\'il s\'affiche en titre : « daemon », « chmod 777 », « X-Custom-Header ».')
                ->required(),

            'slug' => $schema->string()
                ->description('Identifiant en minuscules sans accent. Déduit du terme si absent.'),

            'categorie' => $schema->string()
                ->enum(Fiche::CATEGORIES)
                ->description('La famille de la fiche. « Contresens » pour les épisodes qu\'on raconte à l\'envers.')
                ->required(),

            'date' => $schema->string()
                ->description('Libellé de datation affiché sous le titre : « 1963, MIT, projet MAC », « années 1970, Unix ».')
                ->required(),

            'teaser' => $schema->string()
                ->description('Une ou deux phrases d\'accroche, 170 signes maximum. Donne envie, ne résume pas.')
                ->required(),

            'recit_1' => $schema->string()
                ->description('Premier paragraphe : le contexte, la contrainte, le besoin.')
                ->required(),

            'recit_2' => $schema->string()
                ->description('Deuxième paragraphe : le fait lui-même, daté et attribué.')
                ->required(),

            'recit_3' => $schema->string()
                ->description('Troisième paragraphe : la conséquence, la correction de la légende, ou le détail que personne ne connaît.')
                ->required(),

            'retenir' => $schema->string()
                ->description('UNE phrase affirmative qui tient debout sortie de son contexte. C\'est ce qu\'on retient six mois plus tard.')
                ->required(),

            'aujourdhui' => $schema->string()
                ->description('Ce qui subsiste dans le travail d\'aujourd\'hui. Jamais facultatif : c\'est ce qui sépare une anecdote d\'un truc utile. Si rien n\'en reste, la fiche n\'a pas sa place.')
                ->required(),
        ];
    }
}
