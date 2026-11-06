<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex">
<title>Connexion — Pourquoi déjà ?</title>
<style>
:root{
  --bg:#fff; --tx:#0d0d0d; --tx2:#4a4a4a; --hair:#e2e2e2; --ac:#d8432c;
  --sans:"Inter",system-ui,-apple-system,"Segoe UI",sans-serif;
}
@media (prefers-color-scheme: dark){:root{
  --bg:#0c0c0c; --tx:#f2f0ec; --tx2:#b3afa8; --hair:#2a2a2a; --ac:#ff6a4d;
}}
*{box-sizing:border-box}
body{margin:0;background:var(--bg);color:var(--tx);font-family:var(--sans);line-height:1.5;
  min-height:100vh;display:grid;place-items:center;padding:16px}
form{width:100%;max-width:340px;display:grid;gap:14px}
h1{font-size:28px;font-weight:800;letter-spacing:-.03em;margin:0 0 8px}
label{display:grid;gap:6px;font-size:14px;color:var(--tx2)}
input{font:inherit;color:var(--tx);background:transparent;border:1px solid var(--hair);
  border-radius:6px;padding:10px 12px}
button{font:inherit;font-weight:600;color:#fff;background:var(--ac);border:0;
  border-radius:6px;padding:11px;cursor:pointer}
.erreur{color:var(--ac);font-size:14px;margin:0}
</style>
</head>
<body>
<form method="POST" action="{{ route('login') }}">
  @csrf
  <h1>Connexion</h1>
  @error('email')<p class="erreur">{{ $message }}</p>@enderror
  <label>E-mail
    <input type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
  </label>
  <label>Mot de passe
    <input type="password" name="password" required autocomplete="current-password">
  </label>
  <button type="submit">Se connecter</button>
</form>
</body>
</html>
