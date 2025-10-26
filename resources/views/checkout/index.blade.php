@extends('layouts.app')

@section('title', 'Checkout - TAASHOP')

@section('content')
    <section class="hero-section-small" style="background-image: url('{{ asset('images/bg-hero-product.jpg') }}'); background-size: cover; background-position: center;">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="hero-title-small">Checkout</h1>
                    <p class="hero-subtitle-small">Selesaikan pesanan Anda dengan mudah dan aman.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section section-compact-top">
        <div class="container">
            @if($cartItems->isEmpty())
                <div class="text-center py-5">
                    <i class="fas fa-shopping-cart fa-5x text-muted mb-4"></i>
                    <h3 class="text-secondary mb-3">Keranjang Anda kosong</h3>
                    <p class="lead text-muted mb-4">Silakan tambahkan produk ke keranjang Anda sebelum melanjutkan ke checkout.</p>
                    <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg">Lanjutkan Belanja</a>
                </div>
            @else
                <form action="{{ route('checkout.store') }}" method="POST">
                    @csrf
                    <div class="row g-5">
                        <div class="col-lg-6">
                            <div class="card shadow-sm mb-4">
                                <div class="card-header bg-white py-3">
                                    <h5 class="mb-0 text-secondary">Ringkasan Pesanan</h5>
                                </div>
                                <div class="card-body">
                                    @php $total = 0; @endphp
                                    @foreach($cartItems as $item)
                                        <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                                            <div class="d-flex align-items-center">
                                                @if($item->product->image_path)
                                                    <img src="{{ asset('storage/' . $item->product->image_path) }}" alt="{{ $item->product->name }}" class="img-thumbnail me-3" style="width: 60px; height: 60px; object-fit: cover; border-radius: var(--border-radius-sm);">
                                                @else
                                                     <img src="https://via.placeholder.com/60x60.png/f97316/ffffff?text=TAASHOP" alt="{{ $item->product->name }}" class="img-thumbnail me-3" style="width: 60px; height: 60px; object-fit: cover; border-radius: var(--border-radius-sm);">
                                                @endif
                                                <div>
                                                    <h6 class="mb-0 text-secondary">{{ $item->product->name }}</h6>
                                                    <small class="text-muted">Jumlah: {{ $item->quantity }}</small>
                                                </div>
                                            </div>
                                            <span class="fw-bold text-secondary">Rp{{ number_format($item->price * $item->quantity, 0, ',', '.') }}</span>
                                        </div>
                                        @php $total += $item->price * $item->quantity; @endphp
                                    @endforeach
                                    <div class="d-flex justify-content-between align-items-center h5 mt-4">
                                        <span>Total Pembayaran:</span>
                                        <span class="fw-bold text-primary">Rp{{ number_format($total, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card shadow-sm">
                                <div class="card-header bg-white py-3">
                                    <h5 class="mb-0 text-secondary">Informasi Pengiriman & Pembayaran</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama Lengkap</label>
                                        <input type="text" id="name" name="name" class="form-control" value="{{ auth()->user() ? auth()->user()->name : '' }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" id="email" name="email" class="form-control" value="{{ auth()->user() ? auth()->user()->email : '' }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="shipping_address" class="form-label">Alamat Pengiriman Lengkap</label>
                                        <textarea id="shipping_address" name="shipping_address" class="form-control" rows="4" placeholder="Contoh: Jl. Pahlawan No. 123, Kel. Suka Maju, Kec. Damai, Kota Bandung, Jawa Barat 40123" required></textarea>
                                    </div>

                                    <h5 class="mt-4 mb-3 text-secondary">Metode Pembayaran</h5>
                                    <div class="mb-3">
                                        <select name="payment_method" class="form-select" required>
                                            <option value="" disabled selected>Pilih Metode Pembayaran</option>
                                            <option value="credit_card">Kartu Kredit</option>
                                            <option value="bank_transfer">Transfer Bank</option>
                                            <option value="gopay">GoPay</option>
                                            <option value="dana">DANA</option>
                                        </select>
                                    </div>

                                    <div class="d-grid mt-4">
                                        <button type="submit" class="btn btn-primary btn-lg">Buat Pesanan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            @endif
        </div>
    </section>
@endsection