<?php

namespace App\Mcp\Tools;

use App\Models\Fiche;
use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Attributes\Description;
use Laravel\Mcp\Server\Attributes\Name;
use Laravel\Mcp\Server\Tool;

#[Name('supprimer_fiche')]
#[Description('Retire une fiche du site. Le contenu reste dans l\'historique et peut être rétabli. Ne jamais appeler sans demande explicite.')]
class SupprimerFicheTool extends Tool
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

        $terme = $fiche->terme;
        $fiche->delete();

        return Response::text(sprintf(
            'Fiche « %s » retirée du site. Son contenu est conservé dans l\'historique.',
            $terme
        ));
    }

    /**
     * @return array<string, \Illuminate\JsonSchema\Types\Type>
     */
    public function schema(JsonSchema $schema): array
    {
        return [
            'slug' => $schema->string()
                ->description('La fiche à retirer.')
                ->required(),
        ];
    }
}
