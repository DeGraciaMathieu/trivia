<?php

namespace Tests\Feature;

use App\Models\Fiche;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SiteTest extends TestCase
{
    use RefreshDatabase;

    public function test_la_page_d_accueil_affiche_les_fiches(): void
    {
        Fiche::factory()->create(['terme' => 'daemon']);

        $this->get('/')
            ->assertOk()
            ->assertSee('daemon');
    }

    public function test_le_flux_json_expose_les_fiches(): void
    {
        Fiche::factory()->create(['slug' => 'daemon', 'terme' => 'daemon']);

        $this->getJson('/fiches.json')
            ->assertOk()
            ->assertJsonFragment(['slug' => 'daemon', 'terme' => 'daemon']);
    }

    public function test_le_site_s_affiche_sans_aucune_fiche(): void
    {
        $this->get('/')->assertOk();
    }
}
