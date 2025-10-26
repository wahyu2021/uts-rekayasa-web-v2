@extends('layouts.app')

@section('title', 'Produk Kami - TAASHOP')

@section('content')

    <section class="hero-section-small" style="background-image: url('{{ asset('images/bg-hero-product.jpg') }}'); background-size: cover; background-position: center;">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="hero-title-small">Produk Kami</h1>
                    <p class="hero-subtitle-small">Jelajahi berbagai pilihan produk konveksi berkualitas dari TAASHOP.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section section-compact-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="filter-section mb-4">
                        <h3 class="filter-title mb-3">Filter Berdasarkan Kategori</h3>
                        <div class="filter-options">
                            <div class="form-check mb-2">
                                <input class="form-check-input filter-checkbox" type="checkbox" value="all" id="filterAll" checked>
                                <label class="form-check-label" for="filterAll">Semua</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input filter-checkbox" type="checkbox" value="jersey" id="filterJersey">
                                <label class="form-check-label" for="filterJersey">Jersey</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input filter-checkbox" type="checkbox" value="pdlpdh" id="filterPdlPdh">
                                <label class="form-check-label" for="filterPdlPdh">PDL/PDH</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input filter-checkbox" type="checkbox" value="hoodiejaket" id="filterHoodieJaket">
                                <label class="form-check-label" for="filterHoodieJaket">Hoodie & Jaket</label>
                            </div>
                        </div>
                        <button id="applyFilterBtn" class="btn btn-primary mt-3 w-100">Terapkan Filter</button>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="products-grid">
                        <div class="product-card d-flex flex-column" data-aos="fade-up" data-category="jersey">
                            <div class="product-image">
                                <img src="https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=400&h=500&fit=crop" alt="Produk 1">
                                <div class="product-badge">Best Seller</div>
                            </div>
                            <div class="product-info">
                                <h5>Kaos Polos Premium</h5>
                                <p class="product-desc">Kaos polos dengan bahan katun combed 30s yang adem dan nyaman.</p>
                                <div class="product-specs">
                                    <div class="spec-item">Mulai dari Rp 55.000</div>
                                </div>
                            </div>
                        </div>

                        <div class="product-card d-flex flex-column" data-aos="fade-up" data-aos-delay="100" data-category="jersey">
                            <div class="product-image">
                                <img src="https://images.unsplash.com/photo-1591195853828-11db59a44f6b?w=400&h=500&fit=crop" alt="Produk 2">
                            </div>
                            <div class="product-info">
                                <h5>Polo Shirt Bordir</h5>
                                <p class="product-desc">Polo shirt dengan bahan lacoste dan bordir logo kustom.</p>
                                <div class="product-specs">
                                    <div class="spec-item">Mulai dari Rp 85.000</div>
                                </div>
                            </div>
                        </div>

                        <div class="product-card" data-aos="fade-up" data-aos-delay="200" data-category="hoodiejaket">
                            <div class="product-image">
                                <img src="https://images.unsplash.com/photo-1578932750294-708c28814355?w=400&h=500&fit=crop" alt="Produk 3">
                                <div class="product-badge">New!</div>
                            </div>
                            <div class="product-info">
                                <h5>Jaket Bomber Keren</h5>
                                <p class="product-desc">Jaket bomber dengan bahan taslan dan furing yang nyaman.</p>
                                <div class="product-specs">
                                    <div class="spec-item">Mulai dari Rp 150.000</div>
                                </div>
                            </div>
                        </div>

                        <div class="product-card" data-aos="fade-up" data-aos-delay="300" data-category="pdlpdh">
                            <div class="product-image">
                                <img src="https://images.unsplash.com/photo-1603252109360-778baaf41393?w=400&h=500&fit=crop" alt="Produk 4">
                            </div>
                            <div class="product-info">
                                <h5>Kemeja PDL Lapangan</h5>
                                <p class="product-desc">Kemeja PDL dengan bahan ripstop yang kuat dan tahan lama.</p>
                                <div class="product-specs">
                                    <div class="spec-item">Mulai dari Rp 120.000</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection