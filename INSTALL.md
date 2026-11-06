# Installation

Le dépôt contient le code applicatif seulement. À déposer dans une
application Laravel fraîche.

## 1. Le squelette

```bash
laravel new trivia && cd trivia
composer require laravel/mcp laravel/passport
php artisan vendor:publish --tag=ai-routes
```

Puis copier par-dessus : `app/`, `routes/`, `database/`, `resources/views/`,
`contenu/`.

## 2. Passport et OAuth 2.1

```bash
php artisan install:api --passport
php artisan vendor:publish --tag=mcp-views
```

`install:api --passport` crée le garde `api`, les tables et les clés. Le
modèle `User` doit implémenter `OAuthenticatable` et utiliser le trait
`HasApiTokens` de Passport.

Déclarer la vue d'autorisation dans `AppServiceProvider::boot()` — c'est
l'écran qui te demandera d'approuver la connexion depuis l'app Claude :

```php
use Laravel\Passport\Passport;

Passport::authorizationView(fn ($parameters) => view('mcp.authorize', $parameters));
```

Laravel MCP ajoute et utilise une unique portée `mcp:use`. Les portées
personnalisées ne sont pas supportées pour l'instant.

## 3. La permission d'écriture

Les trois outils d'écriture vérifient `can('ecrire-fiches')`. Définir la
porte dans `AppServiceProvider::boot()` :

```php
use Illuminate\Support\Facades\Gate;

Gate::define('ecrire-fiches', fn ($user) => $user->email === 'degracia.mathieu@gmail.com');
```

Sans ça, personne n'écrit — y compris toi. C'est volontaire : il n'y a pas
d'étape de relecture, donc l'autorisation est le seul garde-fou.

## 4. Base et amorçage

```bash
php artisan migrate
php artisan db:seed --class=Database\\Seeders\\FichesSeeder
```

Le seeder importe les 71 fiches depuis `contenu/`. Après ça, le markdown
n'est plus la source : le MCP écrit en base.

## 5. Cache

`CACHE_STORE=redis` ou `file`. Surtout pas `array` : le cache serait vide à
chaque requête. Le site lit deux clés, `fiches.donnees` et `fiches.page`,
oubliées automatiquement à chaque écriture d'une fiche.

## 6. Brancher ton Claude, et seulement lui

Un seul compte, un seul client OAuth, aucune inscription possible.

```bash
# ton compte, le seul qui existera
php artisan tinker --execute="App\Models\User::create(['name' => 'Mathieu', 'email' => 'degracia.mathieu@gmail.com', 'password' => bcrypt('…')]);"

# le client OAuth de Claude
php artisan passport:client --name=claude --redirect_uri=https://claude.ai/api/mcp/auth_callback
```

La seconde commande affiche un Client ID et un Client Secret. Dans
claude.ai, Paramètres → Connecteurs → Ajouter un connecteur personnalisé :
l'URL `https://<ton-domaine>/mcp/trivia`, puis les deux identifiants dans
les paramètres avancés. Tu te connectes une fois avec ton compte, tu
approuves, c'est fini.

Ne pas installer de route d'inscription (pas de Breeze en mode register,
ou la désactiver) : le compte unique est ce qui rend la porte
`ecrire-fiches` superflue en pratique, mais on la garde en ceinture.

En local, sans authentification :

```bash
php artisan mcp:start trivia
```

## Points de vigilance

- **L'enregistrement dynamique de client est désactivé**
  (`registration: false`). Un client qui ne connaît pas l'identifiant créé
  à l'étape 6 ne peut même pas démarrer le flux.
- **Pas de relecture** : un appel à `creer_fiche` publie. L'historique
  (`fiche_revisions`) est le seul moyen de voir ce qui a changé. Une ligne y
  est écrite avant chaque modification et chaque suppression.
- **Le gabarit vit dans le schéma** : trois champs de récit séparés rendent
  une fiche à quatre paragraphes impossible, et l'énumération des catégories
  interdit d'en inventer une. L'angle éditorial, lui, est dans
  `#[Instructions]` du serveur — c'est le texte que Claude lit avant
  d'écrire. C'est là qu'il faut intervenir si les fiches dérivent.
