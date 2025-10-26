@extends('layouts.app')

@section('title', 'TAASHOP - Jasa Konveksi Profesional dan Terpercaya')

@section('content')

    <section class="hero-section">
        <div class="hero-shape hero-shape-1"></div>
        <div class="hero-shape hero-shape-2"></div>
        <div class="hero-shape hero-shape-3"></div>
        <div class="container pb-lg-4">
            <div class="row align-items-center g-5 mb-lg-5">
                <div class="col-lg-6 hero-content" data-aos="fade-right">
                    <h1 class="hero-title">
                        <span id="typed-text"></span>
                    </h1>
                    <p class="hero-subtitle mb-4">Spesialisasi kami dalam jersey basket, PDL/PDH, jersey futsal & esport, hoodie, serta jaket. Dapatkan kualitas premium dengan desain sesuai keinginan Anda.</p>
                    <div class="d-flex gap-3">
                        <a href="https://wa.me/62812345678" class="btn btn-primary btn-lg">
                            <i class="fab fa-whatsapp me-2"></i> Konsultasi Gratis
                        </a>
                        <a href="#portofolio" class="btn btn-secondary btn-lg">Lihat Portofolio</a>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="hero-image hero-image-animation">
                        <img src="{{ asset('images/hero-section.png') }}" alt="Produk Konveksi TAASHOP" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="keunggulan" class="section">
        <div class="container">
            <div class="section-header text-center" data-aos="fade-up">
                <span class="section-tag">Keunggulan Kami</span>
                <h2>Kenapa Memilih Konveksi Kami?</h2>
                <p class="lead">Kami adalah mitra terpercaya Anda untuk produksi pakaian kustom. Dengan dedikasi tinggi, kami hadirkan kualitas terbaik untuk setiap pesanan.</p>
            </div>
            <div class="row g-5">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-card d-flex flex-column align-items-center h-100">
                        <div class="feature-icon d-inline-flex align-items-center justify-content-center"><i class="fas fa-gem"></i></div>
                        <h5>Kualitas Jahitan Halus</h5>
                        <p>Setiap jahitan dikerjakan dengan teliti oleh tim kami, memastikan hasil yang rapi dan tahan lama.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-card d-flex flex-column align-items-center h-100">
                        <div class="feature-icon d-inline-flex align-items-center justify-content-center"><i class="fas fa-tag"></i></div>
                        <h5>Harga Jujur & Transparan</h5>
                        <p>Dapatkan penawaran harga yang kompetitif dan transparan, tanpa mengorbankan kualitas material maupun hasil produksi.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-card d-flex flex-column align-items-center h-100">
                        <div class="feature-icon d-inline-flex align-items-center justify-content-center"><i class="fas fa-clock"></i></div>
                        <h5>Fleksibel & Tepat Waktu</h5>
                        <p>Kami mengerti kebutuhan Anda. Proses produksi kami fleksibel dan selalu berusaha menyelesaikan pesanan sesuai jadwal.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="portofolio" class="section bg-light">
        <div class="container">
            <div class="section-header text-center" data-aos="fade-up">
                <span class="section-tag">Produk Unggulan</span>
                <h2>Koleksi Terbaik dari Kami</h2>
                <p class="lead">Jelajahi beberapa produk terbaik kami yang menjadi favorit para pelanggan. Kualitas dan gaya dalam satu paket.</p>
            </div>
            <div class="row g-4">
                @if($featuredProducts->isNotEmpty())
                    @foreach($featuredProducts as $product)
                        <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                            <div class="portfolio-card">
                                <img src="{{ $product->image_path ? asset('storage/' . $product->image_path) : 'https://via.placeholder.com/400x500.png/f97316/ffffff?text=TAASHOP' }}" alt="{{ $product->name }}">
                                <div class="portfolio-overlay">
                                    <h6>{{ $product->name }}</h6>
                                    <p>{{ $product->category->name ?? '' }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12">
                        <p class="text-center">Belum ada produk unggulan.</p>
                    </div>
                @endif
            </div>
            <div class="text-center mt-5">
                <a href="{{ route('products.index') }}" class="btn btn-primary">Lihat Semua Produk</a>
            </div>
        </div>
    </section>

    <section id="alur" class="section">
        <div class="container">
            <div class="section-header text-center" data-aos="fade-up">
                <span class="section-tag">Proses Kami</span>
                <h2>Pesan Kustom Semudah Ini</h2>
                <p class="lead">Kami telah menyederhanakan proses pemesanan kustom Anda menjadi beberapa langkah mudah. Dari ide hingga produk jadi, kami pandu Anda setiap saat.</p>
            </div>
            <div class="process-wrapper">
                <div class="process-line"></div>
                <div class="row g-5">
                    <div class="col-md-3" data-aos="zoom-in" data-aos-delay="100">
                        <div class="process-item text-center">
                            <div class="process-icon-wrapper d-inline-flex align-items-center justify-content-center">
                                <div class="process-icon"><i class="fas fa-comments"></i></div>
                                <span class="process-number d-flex align-items-center justify-content-center">1</span>
                            </div>
                            <h5 class="mt-4">Ngobrol & Konsultasi</h5>
                            <p>Ceritakan ide desain Anda, kami siap mendengarkan dan memberikan masukan terbaik.</p>
                        </div>
                    </div>
                    <div class="col-md-3" data-aos="zoom-in" data-aos-delay="200">
                        <div class="process-item text-center">
                            <div class="process-icon-wrapper d-inline-flex align-items-center justify-content-center">
                                <div class="process-icon"><i class="fas fa-file-alt"></i></div>
                                <span class="process-number d-flex align-items-center justify-content-center">2</span>
                            </div>
                            <h5 class="mt-4">Penawaran & Sampel</h5>
                            <p>Kami akan siapkan penawaran harga dan sampel jika diperlukan, agar sesuai dengan ekspektasi Anda.</p>
                        </div>
                    </div>
                    <div class="col-md-3" data-aos="zoom-in" data-aos-delay="300">
                        <div class="process-item text-center">
                            <div class="process-icon-wrapper d-inline-flex align-items-center justify-content-center">
                                <div class="process-icon"><i class="fas fa-cogs"></i></div>
                                <span class="process-number d-flex align-items-center justify-content-center">3</span>
                            </div>
                            <h5 class="mt-4">Proses Produksi</h5>
                            <p>Setiap pesanan diproses dengan mesin modern dan tenaga ahli, menjamin hasil produksi yang presisi dan berkualitas tinggi.</p>
                        </div>
                    </div>
                    <div class="col-md-3" data-aos="zoom-in" data-aos-delay="400">
                        <div class="process-item text-center">
                            <div class="process-icon-wrapper d-inline-flex align-items-center justify-content-center">
                                <div class="process-icon"><i class="fas fa-shipping-fast"></i></div>
                                <span class="process-number d-flex align-items-center justify-content-center">4</span>
                            </div>
                            <h5 class="mt-4">Kirim & Terima</h5>
                            <p>Produk jadi kami kemas rapi dan kirimkan langsung ke alamat Anda dengan aman.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="cta-section p-5 text-center" data-aos="zoom-in">
                <h2 class="mb-3">Wujudkan Pakaian Kustom Impian Anda Sekarang!</h2>
                <p class="lead mb-4">Tim kami siap membantu Anda menciptakan jersey basket, PDL/PDH, jersey futsal & esport, hoodie, atau jaket dengan kualitas terbaik. Hubungi kami untuk konsultasi gratis!</p>
                <a href="https://wa.me/62812345678" class="btn btn-light btn-lg">
                    <i class="fab fa-whatsapp me-2"></i> Hubungi Kami Sekarang
                </a>
            </div>
        </div>
    </section>

@endsection