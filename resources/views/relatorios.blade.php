<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
    <title>TechFix - Relatórios</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<div class="janela">
    <div class="barra-titulo">
        <div class="titulo"><img src="{{ asset('assets/imagens/logoTech.png') }}" alt="TechFix"><span>TechFix - Relatórios de OS</span></div>
        <div class="botoes-janela"><button>-</button><button>?</button><button class="fechar">×</button></div>
    </div>
    <div class="conteudo">
        @include('partials.sidebar', ['ativo' => 'relatorios'])
        <main class="painel-principal">
            <div class="header-boas-vindas">
                <div class="info-usuario"><strong>Relatório de Ordens de Serviço</strong><span>Visão geral da operação e dos últimos seis meses.</span></div>
                <a href="{{ route('dashboard') }}" class="btn-xp">Voltar ao dashboard</a>
            </div>
            <div class="cards-grid">
                <div class="card-metrica"><span class="numero azul">{{ $totalOrdens }}</span><span class="rotulo">Total de ordens</span></div>
                <div class="card-metrica"><span class="numero amarelo">{{ $ordensMes }}</span><span class="rotulo">Criadas neste mês</span></div>
                <div class="card-metrica"><span class="numero verde">{{ $concluidasMes }}</span><span class="rotulo">Concluídas neste mês</span></div>
                <div class="card-metrica"><span class="numero vermelho">{{ $ordensPorStatus[2] }}</span><span class="rotulo">Aguardando peças</span></div>
            </div>
            <div class="relatorios-grid">
                <section class="caixa-grafico">
                    <div class="caixa-header"><span>Ordens criadas por mês</span></div>
                    <div class="area-grafico"><canvas id="graficoMensal" aria-label="Ordens de serviço criadas por mês nos últimos seis meses"></canvas></div>
                </section>
                <section class="caixa-grafico">
                    <div class="caixa-header"><span>Ordens por status</span></div>
                    <div class="area-grafico"><canvas id="graficoStatus" aria-label="Ordens de serviço por status"></canvas></div>
                </section>
            </div>
        </main>
    </div>
    <div class="status-bar"><span>Pronto</span><span class="conectado">Conectado</span></div>
</div>
<script>
    const labelsMeses = @json($labelsMeses);
    const dadosMensais = @json($ordensPorMes);
    const labelsStatus = @json($labelsStatus);
    const dadosStatus = @json($ordensPorStatus);
    new Chart(document.getElementById('graficoMensal'), {
        type: 'bar',
        data: { labels: labelsMeses, datasets: [{ label: 'Ordens de serviço', data: dadosMensais, backgroundColor: '#316ac5', borderColor: '#0a246a', borderWidth: 1 }] },
        options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, ticks: { precision: 0 } } } }
    });
    new Chart(document.getElementById('graficoStatus'), {
        type: 'doughnut',
        data: { labels: labelsStatus, datasets: [{ data: dadosStatus, backgroundColor: ['#316ac5', '#d9a000', '#cc0000', '#2e8b57'] }] },
        options: { responsive: true, maintainAspectRatio: false }
    });
</script>
</body>
</html>
