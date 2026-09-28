<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
    <title>TechFix - Dashboard</title>
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

    <div class="janela">

        <!-- BARRA DE TÍTULO -->
        <div class="barra-titulo">
            <div class="titulo">
                <img src="{{ asset('assets/imagens/logoTech.png') }}" alt="TechFix">
                <span>TechFix - Dashboard</span>
            </div>
            <div class="botoes-janela">
                <button>−</button>
                <button>□</button>
                <button class="fechar">×</button>
            </div>
        </div>

        <!-- MENU SUPERIOR -->
        <div class="menu-bar">
            <span>Arquivo</span>
            <span>Relatórios</span>
            <span>Ferramentas</span>
            <span>Ajuda</span>
        </div>

        <!-- CONTEÚDO PRINCIPAL -->
        <div class="conteudo">

            @include('partials.sidebar', ['ativo' => 'dashboard'])

            <!-- PAINEL PRINCIPAL -->
            <div class="painel-principal">

                <!-- CABEÇALHO BOAS-VINDAS -->
                <div class="header-boas-vindas">
                    <div class="info-usuario">
                        <strong>Bem-vindo, {{ auth()->user()->name }}!</strong>
                        <span>Data: {{ now()->format('d/m/Y - H:i') }}</span>
                    </div>
                    <img src="{{ asset('assets/imagens/ampulheta.png') }}" alt="Aguardando" class="icon-ampulheta">
                </div>

                <!-- CARDS DE METRICAS -->
                <div class="cards-grid">
                    <div class="card-metrica">
                        <span class="numero azul">{{ str_pad($abertas, 2, '0', STR_PAD_LEFT) }}</span>
                        <span class="rotulo">Ordens Abertas</span>
                    </div>
                    <div class="card-metrica">
                        <span class="numero amarelo">{{ str_pad($andamento, 2, '0', STR_PAD_LEFT) }}</span>
                        <span class="rotulo">Em Andamento</span>
                    </div>
                    <div class="card-metrica">
                        <span class="numero verde">{{ str_pad($concluidasMes, 2, '0', STR_PAD_LEFT) }}</span>
                        <span class="rotulo">Finalizadas (Mês)</span>
                    </div>
                    <div class="card-metrica">
                        <span class="numero vermelho">{{ str_pad($aguardandoPecas, 2, '0', STR_PAD_LEFT) }}</span>
                        <span class="rotulo">Aguardando Peças</span>
                    </div>
                </div>

                <!-- SEÇÃO INFERIOR -->
                <div class="painel-inferior">

                    <!-- CAIXA DO GRÁFICO -->
                    <div class="caixa-grafico">
                        <div class="caixa-header">
                            <span>Visão Geral dos Status</span>
                        </div>
                        <div class="area-grafico">
                            <canvas id="graficoStatus"></canvas>
                        </div>
                    </div>

                    <!-- TABELA DE ORDENS DE SERVIÇO -->
                    <div class="caixa-tabela">
                        <div class="caixa-header">
                            <span>Ordens de Serviço Recentes</span>
                            <a href="#">Ver todas</a>
                        </div>
                        <div class="caixa-body">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Nº OS</th>
                                        <th>Cliente</th>
                                        <th>Equipamento</th>
                                        <th>Status</th>
                                        <th>Entrada</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($recentes as $os)
                                        <tr>
                                            <td>{{ $os->numero }}</td>
                                            <td>{{ $os->cliente_nome }}</td>
                                            <td>{{ $os->tipo_equipamento }} {{ $os->marca }}</td>
                                            <td>
                                                @php
                                                    $classe = match($os->status) {
                                                        'Em andamento' => 'azul',
                                                        'Aguardando Peças' => 'amarelo',
                                                        'Concluída' => 'verde',
                                                        default => 'cinza',
                                                    };
                                                @endphp
                                                <span class="badge {{ $classe }}">{{ $os->status }}</span>
                                            </td>
                                            <td>{{ optional($os->data_entrada)->format('d/m/Y') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5">Nenhuma ordem de serviço cadastrada ainda.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- ATALHOS RÁPIDOS -->
                    <div class="caixa-atalhos">
                        <div class="caixa-header">
                            <span>Atalhos Rápidos</span>
                        </div>
                        <div class="caixa-body atalhos-list">
                            <a href="{{ url('/ordem') }}" class="btn-atalho">
                                <img src="{{ asset('assets/imagens/papel.png') }}" alt="Nova OS" class="icon-btn">
                                Nova Ordem de Serviço
                            </a>
                            <a href="{{ url('/cadastro') }}" class="btn-atalho">
                                <img src="{{ asset('assets/imagens/user.png') }}" alt="Cliente" class="icon-btn">
                                Cadastrar Usuário
                            </a>
                            <button class="btn-atalho">
                                <img src="{{ asset('assets/imagens/pc.png') }}" alt="Equipamento" class="icon-btn">
                                Cadastrar Equipamento
                            </button>
                            <a href="{{ route('relatorios') }}" class="btn-atalho">
                                <img src="{{ asset('assets/imagens/graficos.png') }}" alt="Relatório" class="icon-btn">
                                Relatório de OS
                            </a>
                            <button class="btn-atalho">
                                <img src="{{ asset('assets/imagens/salvar.png') }}" alt="Backup" class="icon-btn">
                                Backup do Sistema
                            </button>
                        </div>
                    </div>

                </div>

            </div>

        </div>

        <!-- RODAPÉ DE STATUS -->
        <div class="status-bar">
            <span>Pronto</span>
            <span class="conectado">🟢 Conectado</span>
        </div>

    </div>

    <!-- SCRIPT DO GRÁFICO -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('graficoStatus').getContext('2d');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Abertas', 'Em Andamento', 'Concluídas', 'Aguardando Peças'],
                    datasets: [{
                        label: 'Quantidade',
                        data: [
                            {{ $abertas }},
                            {{ $andamento }},
                            {{ $concluidas }},
                            {{ $aguardandoPecas }}
                        ],
                        backgroundColor: [
                            '#0033cc',
                            '#cc9900',
                            '#008000',
                            '#cc0000'
                        ],
                        borderColor: '#000000',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { precision: 0, font: { family: 'Tahoma' } }
                        },
                        x: {
                            ticks: { font: { family: 'Tahoma' } }
                        }
                    }
                }
            });
        });
    </script>

</body>
</html>
