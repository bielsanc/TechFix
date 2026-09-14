<?php

namespace App\Http\Controllers;

use App\Models\OrdemServico;

class DashboardController extends Controller
{
    public function index()
    {
        $abertas = OrdemServico::where('status', 'Aberta')->count();
        $andamento = OrdemServico::where('status', 'Em andamento')->count();
        $aguardandoPecas = OrdemServico::where('status', 'Aguardando Peças')->count();
        $concluidasMes = OrdemServico::where('status', 'Concluída')
            ->whereMonth('updated_at', now()->month)
            ->whereYear('updated_at', now()->year)
            ->count();

        $recentes = OrdemServico::orderByDesc('id')->limit(5)->get();

        return view('dashboard', [
            'abertas' => $abertas,
            'andamento' => $andamento,
            'concluidasMes' => $concluidasMes,
            'aguardandoPecas' => $aguardandoPecas,
            'recentes' => $recentes,
        ]);
    }
}
