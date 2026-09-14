<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <title>TechFix - Login</title>
</head>
<body>

    <div class="janela">

        <!-- BARRA SUPERIOR -->
        <div class="barra-titulo">
            <div class="titulo">
                <img src="{{ asset('assets/imagens/logoTech.png') }}" alt="TechFix">
                <span>TechFix - Login</span>
            </div>
            <div class="botoes-janela">
                <button>−</button>
                <button>□</button>
                <button class="fechar">×</button>
            </div>
        </div>

        <!-- CONTEÚDO -->
        <div class="conteudo">

            <!-- LADO ESQUERDO -->
            <div class="lado-esquerdo">
                <img src="{{ asset('assets/imagens/logoTech.png') }}" alt="TechFix Logo" class="logo-principal">
            </div>

            <!-- LADO DIREITO -->
            <div class="login-container">
                <div class="login-box">

                    <div class="login-titulo">
                        Acesse sua conta
                    </div>

                    <div class="login-conteudo">

                        <div class="mensagem">
                            <img src="{{ asset('assets/imagens/chave.png') }}" alt="Chave">
                            <span>Informe seu usuário e senha para entrar.</span>
                        </div>

                        <!-- FORMULÁRIO DIRECIONANDO PARA O DASHBOARD -->
                        <form action="{{ url('/dashboard') }}" method="GET">
                            
                            <!-- USUÁRIO -->
                            <div class="campo">
                                <label for="usuario">Usuário:</label>
                                <input type="text" id="usuario" name="usuario" value="usuario" required>
                            </div>

                            <!-- SENHA -->
                            <div class="campo">
                                <label for="senha">Senha:</label>
                                <input type="password" id="senha" name="senha" value="12345678" required>
                            </div>

                            <!-- LEMBRAR -->
                            <div class="lembrar">
                                <input type="checkbox" id="lembrar" name="lembrar">
                                <label for="lembrar">Lembrar meu usuário</label>
                            </div>

                            <!-- BOTÃO DE SUBMIT -->
                            <div class="entrar-container">
                                <button type="submit" class="btn-entrar">
                                    Entrar <span>➔</span>
                                </button>
                            </div>
                        </form>

                        <hr>

                        <!-- LINKS -->
                        <div class="links">
                            <a href="#">Esqueci minha senha</a>
                            <a href="#">Criar uma conta</a>
                        </div>

                    </div>
                </div>
            </div>

        </div>

        <!-- RODAPÉ -->
        <div class="status-bar">
            <span>TechFix Manutenção Informática - Soluções completas para você e seus equipamentos!</span>
            <span class="conectado">🟢 Conectado</span>
        </div>

    </div>

</body>
</html>