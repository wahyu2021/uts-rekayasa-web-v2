<nav class="navbar navbar-expand-lg navbar-custom sticky-top">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="{{ asset('images/logo-taashop.png') }}" alt="TAASHOP Logo">
            <span class="navbar-brand-text">TAASHOP</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto gap-3">
                <li class="nav-item"><a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="/">Beranda</a></li>
                <li class="nav-item"><a class="nav-link {{ Request::is('products') ? 'active' : '' }}" href="/products">Produk</a></li>
                <li class="nav-item"><a class="nav-link {{ Request::is('about') ? 'active' : '' }}" href="/about">Tentang Kami</a></li>
            </ul>
        </div>
    </div>
</nav>
