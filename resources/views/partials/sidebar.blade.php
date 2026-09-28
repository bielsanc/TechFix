<aside class="sidebar">
    <div class="logo-area">
        <img src="{{ asset('assets/imagens/logoTech.png') }}" alt="TechFix" class="logo-sidebar">
    </div>

    <nav class="nav-menu" aria-label="Navegação principal">
        <a href="{{ route('dashboard') }}" class="nav-item {{ ($ativo ?? '') === 'dashboard' ? 'active' : '' }}">
            <img src="{{ asset('assets/imagens/casa.png') }}" alt="" class="icon-nav">Dashboard
        </a>
        <a href="{{ url('/ordem') }}" class="nav-item {{ ($ativo ?? '') === 'ordem' ? 'active' : '' }}">
            <img src="{{ asset('assets/imagens/papel.png') }}" alt="" class="icon-nav">Ordens de Serviço
        </a>
        <a href="{{ route('clientes') }}" class="nav-item {{ ($ativo ?? '') === 'clientes' ? 'active' : '' }}">
            <img src="{{ asset('assets/imagens/user.png') }}" alt="" class="icon-nav">Clientes
        </a>
        <a href="#" class="nav-item">
            <img src="{{ asset('assets/imagens/pc.png') }}" alt="" class="icon-nav">Equipamentos
        </a>
        <a href="{{ route('relatorios') }}" class="nav-item {{ ($ativo ?? '') === 'relatorios' ? 'active' : '' }}">
            <img src="{{ asset('assets/imagens/graficos.png') }}" alt="" class="icon-nav">Relatórios
        </a>
        <a href="#" class="nav-item">
            <img src="{{ asset('assets/imagens/dinheiro.png') }}" alt="" class="icon-nav">Financeiro
        </a>
        <a href="#" class="nav-item">
            <img src="{{ asset('assets/imagens/engrenagem.png') }}" alt="" class="icon-nav">Configurações
        </a>
        <a href="#" class="nav-item">
            <img src="{{ asset('assets/imagens/interrogacao.png') }}" alt="" class="icon-nav">Ajuda
        </a>
        <a href="{{ url('/cadastro') }}" class="nav-item {{ ($ativo ?? '') === 'cadastro' ? 'active' : '' }}">
            <img src="{{ asset('assets/imagens/chave.png') }}" alt="" class="icon-nav">Usuários
        </a>
        <form action="{{ route('logout') }}" method="POST" class="nav-item sair">
            @csrf
            <button type="submit" style="all:unset; display:flex; align-items:center; gap:10px; width:100%; cursor:pointer; color:inherit; font:inherit;">
                <img src="{{ asset('assets/imagens/saida.png') }}" alt="" class="icon-nav">Sair
            </button>
        </form>
    </nav>
</aside>
