<?php

namespace App\Http\Controllers;

use App\Models\OrdemServico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    /**
     * Consulta de clientes.
     *
     * O sistema não tem uma tabela própria de clientes: os dados do cliente são
     * informados na Ordem de Serviço. Por isso a lista é montada agrupando as
     * OS pelo nome do cliente.
     */
    public function index(Request $request)
    {
        $busca = trim((string) $request->query('busca', ''));

        $clientes = OrdemServico::query()
            ->select([
                'cliente_nome',
                DB::raw('MAX(cliente_telefone) as telefone'),
                DB::raw('MAX(cliente_email) as email'),
                DB::raw('COUNT(*) as total_os'),
                DB::raw('SUM(valor_total) as total_gasto'),
                DB::raw('MAX(COALESCE(data_entrada, created_at)) as ultima_os'),
            ])
            ->when($busca !== '', function ($query) use ($busca) {
                $termo = '%' . $busca . '%';

                $query->where(function ($q) use ($termo) {
                    $q->where('cliente_nome', 'like', $termo)
                        ->orWhere('cliente_telefone', 'like', $termo)
                        ->orWhere('cliente_email', 'like', $termo);
                });
            })
            ->groupBy('cliente_nome')
            ->orderBy('cliente_nome')
            ->paginate(15)
            ->withQueryString();

        return view('clientes', [
            'clientes' => $clientes,
            'busca' => $busca,
            'totalClientes' => OrdemServico::distinct('cliente_nome')->count('cliente_nome'),
            'totalOrdens' => OrdemServico::count(),
            'faturamento' => (float) OrdemServico::sum('valor_total'),
        ]);
    }

    /**
     * Ordens de serviço de um cliente (usado para o "Ver OS" da lista).
     */
    public function show(Request $request)
    {
        $nome = trim((string) $request->query('nome', ''));

        abort_if($nome === '', 404);

        $ordens = OrdemServico::where('cliente_nome', $nome)
            ->orderByDesc('id')
            ->get();

        abort_if($ordens->isEmpty(), 404);

        return view('cliente-detalhe', [
            'nome' => $nome,
            'ordens' => $ordens,
            'telefone' => $ordens->pluck('cliente_telefone')->filter()->first(),
            'email' => $ordens->pluck('cliente_email')->filter()->first(),
            'totalGasto' => (float) $ordens->sum('valor_total'),
        ]);
    }
}
