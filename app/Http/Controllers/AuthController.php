<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Exibe o formulário de login.
     */
    public function create()
    {
        if (Auth::check()) {
            return redirect('/dashboard');
        }

        return view('login');
    }

    /**
     * Processa a tentativa de login.
     */
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'usuario' => ['required', 'string'],
            'senha' => ['required', 'string'],
        ]);

        $lembrar = $request->boolean('lembrar');

        $ok = Auth::attempt([
            'usuario' => $credentials['usuario'],
            'password' => $credentials['senha'],
        ], $lembrar);

        if (! $ok) {
            return back()
                ->withInput($request->only('usuario'))
                ->withErrors(['usuario' => 'Usuário ou senha inválidos.']);
        }

        $request->session()->regenerate();

        return redirect()->intended('/dashboard');
    }

    /**
     * Efetua o logout.
     */
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
