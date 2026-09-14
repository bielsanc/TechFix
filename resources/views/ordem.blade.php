<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/ordem.css') }}">
    <title>TechFix - Ordem de Serviço Nº {{ $numero }}</title>
</head>
<body>

    <div class="janela">

        <!-- BARRA DE TÍTULO -->
        <div class="barra-titulo">
            <div class="titulo">
                <img src="{{ asset('assets/imagens/logoTech.png') }}" alt="TechFix">
                <span>TechFix - Ordem de Serviço Nº {{ $numero }}</span>
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
            <span>Editar</span>
            <span>Ferramentas</span>
            <span>Ajuda</span>
        </div>

        <!-- CONTEÚDO PRINCIPAL (SIDEBAR + PAINEL DA OS) -->
        <div class="conteudo">

            <!-- SIDEBAR ESQUERDA -->
            <aside class="sidebar">
                <div class="logo-area">
                    <img src="{{ asset('assets/imagens/logoTech.png') }}" alt="TechFix Logo" class="logo-sidebar">
                </div>

                <nav class="nav-menu">
                    <a href="{{ url('/dashboard') }}" class="nav-item">
                        <img src="{{ asset('assets/imagens/casa.png') }}" alt="Dashboard" class="icon-nav">
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ url('/ordem') }}" class="nav-item active">
                        <img src="{{ asset('assets/imagens/papel.png') }}" alt="Ordens de Serviço" class="icon-nav">
                        <span>Ordens de Serviço</span>
                    </a>
                    <a href="{{ url('/cadastro') }}" class="nav-item">
                        <img src="{{ asset('assets/imagens/user.png') }}" alt="Clientes" class="icon-nav">
                        <span>Clientes</span>
                    </a>
                    <a href="#" class="nav-item">
                        <img src="{{ asset('assets/imagens/pc.png') }}" alt="Equipamentos" class="icon-nav">
                        <span>Equipamentos</span>
                    </a>
                    <a href="#" class="nav-item">
                        <img src="{{ asset('assets/imagens/graficos.png') }}" alt="Relatórios" class="icon-nav">
                        <span>Relatórios</span>
                    </a>
                    <a href="#" class="nav-item">
                        <img src="{{ asset('assets/imagens/dinheiro.png') }}" alt="Financeiro" class="icon-nav">
                        <span>Financeiro</span>
                    </a>
                    <a href="#" class="nav-item">
                        <img src="{{ asset('assets/imagens/engrenagem.png') }}" alt="Configurações" class="icon-nav">
                        <span>Configurações</span>
                    </a>
                    <a href="#" class="nav-item">
                        <img src="{{ asset('assets/imagens/interrogacao.png') }}" alt="Ajuda" class="icon-nav">
                        <span>Ajuda</span>
                    </a>
                    <a href="{{ url('/login') }}" class="nav-item sair">
                        <img src="{{ asset('assets/imagens/sair.png') }}" alt="Sair" class="icon-nav">
                        <span>Sair</span>
                    </a>
                </nav>
            </aside>

            <!-- PAINEL CENTRAL DA ORDEM DE SERVIÇO -->
            <div class="painel-principal">

                @if ($errors->any())
                    <div class="erros-form" style="color:#c0392b; margin-bottom:10px;">
                        <ul>
                            @foreach ($errors->all() as $erro)
                                <li>{{ $erro }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="os-container" action="{{ url('/ordem') }}" method="POST" id="form-ordem">
                    @csrf

                    <!-- LINHA 1: DADOS DO CLIENTE E DADOS DO EQUIPAMENTO -->
                    <div class="grid-2col">
                        
                        <!-- DADOS DO CLIENTE -->
                        <fieldset class="grupo-campos">
                            <legend>Dados do Cliente</legend>
                            <div class="campo campo-busca">
                                <label for="cliente">Cliente:</label>
                                <input type="text" id="cliente" name="cliente" value="{{ old('cliente') }}" required>
                            </div>
                            <div class="campo">
                                <label for="telefone">Telefone:</label>
                                <input type="text" id="telefone" name="telefone" value="{{ old('telefone') }}">
                            </div>
                            <div class="campo">
                                <label for="email">E-mail:</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}">
                            </div>
                        </fieldset>

                        <!-- DADOS DO EQUIPAMENTO -->
                        <fieldset class="grupo-campos">
                            <legend>Dados do Equipamento</legend>
                            <div class="linha-dupla">
                                <div class="campo">
                                    <label for="tipo">Tipo:</label>
                                    <select id="tipo" name="tipo">
                                        <option value="Notebook" {{ old('tipo') == 'Notebook' ? 'selected' : '' }}>Notebook</option>
                                        <option value="Desktop" {{ old('tipo') == 'Desktop' ? 'selected' : '' }}>Desktop</option>
                                        <option value="Impressora" {{ old('tipo') == 'Impressora' ? 'selected' : '' }}>Impressora</option>
                                    </select>
                                </div>
                                <div class="campo">
                                    <label for="marca">Marca:</label>
                                    <input type="text" id="marca" name="marca" value="{{ old('marca') }}">
                                </div>
                            </div>

                            <div class="linha-dupla">
                                <div class="campo">
                                    <label for="modelo">Modelo:</label>
                                    <input type="text" id="modelo" name="modelo" value="{{ old('modelo') }}">
                                </div>
                                <div class="campo">
                                    <label for="serie">Nº de Série:</label>
                                    <input type="text" id="serie" name="serie" value="{{ old('serie') }}">
                                </div>
                            </div>

                            <div class="campo">
                                <label for="acessorios">Acessórios:</label>
                                <input type="text" id="acessorios" name="acessorios" value="{{ old('acessorios') }}">
                            </div>
                        </fieldset>

                    </div>

                    <!-- LINHA 2: DESCRIÇÃO DO PROBLEMA E SERVIÇOS EXECUTADOS -->
                    <div class="grid-2col grid-alinhado">
                        
                        <!-- DESCRIÇÃO DO PROBLEMA -->
                        <fieldset class="grupo-campos flex-col">
                            <legend>Descrição do Problema</legend>
                            <textarea name="descricao_problema" class="textarea-problema">{{ old('descricao_problema') }}</textarea>
                        </fieldset>

                        <!-- SERVIÇOS EXECUTADOS / PEÇAS -->
                        <fieldset class="grupo-campos flex-col">
                            <legend>Serviços Executados / Peças</legend>
                            <div class="tabela-acoes-wrapper">
                                <table class="tabela-servicos">
                                    <thead>
                                        <tr>
                                            <th>Descrição</th>
                                            <th class="col-valor">Valor (R$)</th>
                                        </tr>
                                    </thead>
                                    <tbody id="corpo-itens">
                                        <tr>
                                            <td><input type="text" name="itens_descricao[]" placeholder="Ex: Diagnóstico"></td>
                                            <td class="col-valor"><input type="number" step="0.01" min="0" name="itens_valor[]" class="input-valor-item" value="0"></td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="botoes-tabela">
                                    <button type="button" id="btn-add-item" class="btn-tb verde" title="Adicionar">+</button>
                                    <button type="button" id="btn-remove-item" class="btn-tb vermelho" title="Remover última linha">−</button>
                                </div>
                            </div>
                        </fieldset>

                    </div>

                    <!-- LINHA 3: RODAPÉ DO FORMULÁRIO (STATUS, DATAS E TOTAL) -->
                    <div class="painel-rodape-os">
                        <div class="controles-esquerda">
                            <div class="linha-controles">
                                <div class="campo">
                                    <label for="status">Status:</label>
                                    <select id="status" name="status">
                                        <option value="Aberta" {{ old('status', 'Aberta') == 'Aberta' ? 'selected' : '' }}>Aberta</option>
                                        <option value="Em andamento" {{ old('status') == 'Em andamento' ? 'selected' : '' }}>Em andamento</option>
                                        <option value="Concluída" {{ old('status') == 'Concluída' ? 'selected' : '' }}>Concluída</option>
                                        <option value="Aguardando Peças" {{ old('status') == 'Aguardando Peças' ? 'selected' : '' }}>Aguardando Peças</option>
                                    </select>
                                </div>
                                <div class="campo">
                                    <label for="data_entrada">Data de Entrada:</label>
                                    <input type="text" id="data_entrada" name="data_entrada" value="{{ old('data_entrada', now()->format('d/m/Y')) }}" class="input-data" placeholder="dd/mm/aaaa">
                                </div>
                            </div>

                            <div class="linha-controles">
                                <div class="campo">
                                    <label for="tecnico">Técnico Responsável:</label>
                                    <input type="text" id="tecnico" name="tecnico" value="{{ old('tecnico', auth()->user()->name) }}">
                                </div>
                                <div class="campo">
                                    <label for="previsao_entrega">Previsão de Entrega:</label>
                                    <input type="text" id="previsao_entrega" name="previsao_entrega" value="{{ old('previsao_entrega') }}" class="input-data" placeholder="dd/mm/aaaa">
                                </div>
                            </div>
                        </div>

                        <div class="bloco-total">
                            <span class="label-total">Total:</span>
                            <span class="valor-total" id="valor-total-display">R$ 0,00</span>
                        </div>
                    </div>

                    <!-- LINHA 4: BOTÕES DE AÇÃO -->
                    <div class="acoes-container">
                        <button type="submit" class="btn-acao">
                            <img src="{{ asset('assets/imagens/salvar.png') }}" alt="Salvar" class="icon-btn">
                            Salvar
                        </button>
                        <button type="button" class="btn-acao">
                            <img src="{{ asset('assets/imagens/papel.png') }}" alt="Imprimir" class="icon-btn">
                            Imprimir
                        </button>
                        <a href="{{ url('/dashboard') }}" class="btn-acao link-btn">
                            <img src="{{ asset('assets/imagens/x.png') }}" alt="Cancelar" class="icon-btn">
                            Cancelar
                        </a>
                    </div>

                </form>

            </div>

        </div>

        <!-- RODAPÉ DE STATUS -->
        <div class="status-bar">
            <span>Pronto</span>
            <span class="conectado">🟢 Conectado</span>
        </div>

    </div>

    <script>
        const corpoItens = document.getElementById('corpo-itens');
        const totalDisplay = document.getElementById('valor-total-display');

        function linhaItem() {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td><input type="text" name="itens_descricao[]" placeholder="Ex: Diagnóstico"></td>
                <td class="col-valor"><input type="number" step="0.01" min="0" name="itens_valor[]" class="input-valor-item" value="0"></td>
            `;
            return tr;
        }

        function recalcularTotal() {
            const valores = document.querySelectorAll('.input-valor-item');
            let total = 0;
            valores.forEach(input => {
                total += parseFloat(input.value || 0);
            });
            totalDisplay.textContent = 'R$ ' + total.toFixed(2).replace('.', ',');
        }

        document.getElementById('btn-add-item').addEventListener('click', function () {
            corpoItens.appendChild(linhaItem());
        });

        document.getElementById('btn-remove-item').addEventListener('click', function () {
            if (corpoItens.rows.length > 1) {
                corpoItens.deleteRow(-1);
                recalcularTotal();
            }
        });

        corpoItens.addEventListener('input', function (e) {
            if (e.target.classList.contains('input-valor-item')) {
                recalcularTotal();
            }
        });

        recalcularTotal();
    </script>

</body>
</html>