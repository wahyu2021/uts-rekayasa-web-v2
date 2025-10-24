@extends('layouts.app')

@section('title', 'TAASHOP - Jasa Konveksi Profesional dan Terpercaya')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-lg-6 d-flex flex-column justify-content-center">
                    <h1 class="hero-title mb-3">
                        Wujudkan Seragam Impian Anda Bersama TAASHOP
                    </h1>
                    <p class="hero-subtitle mb-4">
                        Menerima pembuatan kaos, polo shirt, kemeja, jaket, dan merchandise untuk komunitas, perusahaan, atau acara Anda dengan kualitas terbaik dan harga kompetitif.
                    </p>
                    <div class="d-flex gap-3">
                        <a href="https://wa.me/62812345678" class="btn btn-primary btn-lg">
                            <i class="fab fa-whatsapp"></i> Hubungi via WhatsApp
                        </a>
                        <a href="#alur" class="btn btn-outline-primary btn-lg">
                            Pelajari Lebih Lanjut
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=500&h=500&fit=crop" alt="Produk TAASHOP" class="img-fluid rounded-lg shadow-lg">
                </div>
            </div>
        </div>
    </section>

    <!-- Layanan Kami Section -->
    <section id="layanan" class="layanan-section py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Layanan Kami</h2>
                <p class="section-subtitle">Berbagai produk dan jenis pengerjaan untuk memenuhi kebutuhan Anda</p>
            </div>

            <div class="row g-4 mb-5">
                <!-- Produk -->
                <div class="col-md-6">
                    <h4 class="mb-4"><i class="fas fa-box text-primary"></i> Jenis Produk</h4>
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="service-card">
                                <i class="fas fa-tshirt"></i>
                                <h6>Kaos (T-Shirt)</h6>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="service-card">
                                <i class="fas fa-tshirt"></i>
                                <h6>Polo Shirt</h6>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="service-card">
                                <i class="fas fa-tshirt"></i>
                                <h6>Kemeja PDH/PDL</h6>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="service-card">
                                <i class="fas fa-user-tie"></i>
                                <h6>Jaket & Hoodie</h6>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="service-card">
                                <i class="fas fa-hat-cowboy"></i>
                                <h6>Topi</h6>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="service-card">
                                <i class="fas fa-shopping-bag"></i>
                                <h6>Tote Bag</h6>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Jenis Pengerjaan -->
                <div class="col-md-6">
                    <h4 class="mb-4"><i class="fas fa-tools text-primary"></i> Jenis Pengerjaan</h4>
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="service-card-large">
                                <i class="fas fa-palette"></i>
                                <div>
                                    <h6>Sablon Plastisol</h6>
                                    <p class="text-muted small mb-0">Hasil cetak yang tahan lama dan berkualitas tinggi</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="service-card-large">
                                <i class="fas fa-palette"></i>
                                <div>
                                    <h6>Sablon Rubber</h6>
                                    <p class="text-muted small mb-0">Tekstur lembut dengan hasil yang presisi</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="service-card-large">
                                <i class="fas fa-cut"></i>
                                <div>
                                    <h6>Bordir Komputer</h6>
                                    <p class="text-muted small mb-0">Desain detail dengan teknologi bordir terkini</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mengapa Memilih Kami Section -->
    <section id="keunggulan" class="keunggulan-section py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Mengapa Memilih Kami?</h2>
                <p class="section-subtitle">Keunggulan yang membedakan TAASHOP dari kompetitor</p>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="keunggulan-card">
                        <div class="keunggulan-icon">
                            <i class="fas fa-gem"></i>
                        </div>
                        <h5>Bahan Berkualitas</h5>
                        <p class="text-muted">Kami hanya menggunakan bahan kain premium terbaik untuk hasil yang maksimal.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="keunggulan-card">
                        <div class="keunggulan-icon">
                            <i class="fas fa-tag"></i>
                        </div>
                        <h5>Harga Kompetitif</h5>
                        <p class="text-muted">Dapatkan harga terbaik langsung dari produsen tanpa perantara.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="keunggulan-card">
                        <div class="keunggulan-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h5>Tepat Waktu</h5>
                        <p class="text-muted">Proses produksi cepat dan sesuai jadwal yang telah disepakati.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="keunggulan-card">
                        <div class="keunggulan-icon">
                            <i class="fas fa-pencil-alt"></i>
                        </div>
                        <h5>Gratis Konsultasi Desain</h5>
                        <p class="text-muted">Tim kami siap membantu mewujudkan desain impian Anda tanpa biaya tambahan.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="keunggulan-card">
                        <div class="keunggulan-icon">
                            <i class="fas fa-award"></i>
                        </div>
                        <h5>Berpengalaman</h5>
                        <p class="text-muted">Telah dipercaya oleh ratusan pelanggan dari berbagai industri.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="keunggulan-card">
                        <div class="keunggulan-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h5>Quality Control</h5>
                        <p class="text-muted">Setiap produk melalui quality control ketat sebelum pengiriman.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Portofolio Section -->
    <section id="portofolio" class="portofolio-section py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Portofolio Kami</h2>
                <p class="section-subtitle">Hasil karya terbaik dari proyek-proyek yang telah kami kerjakan</p>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="portfolio-card">
                        <img src="https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=400&h=300&fit=crop" alt="Seragam Perusahaan" class="img-fluid">
                        <div class="portfolio-overlay">
                            <h6>Seragam Perusahaan</h6>
                            <p class="small">PT. Maju Jaya Indonesia</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="portfolio-card">
                        <img src="https://images.unsplash.com/photo-1556821552-5f63b1c2c723?w=400&h=300&fit=crop" alt="Kaos Event" class="img-fluid">
                        <div class="portfolio-overlay">
                            <h6>Kaos Event</h6>
                            <p class="small">Festival Musik 2024</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="portfolio-card">
                        <img src="https://images.unsplash.com/photo-1578932750294-708c28814355?w=400&h=300&fit=crop" alt="Jaket Komunitas" class="img-fluid">
                        <div class="portfolio-overlay">
                            <h6>Jaket Komunitas</h6>
                            <p class="small">Komunitas Olahraga XYZ</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="portfolio-card">
                        <img src="https://images.unsplash.com/photo-1594938298603-c8148c4dae35?w=400&h=300&fit=crop" alt="Merchandise Branding" class="img-fluid">
                        <div class="portfolio-overlay">
                            <h6>Merchandise Branding</h6>
                            <p class="small">Startup Tech Indonesia</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="portfolio-card">
                        <img src="https://images.unsplash.com/photo-1591195853828-11db59a44f6b?w=400&h=300&fit=crop" alt="Polo Shirt Custom" class="img-fluid">
                        <div class="portfolio-overlay">
                            <h6>Polo Shirt Custom</h6>
                            <p class="small">Sekolah Internasional ABC</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="portfolio-card">
                        <img src="https://images.unsplash.com/photo-1572635196237-14b3f281503f?w=400&h=300&fit=crop" alt="Tote Bag Eco" class="img-fluid">
                        <div class="portfolio-overlay">
                            <h6>Tote Bag Eco</h6>
                            <p class="small">Organisasi Lingkungan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Alur Pemesanan Section -->
    <section id="alur" class="alur-section py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Alur Pemesanan</h2>
                <p class="section-subtitle">Proses pemesanan yang mudah dan transparan</p>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="alur-card">
                        <div class="alur-number">1</div>
                        <h5>Konsultasi & Desain</h5>
                        <p class="text-muted">Hubungi kami via WhatsApp untuk membahas kebutuhan dan desain Anda.</p>
                        <i class="fas fa-comments"></i>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="alur-card">
                        <div class="alur-number">2</div>
                        <h5>Penawaran & DP</h5>
                        <p class="text-muted">Kami memberikan penawaran harga, lalu Anda melakukan pembayaran DP.</p>
                        <i class="fas fa-receipt"></i>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="alur-card">
                        <div class="alur-number">3</div>
                        <h5>Proses Produksi</h5>
                        <p class="text-muted">Pesanan masuk ke tahap produksi dan quality control yang ketat.</p>
                        <i class="fas fa-hammer"></i>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="alur-card">
                        <div class="alur-number">4</div>
                        <h5>Pelunasan & Pengiriman</h5>
                        <p class="text-muted">Setelah selesai, lakukan pelunasan dan barang siap dikirim.</p>
                        <i class="fas fa-box"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimoni Section -->
    <section id="testimoni" class="testimoni-section py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Testimoni Pelanggan</h2>
                <p class="section-subtitle">Kepuasan pelanggan adalah prioritas utama kami</p>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="testimoni-card">
                        <div class="rating mb-3">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="testimoni-text">"Hasil produksi sangat memuaskan! Kualitas bahan bagus dan pengerjaan rapi. Tepat waktu dan harga sangat kompetitif. Saya akan merekomendasikan TAASHOP ke teman-teman."</p>
                        <div class="testimoni-author">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=50&h=50&fit=crop" alt="Budi Santoso" class="rounded-circle">
                            <div>
                                <h6 class="mb-0">Budi Santoso</h6>
                                <small class="text-muted">Ketua Panitia Event XYZ</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="testimoni-card">
                        <div class="rating mb-3">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="testimoni-text">"Pelayanan customer service yang responsif dan helpful. Desain yang kami inginkan bisa direalisasikan dengan sempurna. Pasti akan order lagi untuk kebutuhan berikutnya!"</p>
                        <div class="testimoni-author">
                            <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=50&h=50&fit=crop" alt="Siti Nurhaliza" class="rounded-circle">
                            <div>
                                <h6 class="mb-0">Siti Nurhaliza</h6>
                                <small class="text-muted">Manager HR PT. Maju Jaya</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="testimoni-card">
                        <div class="rating mb-3">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="testimoni-text">"Kualitas bordir yang luar biasa detail dan rapi. Harga jauh lebih murah dibanding kompetitor lain. Konsultasi desain gratis sangat membantu kami. Terima kasih TAASHOP!"</p>
                        <div class="testimoni-author">
                            <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=50&h=50&fit=crop" alt="Ahmad Wijaya" class="rounded-circle">
                            <div>
                                <h6 class="mb-0">Ahmad Wijaya</h6>
                                <small class="text-muted">Founder Komunitas Olahraga</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Final Section -->
    <section class="cta-final-section py-5 bg-primary text-white">
        <div class="container text-center">
            <h2 class="mb-3">Siap Membuat Seragam Impian Anda?</h2>
            <p class="lead mb-4">Jangan ragu untuk menghubungi kami dan dapatkan konsultasi gratis!</p>
            <a href="https://wa.me/62812345678" class="btn btn-light btn-lg">
                <i class="fab fa-whatsapp"></i> Konsultasi Gratis via WhatsApp
            </a>
        </div>
    </section>
@endsection
