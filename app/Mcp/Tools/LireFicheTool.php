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

#[Name('lire_fiche')]
#[Description('Renvoie une fiche complète. Utile pour la relire avant de la modifier, ou pour s\'inspirer du ton des fiches existantes.')]
class LireFicheTool extends Tool
{
    public function handle(Request $request): Response|ResponseFactory
    {
        $fiche = Fiche::where('slug', $request->get('slug'))->first();

        if (! $fiche) {
            return Response::error('Aucune fiche avec ce slug. Appeler lister_fiches pour voir ce qui existe.');
        }

        return Response::structured($fiche->pourLaVue());
    }

    /**
     * @return array<string, \Illuminate\JsonSchema\Types\Type>
     */
    public function schema(JsonSchema $schema): array
    {
        return [
            'slug' => $schema->string()
                ->description('Identifiant de la fiche, tel que renvoyé par lister_fiches.')
                ->required(),
        ];
    }
}
