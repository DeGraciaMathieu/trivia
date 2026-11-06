<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\ClientRepository;
use Tests\TestCase;

class AccessTest extends TestCase
{
    use RefreshDatabase;

    private const CLAUDE_CALLBACK = 'https://claude.ai/api/mcp/auth_callback';

    protected function setUp(): void
    {
        parent::setUp();

        $key = openssl_pkey_new(['private_key_bits' => 2048]);
        openssl_pkey_export($key, $privateKey);

        config([
            'passport.private_key' => $privateKey,
            'passport.public_key' => openssl_pkey_get_details($key)['key'],
        ]);
    }

    public function test_le_serveur_mcp_refuse_une_requete_sans_jeton(): void
    {
        $this->postJson('/mcp/trivia')
            ->assertUnauthorized()
            ->assertHeader('WWW-Authenticate');
    }

    public function test_l_autorisation_oauth_demande_d_abord_de_se_connecter(): void
    {
        $this->get($this->authorizeUrl())->assertRedirect(route('login'));
    }

    public function test_une_fois_connecte_on_arrive_sur_l_ecran_d_approbation(): void
    {
        $user = User::factory()->create(['password' => 'secret-password']);
        $authorizeUrl = $this->authorizeUrl();

        $this->get($authorizeUrl);
        $this->post('/connexion', ['email' => $user->email, 'password' => 'secret-password'])
            ->assertRedirectContains('/oauth/authorize');

        $this->get($authorizeUrl)
            ->assertOk()
            ->assertSee($user->email);
    }

    public function test_un_mauvais_mot_de_passe_est_refuse(): void
    {
        $user = User::factory()->create(['password' => 'secret-password']);

        $this->post('/connexion', ['email' => $user->email, 'password' => 'wrong-password'])
            ->assertSessionHasErrors('email');

        $this->assertGuest();
    }

    public function test_personne_ne_peut_creer_de_compte(): void
    {
        $this->post('/register', ['email' => 'intruder@example.com', 'password' => 'password'])->assertNotFound();
        $this->postJson('/oauth/register', ['redirect_uris' => [self::CLAUDE_CALLBACK]])->assertNotFound();

        $this->assertDatabaseCount('users', 0);
    }

    private function authorizeUrl(): string
    {
        $client = app(ClientRepository::class)
            ->createAuthorizationCodeGrantClient('claude', [self::CLAUDE_CALLBACK]);

        $verifier = str_repeat('v', 64);
        $challenge = rtrim(strtr(base64_encode(hash('sha256', $verifier, true)), '+/', '-_'), '=');

        return '/oauth/authorize?' . http_build_query([
            'response_type' => 'code',
            'client_id' => $client->id,
            'redirect_uri' => self::CLAUDE_CALLBACK,
            'scope' => 'mcp:use',
            'state' => 'state',
            'code_challenge' => $challenge,
            'code_challenge_method' => 'S256',
        ]);
    }
}
