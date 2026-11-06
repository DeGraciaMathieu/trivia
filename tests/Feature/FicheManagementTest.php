<?php

namespace Tests\Feature;

use App\Mcp\Servers\TriviaServer;
use App\Mcp\Tools\CreerFicheTool;
use App\Mcp\Tools\LireFicheTool;
use App\Mcp\Tools\ListerFichesTool;
use App\Mcp\Tools\ModifierFicheTool;
use App\Mcp\Tools\SupprimerFicheTool;
use App\Models\Fiche;
use App\Models\FicheRevision;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class FicheManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_l_auteur_publie_une_fiche_visible_aussitot_sur_le_site(): void
    {
        $this->getJson('/fiches.json')->assertJsonMissing(['slug' => 'daemon']);

        TriviaServer::actingAs($this->author())
            ->tool(CreerFicheTool::class, $this->validFiche())
            ->assertOk()
            ->assertHasNoErrors();

        $this->getJson('/fiches.json')->assertJsonFragment(['slug' => 'daemon', 'terme' => 'daemon']);
        $this->get('/')->assertSee('daemon');
    }

    public function test_l_auteur_modifie_une_fiche_et_le_site_affiche_la_nouvelle_version(): void
    {
        Fiche::factory()->create(['slug' => 'daemon', 'teaser' => 'Ancienne accroche.']);
        $this->getJson('/fiches.json')->assertJsonFragment(['teaser' => 'Ancienne accroche.']);

        TriviaServer::actingAs($this->author())
            ->tool(ModifierFicheTool::class, ['slug' => 'daemon', 'teaser' => 'Nouvelle accroche.'])
            ->assertHasNoErrors();

        $this->getJson('/fiches.json')
            ->assertJsonFragment(['teaser' => 'Nouvelle accroche.'])
            ->assertJsonMissing(['teaser' => 'Ancienne accroche.']);
    }

    public function test_l_auteur_supprime_une_fiche_et_elle_disparait_du_site(): void
    {
        Fiche::factory()->create(['slug' => 'daemon']);
        $this->getJson('/fiches.json')->assertJsonFragment(['slug' => 'daemon']);

        TriviaServer::actingAs($this->author())
            ->tool(SupprimerFicheTool::class, ['slug' => 'daemon'])
            ->assertHasNoErrors();

        $this->getJson('/fiches.json')->assertJsonMissing(['slug' => 'daemon']);
    }

    public function test_l_historique_conserve_l_etat_precedent_d_une_fiche_modifiee_puis_supprimee(): void
    {
        Fiche::factory()->create(['slug' => 'daemon', 'teaser' => 'Version originale.']);
        $server = TriviaServer::actingAs($this->author());

        $server->tool(ModifierFicheTool::class, ['slug' => 'daemon', 'teaser' => 'Version corrigée.']);
        $server->tool(SupprimerFicheTool::class, ['slug' => 'daemon']);

        $history = FicheRevision::where('slug', 'daemon')->orderBy('id')->get();

        $this->assertCount(2, $history);
        $this->assertSame('Version originale.', $history[0]->avant['teaser']);
        $this->assertSame('Version corrigée.', $history[1]->avant['teaser']);
    }

    public function test_un_autre_utilisateur_ne_peut_ni_creer_ni_modifier_ni_supprimer(): void
    {
        Fiche::factory()->create(['slug' => 'bang', 'teaser' => 'Accroche intacte.']);
        $server = TriviaServer::actingAs(User::factory()->create());

        $server->tool(CreerFicheTool::class, $this->validFiche())->assertHasErrors();
        $server->tool(ModifierFicheTool::class, ['slug' => 'bang', 'teaser' => 'Vandalisme.'])->assertHasErrors();
        $server->tool(SupprimerFicheTool::class, ['slug' => 'bang'])->assertHasErrors();

        $this->getJson('/fiches.json')
            ->assertJsonMissing(['slug' => 'daemon'])
            ->assertJsonFragment(['slug' => 'bang', 'teaser' => 'Accroche intacte.']);
    }

    #[DataProvider('invalidFiches')]
    public function test_une_fiche_hors_gabarit_est_refusee(array $override): void
    {
        TriviaServer::actingAs($this->author())
            ->tool(CreerFicheTool::class, [...$this->validFiche(), ...$override])
            ->assertHasErrors();

        $this->getJson('/fiches.json')->assertJsonMissing(['slug' => 'daemon']);
    }

    public static function invalidFiches(): array
    {
        return [
            'teaser too long' => [['teaser' => str_repeat('a', 171)]],
            'unknown category' => [['categorie' => 'Invented']],
            'story paragraph too short' => [['recit_2' => 'Too short.']],
            'missing legacy' => [['aujourdhui' => null]],
        ];
    }

    public function test_un_sujet_deja_traite_ne_peut_pas_etre_publie_une_seconde_fois(): void
    {
        Fiche::factory()->create(['slug' => 'daemon', 'teaser' => 'La fiche existante.']);

        TriviaServer::actingAs($this->author())
            ->tool(CreerFicheTool::class, $this->validFiche())
            ->assertHasErrors();

        $this->getJson('/fiches.json')->assertJsonFragment(['teaser' => 'La fiche existante.']);
    }

    public function test_les_fiches_existantes_peuvent_etre_listees_et_lues(): void
    {
        Fiche::factory()->create(['slug' => 'daemon', 'terme' => 'daemon', 'retenir' => 'Ni un démon ni un acronyme.']);

        TriviaServer::tool(ListerFichesTool::class)
            ->assertOk()
            ->assertSee('daemon');

        TriviaServer::tool(LireFicheTool::class, ['slug' => 'daemon'])
            ->assertOk()
            ->assertSee('Ni un démon ni un acronyme.');

        TriviaServer::tool(LireFicheTool::class, ['slug' => 'unknown'])
            ->assertHasErrors();
    }

    #[DataProvider('toolNames')]
    public function test_les_outils_portent_les_noms_cites_dans_les_instructions(string $tool, string $name): void
    {
        TriviaServer::tool($tool)->assertName($name);
    }

    public static function toolNames(): array
    {
        return [
            [ListerFichesTool::class, 'lister_fiches'],
            [LireFicheTool::class, 'lire_fiche'],
            [CreerFicheTool::class, 'creer_fiche'],
            [ModifierFicheTool::class, 'modifier_fiche'],
            [SupprimerFicheTool::class, 'supprimer_fiche'],
        ];
    }

    private function author(): User
    {
        return User::factory()->create(['email' => 'degracia.mathieu@gmail.com']);
    }

    private function validFiche(): array
    {
        return [
            'terme' => 'daemon',
            'categorie' => 'Unix',
            'date' => '1963, MIT, projet MAC',
            'teaser' => 'Ni un démon, ni un acronyme.',
            'recit_1' => str_repeat('Le contexte du projet MAC et de ses processus en arrière-plan. ', 3),
            'recit_2' => str_repeat('Le nom vient du démon de Maxwell, cité par les auteurs eux-mêmes. ', 3),
            'recit_3' => str_repeat('L\'acronyme Disk And Execution MONitor est venu bien plus tard. ', 3),
            'retenir' => 'DAEMON n\'a jamais été un acronyme.',
            'aujourdhui' => 'Les noms en d final, sshd ou httpd, perpétuent la convention.',
        ];
    }
}
