<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
    <title>TechFix - Dashboard</title>
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

            <!-- SIDEBAR ESQUERDA -->
            <div class="sidebar">
                <div class="logo-area">
                    <img src="{{ asset('assets/imagens/logoTech.png') }}" alt="TechFix Logo" class="logo-sidebar">
                </div>

                <nav class="nav-menu">
                    <a href="#" class="nav-item active">
                        <img src="{{ asset('assets/imagens/casa.png') }}" alt="Dashboard" class="icon-nav">
                        Dashboard
                    </a>
                    <a href="{{ url('/ordem') }}" class="nav-item">
                        <img src="{{ asset('assets/imagens/papel.png') }}" alt="Clientes" class="icon-nav">
                        Ordem de Serviços
                    </a>
                  <a href="{{ url('/cadastro') }}"  class="nav-item">
                        <img src="{{ asset('assets/imagens/user.png') }}" alt="Clientes" class="icon-nav">
                        Clientes
                    </a>
                    
                    <a href="#" class="nav-item">
                        <img src="{{ asset('assets/imagens/pc.png') }}" alt="Equipamentos" class="icon-nav">
                        Equipamentos
                    </a>
                    <a href="#" class="nav-item">
                        <img src="{{ asset('assets/imagens/graficos.png') }}" alt="Relatórios" class="icon-nav">
                        Relatórios
                    </a>
                    <a href="#" class="nav-item">
                        <img src="{{ asset('assets/imagens/dinheiro.png') }}" alt="Financeiro" class="icon-nav">
                        Financeiro
                    </a>
                    <a href="#" class="nav-item">
                        <img src="{{ asset('assets/imagens/engrenagem.png') }}" alt="Configurações" class="icon-nav">
                        Configurações
                    </a>
                    <a href="#" class="nav-item">
                        <img src="{{ asset('assets/imagens/interrogacao.png') }}" alt="Ajuda" class="icon-nav">
                        Ajuda
                    </a>
                    <form action="{{ url('/logout') }}" method="POST" class="nav-item sair" style="border:0; background:none; padding:0;">
                        @csrf
                        <button type="submit" style="all:unset; display:flex; align-items:center; gap:8px; cursor:pointer;">
                            <img src="{{ asset('assets/imagens/saida.png') }}" alt="Sair" class="icon-nav">
                            Sair
                        </button>
                    </form>
                </nav>
            </div>

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
                            <button class="btn-atalho">
                                <img src="{{ asset('assets/imagens/graficos.png') }}" alt="Relatório" class="icon-btn">
                                Relatório de OS
                            </button>
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

</body>
</html>