<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/cadastro.css') }}">
    <title>TechFix - Cadastro de Usuário</title>
</head>
<body>

    <div class="janela">

        <!-- BARRA DE TÍTULO -->
        <div class="barra-titulo">
            <div class="titulo">
                <img src="{{ asset('assets/imagens/logoTech.png') }}" alt="TechFix">
                <span>TechFix - Cadastro de Usuário</span>
            </div>
            <div class="botoes-janela">
                <button>−</button>
                <button>□</button>
                <button class="fechar">×</button>
            </div>
        </div>

        <!-- CONTEÚDO PRINCIPAL -->
        <div class="conteudo">

            <div class="cadastro-wrapper">
                
                <!-- BRANDING CENTRALIZADO ACIMA -->
                <div class="branding-topo">
                    <img src="{{ asset('assets/imagens/logoTech.png') }}" alt="TechFix Logo" class="logo-topo">
                </div>

                @if ($errors->any())
                    <div class="erros-form" style="color:#c0392b; margin-bottom:10px;">
                        <ul>
                            @foreach ($errors->all() as $erro)
                                <li>{{ $erro }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- CONTAINER DO FORMULÁRIO -->
                <form action="{{ url('/cadastro') }}" method="POST" class="form-container">
                    @csrf

                    <!-- DADOS PESSOAIS -->
                    <fieldset class="grupo-campos">
                        <legend>Dados Pessoais</legend>
                        <div class="grid-2col">
                            <div class="coluna">
                                <div class="campo">
                                    <label for="nome">Nome Completo:</label>
                                    <input type="text" id="nome" name="nome" value="{{ old('nome') }}" required>
                                </div>
                                <div class="campo">
                                    <label for="usuario">Usuário:</label>
                                    <input type="text" id="usuario" name="usuario" value="{{ old('usuario') }}" required>
                                </div>
                                <div class="campo">
                                    <label for="email">E-mail:</label>
                                    <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                                </div>
                            </div>
                            <div class="coluna">
                                <div class="campo">
                                    <label for="senha">Senha:</label>
                                    <input type="password" id="senha" name="senha" required>
                                </div>
                                <div class="campo">
                                    <label for="confirmar_senha">Confirmar Senha:</label>
                                    <input type="password" id="confirmar_senha" name="confirmar_senha" required>
                                </div>
                                <div class="campo">
                                    <label for="perfil">Perfil:</label>
                                    <select id="perfil" name="perfil">
                                        <option value="Técnico" {{ old('perfil') == 'Técnico' ? 'selected' : '' }}>Técnico</option>
                                        <option value="Administrador" {{ old('perfil') == 'Administrador' ? 'selected' : '' }}>Administrador</option>
                                        <option value="Atendente" {{ old('perfil') == 'Atendente' ? 'selected' : '' }}>Atendente</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <!-- CONTATO -->
                    <fieldset class="grupo-campos">
                        <legend>Contato</legend>
                        <div class="grid-2col">
                            <div class="campo">
                                <label for="telefone">Telefone:</label>
                                <input type="text" id="telefone" name="telefone" value="{{ old('telefone') }}">
                            </div>
                            <div class="campo">
                                <label for="celular">Celular:</label>
                                <input type="text" id="celular" name="celular" value="{{ old('celular') }}">
                            </div>
                        </div>
                    </fieldset>

                    <!-- ENDEREÇO -->
                    <fieldset class="grupo-campos">
                        <legend>Endereço</legend>
                        <div class="campo em-linha">
                            <label for="endereco">Endereço:</label>
                            <input type="text" id="endereco" name="endereco" value="{{ old('endereco') }}">
                        </div>
                        <div class="campo em-linha">
                            <label for="bairro">Bairro:</label>
                            <input type="text" id="bairro" name="bairro" value="{{ old('bairro') }}">
                        </div>
                        <div class="grid-3col">
                            <div class="campo">
                                <label for="cidade">Cidade:</label>
                                <input type="text" id="cidade" name="cidade" value="{{ old('cidade') }}">
                            </div>
                            <div class="campo curto">
                                <label for="estado">Estado:</label>
                                <select id="estado" name="estado">
                                    <option value="SP" {{ old('estado') == 'SP' ? 'selected' : '' }}>SP</option>
                                    <option value="RJ" {{ old('estado') == 'RJ' ? 'selected' : '' }}>RJ</option>
                                    <option value="MG" {{ old('estado') == 'MG' ? 'selected' : '' }}>MG</option>
                                </select>
                            </div>
                            <div class="campo medio">
                                <label for="cep">CEP:</label>
                                <input type="text" id="cep" name="cep" value="{{ old('cep') }}">
                            </div>
                        </div>
                    </fieldset>

                    <!-- AÇÕES DE FORMULÁRIO -->
                    <div class="acoes-container">
                        <button type="submit" class="btn-acao">
                            <img src="{{ asset('assets/imagens/salvar.png') }}" alt="Salvar" class="icon-btn">
                            Salvar
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

</body>
</html>