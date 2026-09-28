<?php

namespace App\Http\Controllers;

use App\Models\OrdemServico;
use Illuminate\Support\Carbon;

class RelatorioController extends Controller
{
    public function index()
    {
        $inicio = now()->startOfMonth()->subMonths(5);
        $ordens = OrdemServico::where('created_at', '>=', $inicio)->get(['created_at', 'status']);
        $meses = collect(range(0, 5))->map(fn (int $offset) => $inicio->copy()->addMonths($offset));
        $ordensPorMes = $meses->map(fn (Carbon $mes) => $ordens->filter(fn (OrdemServico $ordem) =>
            $ordem->created_at->year === $mes->year && $ordem->created_at->month === $mes->month
        )->count());
        $status = ['Aberta', 'Em andamento', 'Aguardando Peças', 'Concluída'];

        return view('relatorios', [
            'labelsMeses' => $meses->map(fn (Carbon $mes) => $mes->format('m/Y')),
            'ordensPorMes' => $ordensPorMes,
            'labelsStatus' => $status,
            'ordensPorStatus' => collect($status)->map(fn (string $item) => OrdemServico::where('status', $item)->count()),
            'totalOrdens' => OrdemServico::count(),
            'ordensMes' => OrdemServico::where('created_at', '>=', now()->startOfMonth())->count(),
            'concluidasMes' => OrdemServico::where('status', 'Concluída')->whereMonth('updated_at', now()->month)->whereYear('updated_at', now()->year)->count(),
        ]);
    }
}

