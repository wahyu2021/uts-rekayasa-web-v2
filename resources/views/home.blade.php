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
                        <a href="https://wa.me/6282281954629" class="btn btn-primary btn-lg">
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
                    @include('components.info-card', [
                        'icon' => 'fas fa-gem',
                        'title' => 'Kualitas Jahitan Halus',
                        'description' => 'Setiap jahitan dikerjakan dengan teliti oleh tim kami, memastikan hasil yang rapi dan tahan lama.'
                    ])
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    @include('components.info-card', [
                        'icon' => 'fas fa-tag',
                        'title' => 'Harga Jujur & Transparan',
                        'description' => 'Dapatkan penawaran harga yang kompetitif dan transparan, tanpa mengorbankan kualitas material maupun hasil produksi.'
                    ])
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    @include('components.info-card', [
                        'icon' => 'fas fa-clock',
                        'title' => 'Fleksibel & Tepat Waktu',
                        'description' => 'Kami mengerti kebutuhan Anda. Proses produksi kami fleksibel dan selalu berusaha menyelesaikan pesanan sesuai jadwal.'
                    ])
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
                            @include('components.portfolio-card', ['product' => $product])
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
                    @include('components.process-step', [
                        'number' => '1',
                        'icon' => 'fas fa-comments',
                        'title' => 'Ngobrol & Konsultasi',
                        'description' => 'Ceritakan ide desain Anda, kami siap mendengarkan dan memberikan masukan terbaik.',
                        'delay' => '100'
                    ])
                    @include('components.process-step', [
                        'number' => '2',
                        'icon' => 'fas fa-file-alt',
                        'title' => 'Penawaran & Sampel',
                        'description' => 'Kami akan siapkan penawaran harga dan sampel jika diperlukan, agar sesuai dengan ekspektasi Anda.',
                        'delay' => '200'
                    ])
                    @include('components.process-step', [
                        'number' => '3',
                        'icon' => 'fas fa-cogs',
                        'title' => 'Proses Produksi',
                        'description' => 'Setiap pesanan diproses dengan mesin modern dan tenaga ahli, menjamin hasil produksi yang presisi dan berkualitas tinggi.',
                        'delay' => '300'
                    ])
                    @include('components.process-step', [
                        'number' => '4',
                        'icon' => 'fas fa-shipping-fast',
                        'title' => 'Kirim & Terima',
                        'description' => 'Produk jadi kami kemas rapi dan kirimkan langsung ke alamat Anda dengan aman.',
                        'delay' => '400'
                    ])
                </div>
            </div>
        </div>
    </section>

    @include('components.cta-section', [
    'title' => 'Wujudkan Pakaian Kustom Impian Anda Sekarang!',
    'subtitle' => 'Tim kami siap membantu Anda menciptakan jersey basket, PDL/PDH, jersey futsal & esport, hoodie, atau jaket dengan kualitas terbaik. Hubungi kami untuk konsultasi gratis!'
])

@endsection

@push('scripts')
<script>
    @if(session('success'))
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        Toast.fire({
            icon: 'success',
            title: '{{ session('success') }}'
        });
    @endif
</script>
@endpush
