<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * Connexion seule, sans inscription : c'est l'écran vers lequel Passport
 * renvoie quand l'app Claude demande l'autorisation et que la session est
 * vide. Le compte unique est créé à la main (voir INSTALL.md).
 */
class ConnexionController extends Controller
{
    public function formulaire(): View
    {
        return view('connexion');
    }

    public function connecter(Request $request): RedirectResponse
    {
        $identifiants = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt($identifiants)) {
            return back()
                ->withErrors(['email' => 'Identifiants incorrects.'])
                ->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()->intended(route('site'));
    }
}
