@extends('layouts.app')

@section('title', 'Tentang Kami - TAASHOP')

@section('content')

    <section class="hero-section-small" style="background-image: url('{{ asset('images/bg-hero-about.jpg') }}'); background-size: cover; background-position: center;">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="hero-title-small">Tentang Kami</h1>
                    <p class="hero-subtitle-small">Mengenal lebih dekat TAASHOP, mitra terpercaya Anda untuk produksi pakaian kustom berkualitas tinggi.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6" data-aos="fade-right">
                    <div class="story-image">
                        <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?fit=crop&w=600&h=700" alt="Tim TAASHOP" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="story-content">
                        <span class="section-tag">Cerita Kami</span>
                        <h2>Dedikasi Kami untuk Kualitas dan Inovasi</h2>
                        <p>TAASHOP didirikan dengan visi untuk menjadi penyedia pakaian kustom terkemuka, fokus pada kualitas dan kepuasan pelanggan. Kami berkomitmen untuk menghadirkan produk terbaik yang memenuhi standar industri.</p>
                        <p>Kami mengintegrasikan teknologi produksi terkini dengan tim ahli yang berpengalaman untuk menghasilkan pakaian kustom yang presisi dan tahan lama. Spesialisasi kami meliputi jersey basket, PDL/PDH, jersey futsal & esport, hoodie, serta jaket.</p>
                        <div class="story-stats">
                            <div class="stat-item">
                                <h4>5+</h4>
                                <p>Tahun Pengalaman</p>
                            </div>
                            <div class="stat-item">
                                <h4>100+</h4>
                                <p>Klien Puas</p>
                            </div>
                            <div class="stat-item">
                                <h4>10k+</h4>
                                <p>Produk Dihasilkan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section bg-light">
        <div class="container">
            <div class="section-header text-center" data-aos="fade-up">
                <span class="section-tag">Filosofi Kami</span>
                <h2>Nilai-Nilai yang Mendorong Kami</h2>
                <p class="lead">Kami berpegang teguh pada prinsip-prinsip inti yang membentuk setiap aspek operasional dan interaksi kami dengan pelanggan.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="value-card d-flex flex-column align-items-center">
                        <div class="value-icon d-inline-flex align-items-center justify-content-center"><i class="fas fa-gem"></i></div>
                        <h5>Kualitas Terbaik</h5>
                        <p>Kami tidak pernah berkompromi pada kualitas. Dari pemilihan bahan hingga proses jahitan, semuanya kami perhatikan dengan detail.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="value-card d-flex flex-column align-items-center">
                        <div class="value-icon d-inline-flex align-items-center justify-content-center"><i class="fas fa-users"></i></div>
                        <h5>Kepuasan Pelanggan</h5>
                        <p>Bagi kami, Anda bukan hanya pelanggan, tetapi partner. Kepuasan Anda adalah prioritas utama kami.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="value-card d-flex flex-column align-items-center">
                        <div class="value-icon d-inline-flex align-items-center justify-content-center"><i class="fas fa-handshake"></i></div>
                        <h5>Kejujuran & Amanah</h5>
                        <p>Kami membangun bisnis ini di atas kepercayaan. Kami selalu transparan dalam setiap proses dan menjaga amanah yang Anda berikan.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="cta-section p-5 text-center" data-aos="zoom-in">
                <h2 class="mb-3">Siap Memulai Proyek Pakaian Kustom Anda?</h2>
                <p class="lead mb-4">Hubungi kami sekarang untuk konsultasi gratis dan wujudkan desain impian Anda dengan kualitas terbaik.</p>
                <a href="https://wa.me/62812345678" class="btn btn-light btn-lg">
                    <i class="fab fa-whatsapp me-2"></i> Hubungi Kami Sekarang
                </a>
            </div>
        </div>
    </section>

@endsection