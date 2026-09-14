<?php

namespace App\Http\Controllers;

use App\Models\OrdemServico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdemServicoController extends Controller
{
    /**
     * Exibe o formulário de nova Ordem de Serviço.
     */
    public function create()
    {
        $numero = OrdemServico::proximoNumero();

        return view('ordem', ['numero' => $numero, 'ordem' => null]);
    }

    /**
     * Salva a Ordem de Serviço.
     */
    public function store(Request $request)
    {
        $dados = $request->validate([
            'cliente' => ['required', 'string', 'max:255'],
            'telefone' => ['nullable', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:255'],
            'tipo' => ['nullable', 'string', 'max:255'],
            'marca' => ['nullable', 'string', 'max:255'],
            'modelo' => ['nullable', 'string', 'max:255'],
            'serie' => ['nullable', 'string', 'max:255'],
            'acessorios' => ['nullable', 'string', 'max:255'],
            'descricao_problema' => ['nullable', 'string'],
            'status' => ['required', 'in:Aberta,Em andamento,Aguardando Peças,Concluída'],
            'tecnico' => ['nullable', 'string', 'max:255'],
            'data_entrada' => ['nullable', 'date_format:d/m/Y'],
            'previsao_entrega' => ['nullable', 'date_format:d/m/Y'],
            'itens_descricao' => ['array'],
            'itens_descricao.*' => ['nullable', 'string', 'max:255'],
            'itens_valor' => ['array'],
            'itens_valor.*' => ['nullable', 'numeric'],
        ]);

        $itens = [];
        $total = 0;

        foreach ($dados['itens_descricao'] ?? [] as $i => $descricao) {
            if (trim((string) $descricao) === '') {
                continue;
            }

            $valor = (float) ($dados['itens_valor'][$i] ?? 0);
            $itens[] = ['descricao' => $descricao, 'valor' => $valor];
            $total += $valor;
        }

        OrdemServico::create([
            'numero' => OrdemServico::proximoNumero(),
            'cliente_nome' => $dados['cliente'],
            'cliente_telefone' => $dados['telefone'] ?? null,
            'cliente_email' => $dados['email'] ?? null,
            'tipo_equipamento' => $dados['tipo'] ?? null,
            'marca' => $dados['marca'] ?? null,
            'modelo' => $dados['modelo'] ?? null,
            'numero_serie' => $dados['serie'] ?? null,
            'acessorios' => $dados['acessorios'] ?? null,
            'descricao_problema' => $dados['descricao_problema'] ?? null,
            'itens' => $itens,
            'valor_total' => $total,
            'status' => $dados['status'],
            'tecnico' => $dados['tecnico'] ?? null,
            'data_entrada' => isset($dados['data_entrada']) ? \DateTime::createFromFormat('d/m/Y', $dados['data_entrada']) : null,
            'previsao_entrega' => isset($dados['previsao_entrega']) ? \DateTime::createFromFormat('d/m/Y', $dados['previsao_entrega']) : null,
            'usuario_id' => Auth::id(),
        ]);

        return redirect('/dashboard')->with('sucesso', 'Ordem de serviço registrada com sucesso!');
    }
}
