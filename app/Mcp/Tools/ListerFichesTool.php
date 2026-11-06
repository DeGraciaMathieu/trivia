<?php

namespace App\Mcp\Tools;

use App\Models\Fiche;
use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
use Laravel\Mcp\ResponseFactory;
use Laravel\Mcp\Server\Attributes\Description;
use Laravel\Mcp\Server\Attributes\Name;
use Laravel\Mcp\Server\Tool;

#[Name('lister_fiches')]
#[Description('Liste les fiches existantes, avec filtre par catégorie ou recherche plein texte. À appeler avant toute création, pour ne pas traiter deux fois le même sujet.')]
class ListerFichesTool extends Tool
{
    public function handle(Request $request): Response|ResponseFactory
    {
        $fiches = Fiche::query()
            ->when($request->get('categorie'), fn ($q, $c) => $q->where('categorie', $c))
            ->when($request->get('recherche'), function ($q, $mot) {
                $mot = '%' . $mot . '%';
                $q->where(fn ($q) => $q
                    ->where('terme', 'like', $mot)
                    ->orWhere('teaser', 'like', $mot)
                    ->orWhere('recit_1', 'like', $mot)
                    ->orWhere('recit_2', 'like', $mot)
                    ->orWhere('recit_3', 'like', $mot));
            })
            ->orderBy('ordre')
            ->get(['slug', 'terme', 'categorie', 'date_libelle', 'teaser']);

        if ($fiches->isEmpty()) {
            return Response::text('Aucune fiche ne correspond. Le sujet est libre.');
        }

        return Response::structured([
            'total' => $fiches->count(),
            'fiches' => $fiches->toArray(),
        ]);
    }

    /**
     * @return array<string, \Illuminate\JsonSchema\Types\Type>
     */
    public function schema(JsonSchema $schema): array
    {
        return [
            'recherche' => $schema->string()
                ->description('Mot ou expression cherché dans le terme, l\'accroche et le corps des fiches.'),

            'categorie' => $schema->string()
                ->enum(Fiche::CATEGORIES)
                ->description('Restreint la liste à une famille.'),
        ];
    }
}
