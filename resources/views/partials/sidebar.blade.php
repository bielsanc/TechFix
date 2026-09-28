<div class="sidebar">
    <div class="logo-area">
        <img src="{{ asset('assets/imagens/logoTech.png') }}" alt="TechFix Logo" class="logo-sidebar">
    </div>

    <nav class="nav-menu">
        <a href="{{ url('/dashboard') }}" class="nav-item {{ ($ativo ?? '') === 'dashboard' ? 'active' : '' }}">
            <img src="{{ asset('assets/imagens/casa.png') }}" alt="Dashboard" class="icon-nav">
            Dashboard
        </a>
        <a href="{{ url('/ordem') }}" class="nav-item {{ ($ativo ?? '') === 'ordem' ? 'active' : '' }}">
            <img src="{{ asset('assets/imagens/papel.png') }}" alt="Ordem de Serviços" class="icon-nav">
            Ordem de Serviços
        </a>
        <a href="{{ url('/clientes') }}" class="nav-item {{ ($ativo ?? '') === 'clientes' ? 'active' : '' }}">
            <img src="{{ asset('assets/imagens/user.png') }}" alt="Clientes" class="icon-nav">
            Clientes
        </a>
        <a href="{{ route('relatorios') }}" class="nav-item {{ ($ativo ?? '') === 'relatorios' ? 'active' : '' }}">
            <img src="{{ asset('assets/imagens/graficos.png') }}" alt="Relatórios" class="icon-nav">
            Relatórios
        </a>
        <a href="{{ url('/cadastro') }}" class="nav-item {{ ($ativo ?? '') === 'cadastro' ? 'active' : '' }}">
            <img src="{{ asset('assets/imagens/chave.png') }}" alt="Usuários" class="icon-nav">
            Usuários
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

