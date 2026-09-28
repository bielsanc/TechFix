<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/clientes.css') }}">
    <title>TechFix - Clientes</title>
</head>
<body>

    <div class="janela">

        <!-- BARRA DE TÍTULO -->
        <div class="barra-titulo">
            <div class="titulo">
                <img src="{{ asset('assets/imagens/logoTech.png') }}" alt="TechFix">
                <span>TechFix - Consulta de Clientes</span>
            </div>
            <div class="botoes-janela">
                <button>−</button>
                <button>□</button>
                <button class="fechar">×</button>
            </div>
        </div>

        <div class="conteudo">

            @include('partials.sidebar', ['ativo' => 'clientes'])

            <div class="painel-principal">

                <!-- CARDS DE RESUMO -->
                <div class="cards-grid tres">
                    <div class="card-metrica">
                        <span class="numero azul">{{ $totalClientes }}</span>
                        <span class="rotulo">Clientes</span>
                    </div>
                    <div class="card-metrica">
                        <span class="numero amarelo">{{ $totalOrdens }}</span>
                        <span class="rotulo">Ordens de Serviço</span>
                    </div>
                    <div class="card-metrica">
                        <span class="numero verde valor">R$ {{ number_format($faturamento, 2, ',', '.') }}</span>
                        <span class="rotulo">Total em Serviços</span>
                    </div>
                </div>

                <!-- CONSULTA -->
                <div class="caixa-tabela consulta">
                    <div class="caixa-header">
                        <span>Clientes Cadastrados</span>
                        <span class="contagem">{{ $clientes->total() }} encontrado(s)</span>
                    </div>

                    <div class="caixa-body">

                        <form method="GET" action="{{ url('/clientes') }}" class="form-busca">
                            <label for="busca">Buscar:</label>
                            <input type="text" id="busca" name="busca" value="{{ $busca }}"
                                   placeholder="Nome, telefone ou e-mail" autofocus>
                            <button type="submit" class="btn-xp">Pesquisar</button>
                            @if ($busca !== '')
                                <a href="{{ url('/clientes') }}" class="btn-xp">Limpar</a>
                            @endif
                        </form>

                        <table>
                            <thead>
                                <tr>
                                    <th>Cliente</th>
                                    <th>Telefone</th>
                                    <th>E-mail</th>
                                    <th class="centro">OS</th>
                                    <th class="direita">Total gasto</th>
                                    <th>Última OS</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($clientes as $cliente)
                                    <tr>
                                        <td><strong>{{ $cliente->cliente_nome }}</strong></td>
                                        <td>{{ $cliente->telefone ?: '—' }}</td>
                                        <td>{{ $cliente->email ?: '—' }}</td>
                                        <td class="centro">{{ $cliente->total_os }}</td>
                                        <td class="direita">R$ {{ number_format($cliente->total_gasto, 2, ',', '.') }}</td>
                                        <td>{{ \Illuminate\Support\Carbon::parse($cliente->ultima_os)->format('d/m/Y') }}</td>
                                        <td>
                                            <a class="link-os" href="{{ route('clientes.ordens', ['nome' => $cliente->cliente_nome]) }}">Ver OS</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="vazio">
                                            @if ($busca !== '')
                                                Nenhum cliente encontrado para "{{ $busca }}".
                                            @else
                                                Nenhum cliente ainda. Os clientes aparecem aqui quando você registra uma Ordem de Serviço.
                                            @endif
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        @if ($clientes->hasPages())
                            <div class="paginacao">
                                @if ($clientes->onFirstPage())
                                    <span class="btn-xp desativado">« Anterior</span>
                                @else
                                    <a class="btn-xp" href="{{ $clientes->previousPageUrl() }}">« Anterior</a>
                                @endif

                                <span class="pagina-atual">Página {{ $clientes->currentPage() }} de {{ $clientes->lastPage() }}</span>

                                @if ($clientes->hasMorePages())
                                    <a class="btn-xp" href="{{ $clientes->nextPageUrl() }}">Próxima »</a>
                                @else
                                    <span class="btn-xp desativado">Próxima »</span>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>

        <div class="status-bar">
            <span>Pronto</span>
            <span class="conectado">🟢 Conectado</span>
        </div>

    </div>

</body>
</html>
