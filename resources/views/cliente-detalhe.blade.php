<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/clientes.css') }}">
    <title>TechFix - {{ $nome }}</title>
</head>
<body>

    <div class="janela">

        <div class="barra-titulo">
            <div class="titulo">
                <img src="{{ asset('assets/imagens/logoTech.png') }}" alt="TechFix">
                <span>TechFix - Ordens do Cliente</span>
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

                <div class="header-boas-vindas">
                    <div class="info-usuario">
                        <strong>{{ $nome }}</strong>
                        <span>
                            Tel: {{ $telefone ?: '—' }} &nbsp;|&nbsp; E-mail: {{ $email ?: '—' }}
                            &nbsp;|&nbsp; Total: R$ {{ number_format($totalGasto, 2, ',', '.') }}
                        </span>
                    </div>
                    <a href="{{ url('/clientes') }}" class="btn-xp">« Voltar</a>
                </div>

                <div class="caixa-tabela consulta">
                    <div class="caixa-header">
                        <span>Ordens de Serviço ({{ $ordens->count() }})</span>
                    </div>
                    <div class="caixa-body">
                        <table>
                            <thead>
                                <tr>
                                    <th>Nº OS</th>
                                    <th>Equipamento</th>
                                    <th>Problema</th>
                                    <th>Status</th>
                                    <th>Entrada</th>
                                    <th class="direita">Valor</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ordens as $os)
                                    @php
                                        $classe = match($os->status) {
                                            'Em andamento' => 'azul',
                                            'Aguardando Peças' => 'amarelo',
                                            'Concluída' => 'verde',
                                            default => 'cinza',
                                        };
                                    @endphp
                                    <tr>
                                        <td>{{ $os->numero }}</td>
                                        <td>{{ trim($os->tipo_equipamento . ' ' . $os->marca . ' ' . $os->modelo) ?: '—' }}</td>
                                        <td>{{ \Illuminate\Support\Str::limit($os->descricao_problema, 60) ?: '—' }}</td>
                                        <td><span class="badge {{ $classe }}">{{ $os->status }}</span></td>
                                        <td>{{ optional($os->data_entrada)->format('d/m/Y') ?: '—' }}</td>
                                        <td class="direita">R$ {{ number_format($os->valor_total, 2, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
