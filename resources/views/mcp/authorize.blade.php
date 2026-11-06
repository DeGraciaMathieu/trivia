<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @class(['dark' => ($appearance ?? 'system') == 'dark'])>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Inline script to detect system dark mode preference and apply it immediately --}}
    <script>
        (function() {
            const appearance = '{{ $appearance ?? "system" }}';

            if (appearance === 'system') {
                const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

                if (prefersDark) {
                    document.documentElement.classList.add('dark');
                }
            }
        })();
    </script>

    <style>
        html {
            background-color: oklch(1 0 0);
        }

        html.dark {
            background-color: oklch(0.145 0 0);
        }
    </style>

    <title>Authorize Application - {{ config('app.name', 'MCP Server') }}</title>

    <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
    <meta name="apple-mobile-web-app-title" content="Authorize MCP" />
    <link rel="manifest" href="/site.webmanifest" />

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    {{-- Pas de build front : les classes utilisées par cette vue sont définies ici. --}}
    <style>
        :root { --bg: #fff; --tx: #0d0d0d; --tx2: #4a4a4a; --hair: #e2e2e2; --muted: #f5f5f5; --ac: #d8432c; }
        html.dark { --bg: #0c0c0c; --tx: #f2f0ec; --tx2: #b3afa8; --hair: #2a2a2a; --muted: #141414; --ac: #ff6a4d; }
        *, ::before, ::after { box-sizing: border-box; border: 0 solid var(--hair); }
        body { margin: 0; line-height: 1.5; }
        h3, p, ul { margin: 0; padding: 0; list-style: none; }
        button { font: inherit; cursor: pointer; }
        .font-sans { font-family: 'Instrument Sans', system-ui, sans-serif; }
        .antialiased { -webkit-font-smoothing: antialiased; }
        .bg-background, .bg-card { background: var(--bg); }
        .text-foreground, .text-card-foreground { color: var(--tx); }
        .text-muted-foreground { color: var(--tx2); }
        .bg-muted\/50 { background: var(--muted); }
        .text-primary { color: var(--ac); }
        .bg-primary { background: var(--ac); }
        .bg-primary\/10 { background: color-mix(in srgb, var(--ac) 10%, transparent); }
        .text-primary-foreground { color: #fff; }
        .min-h-screen { min-height: 100vh; }
        .flex { display: flex; }
        .inline-flex { display: inline-flex; }
        .hidden { display: none; }
        .flex-col { flex-direction: column; }
        .flex-1 { flex: 1; }
        .items-center { align-items: center; }
        .items-start { align-items: flex-start; }
        .justify-center { justify-content: center; }
        .gap-2 { gap: .5rem; }
        .gap-3 { gap: .75rem; }
        .space-y-1\.5 > * + * { margin-top: .375rem; }
        .space-y-2 > * + * { margin-top: .5rem; }
        .space-y-4 > * + * { margin-top: 1rem; }
        .w-full { width: 100%; }
        .max-w-md { max-width: 28rem; }
        .h-12 { height: 3rem; } .w-12 { width: 3rem; }
        .h-10 { height: 2.5rem; }
        .h-4 { height: 1rem; } .w-4 { width: 1rem; }
        .h-1\.5 { height: .375rem; } .w-1\.5 { width: .375rem; }
        .p-1 { padding: .25rem; } .p-4 { padding: 1rem; } .p-6 { padding: 1.5rem; }
        .pt-0 { padding-top: 0; }
        .px-4 { padding-left: 1rem; padding-right: 1rem; }
        .py-2 { padding-top: .5rem; padding-bottom: .5rem; }
        .mb-2 { margin-bottom: .5rem; } .mb-4 { margin-bottom: 1rem; }
        .mt-0\.5 { margin-top: .125rem; }
        .mr-2 { margin-right: .5rem; } .mr-3 { margin-right: .75rem; } .-ml-1 { margin-left: -.25rem; }
        .border { border-width: 1px; }
        .rounded { border-radius: .25rem; } .rounded-md { border-radius: .375rem; }
        .rounded-lg { border-radius: .5rem; } .rounded-full { border-radius: 9999px; }
        .shadow-sm { box-shadow: 0 1px 2px rgb(0 0 0 / .05); }
        .object-contain { object-fit: contain; }
        .text-xs { font-size: .75rem; } .text-sm { font-size: .875rem; } .text-2xl { font-size: 1.5rem; }
        .font-medium { font-weight: 500; } .font-semibold { font-weight: 600; }
        .leading-none { line-height: 1; }
        .tracking-tight { letter-spacing: -.025em; }
        .text-center { text-align: center; }
        .underline { text-decoration: underline; }
        .break-all { word-break: break-all; }
        .whitespace-nowrap { white-space: nowrap; }
        .opacity-25 { opacity: .25; } .opacity-75 { opacity: .75; }
        .disabled\:opacity-50:disabled { opacity: .5; }
        .animate-spin { animation: spin 1s linear infinite; }
        @keyframes spin { to { transform: rotate(360deg); } }
    </style>
</head>
<body class="font-sans antialiased bg-background text-foreground">
<div class="min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Card Container -->
        <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
            <!-- Header -->
            <div class="flex flex-col space-y-1.5 p-6">
                <div class="flex items-center justify-center mb-4">
                    @if ($client->logo_uri ?? null)
                    <img src="{{ $client->logo_uri }}" alt="{{ $client->name }}" class="h-12 w-12 rounded object-contain">
                    @else
                    <!-- Shield Icon -->
                    <svg class="h-12 w-12 text-primary" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.618 5.984A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.031 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                    @endif
                </div>

                <h3 class="text-2xl font-semibold leading-none tracking-tight text-center">
                    Authorize {{ $client->name }}
                </h3>

                <p class="text-sm text-muted-foreground text-center">
                    This application will be able to:<br/>Use available MCP functionality.
                </p>

                @php($redirectUri = request()->query('redirect_uri', $client->redirect_uris[0] ?? null))
                @if ($redirectUri)
                <p class="text-xs text-muted-foreground text-center break-all">
                    You will be redirected to {{ $redirectUri }}
                </p>
                @endif

                @if ($client->client_uri ?? null)
                <a href="{{ $client->client_uri }}" target="_blank" rel="noopener noreferrer" class="text-sm text-primary underline text-center">
                    {{ $client->client_uri }}
                </a>
                @endif
            </div>

            <!-- Content -->
            <div class="p-6 pt-0 space-y-4">
                <!-- User Info -->
                <div class="rounded-lg border p-4 bg-muted/50">
                    <p class="text-sm text-muted-foreground mb-2">Logged in as:</p>
                    <p class="font-medium">{{ $user->email }}</p>
                </div>

                <!-- Scopes / Permissions -->
                @if(count($scopes) > 0)
                    <div class="space-y-2">
                        <p class="text-sm font-medium">Permissions:</p>

                        <ul class="space-y-2">
                            @foreach($scopes as $scope)
                                <li class="flex items-start gap-2">
                                    <div class="rounded-full bg-primary/10 p-1 mt-0.5">
                                        <div class="h-1.5 w-1.5 rounded-full bg-primary"></div>
                                    </div>
                                    <span class="text-sm text-muted-foreground">
                                        {{ $scope->description }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <!-- Footer With Buttons -->
            <div class="flex items-center p-6 pt-0 gap-3">
                <!-- Deny Form -->
                <form method="POST" action="{{ route('passport.authorizations.deny') }}" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="state" value="">
                    <input type="hidden" name="client_id" value="{{ $client->id }}">
                    <input type="hidden" name="auth_token" value="{{ $authToken }}">
                    <button type="submit" class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2 w-full">
                        <svg class="mr-2 h-4 w-4" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Cancel
                    </button>
                </form>

                <!-- Approve Form -->
                <form method="POST" action="{{ route('passport.authorizations.approve') }}" class="flex-1" id="authorizeForm">
                    @csrf
                    <input type="hidden" name="state" value="">
                    <input type="hidden" name="client_id" value="{{ $client->id }}">
                    <input type="hidden" name="auth_token" value="{{ $authToken }}">
                    <button type="submit" class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2 w-full" id="authorizeButton">
                        <span id="authorizeText">Authorize</span>

                        <svg id="loadingSpinner" class="animate-spin -ml-1 mr-3 h-4 w-4 text-white hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('authorizeForm');
        const button = document.getElementById('authorizeButton');
        const authorizeText = document.getElementById('authorizeText');
        const loadingSpinner = document.getElementById('loadingSpinner');

        form.addEventListener('submit', function(e) {
            // Show loading state...
            button.disabled = true;
            authorizeText.textContent = 'Authorizing...';
            loadingSpinner.classList.remove('hidden');

            // After form submission, watch for redirect and close window...
            setTimeout(function() {
                const checkRedirect = setInterval(function() {
                    // If URL changed or we have OAuth params, redirect happened...
                    if (!window.location.href.includes('/oauth/authorize') ||
                        window.location.search.includes('code=') ||
                        window.location.search.includes('error=')) {
                        clearInterval(checkRedirect);
                        window.close();
                    }
                }, 100);

                // Fallback: Close after five seconds...
                setTimeout(function() {
                    clearInterval(checkRedirect);
                    window.close();
                }, 5000);
            }, 200);
        });

        // Handle cancel button...
        const cancelForm = document.querySelector('form[method="POST"]:has(input[name="_method"][value="DELETE"])');
        if (cancelForm) {
            cancelForm.addEventListener('submit', function(e) {
                setTimeout(function() {
                    window.close();
                }, 200);
            });
        }
    });
</script>
</body>
</html>
