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

                <!-- CONTAINER DO FORMULÁRIO -->
                <form action="{{ url('/dashboard') }}" method="GET" class="form-container">

                    <!-- DADOS PESSOAIS -->
                    <fieldset class="grupo-campos">
                        <legend>Dados Pessoais</legend>
                        <div class="grid-2col">
                            <div class="coluna">
                                <div class="campo">
                                    <label for="nome">Nome Completo:</label>
                                    <input type="text" id="nome" name="nome" value="Beatriz Florencio">
                                </div>
                                <div class="campo">
                                    <label for="usuario">Usuário:</label>
                                    <input type="text" id="usuario" name="usuario" value="beatrizf">
                                </div>
                                <div class="campo">
                                    <label for="email">E-mail:</label>
                                    <input type="email" id="email" name="email" value="beatriz@email.com">
                                </div>
                            </div>
                            <div class="coluna">
                                <div class="campo">
                                    <label for="senha">Senha:</label>
                                    <input type="password" id="senha" name="senha" value="12345678">
                                </div>
                                <div class="campo">
                                    <label for="confirmar_senha">Confirmar Senha:</label>
                                    <input type="password" id="confirmar_senha" name="confirmar_senha" value="12345678">
                                </div>
                                <div class="campo">
                                    <label for="perfil">Perfil:</label>
                                    <select id="perfil" name="perfil">
                                        <option value="Técnico" selected>Técnico</option>
                                        <option value="Administrador">Administrador</option>
                                        <option value="Atendente">Atendente</option>
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
                                <input type="text" id="telefone" name="telefone" value="(11) 98765-4321">
                            </div>
                            <div class="campo">
                                <label for="celular">Celular:</label>
                                <input type="text" id="celular" name="celular" value="(11) 99876-5432">
                            </div>
                        </div>
                    </fieldset>

                    <!-- ENDEREÇO -->
                    <fieldset class="grupo-campos">
                        <legend>Endereço</legend>
                        <div class="campo em-linha">
                            <label for="endereco">Endereço:</label>
                            <input type="text" id="endereco" name="endereco" value="Rua das Flores, 123">
                        </div>
                        <div class="campo em-linha">
                            <label for="bairro">Bairro:</label>
                            <input type="text" id="bairro" name="bairro" value="Centro">
                        </div>
                        <div class="grid-3col">
                            <div class="campo">
                                <label for="cidade">Cidade:</label>
                                <input type="text" id="cidade" name="cidade" value="São Paulo">
                            </div>
                            <div class="campo curto">
                                <label for="estado">Estado:</label>
                                <select id="estado" name="estado">
                                    <option value="SP" selected>SP</option>
                                    <option value="RJ">RJ</option>
                                    <option value="MG">MG</option>
                                </select>
                            </div>
                            <div class="campo medio">
                                <label for="cep">CEP:</label>
                                <input type="text" id="cep" name="cep" value="01000-000">
                            </div>
                        </div>
                    </fieldset>

                    <!-- AÇÕES DE FORMULÁRIO -->
                    <div class="acoes-container">
                        <button type="submit" class="btn-acao">
                            <img src="{{ asset('assets/imagens/salvar.png') }}" alt="Salvar" class="icon-btn">
                            Salvar
                        </button>
                        <button type="submit" class="btn-acao">
                            <img src="{{ asset('assets/imagens/x.png') }}" alt="Cancelar" class="icon-btn">
                            Cancelar
                        </button>
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