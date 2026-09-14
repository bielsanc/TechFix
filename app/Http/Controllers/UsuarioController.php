<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Exibe o formulário de cadastro.
     */
    public function create()
    {
        return view('cadastro');
    }

    /**
     * Salva um novo usuário (técnico/administrador/atendente).
     */
    public function store(Request $request)
    {
        $dados = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'usuario' => ['required', 'string', 'max:255', 'unique:users,usuario'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'senha' => ['required', 'string', 'min:6'],
            'confirmar_senha' => ['required', 'string', 'min:6'],
            'perfil' => ['required', 'in:Técnico,Administrador,Atendente'],
            'telefone' => ['nullable', 'string', 'max:20'],
            'celular' => ['nullable', 'string', 'max:20'],
            'endereco' => ['nullable', 'string', 'max:255'],
            'bairro' => ['nullable', 'string', 'max:255'],
            'cidade' => ['nullable', 'string', 'max:255'],
            'estado' => ['nullable', 'string', 'max:2'],
            'cep' => ['nullable', 'string', 'max:10'],
        ]);

        // O campo de validação "confirmed" espera "senha_confirmation".
        // No formulário o campo se chama "confirmar_senha", então mapeamos manualmente.
        if ($request->input('senha') !== $request->input('confirmar_senha')) {
            return back()
                ->withInput()
                ->withErrors(['confirmar_senha' => 'A confirmação de senha não confere.']);
        }

        User::create([
            'name' => $dados['nome'],
            'usuario' => $dados['usuario'],
            'email' => $dados['email'],
            'password' => Hash::make($dados['senha']),
            'perfil' => $dados['perfil'],
            'telefone' => $dados['telefone'] ?? null,
            'celular' => $dados['celular'] ?? null,
            'endereco' => $dados['endereco'] ?? null,
            'bairro' => $dados['bairro'] ?? null,
            'cidade' => $dados['cidade'] ?? null,
            'estado' => $dados['estado'] ?? null,
            'cep' => $dados['cep'] ?? null,
        ]);

        return redirect('/dashboard')->with('sucesso', 'Usuário cadastrado com sucesso!');
    }
}
