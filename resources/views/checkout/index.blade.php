@extends('layouts.app')

@section('title', 'Checkout - TAASHOP')

@section('content')
    @include('components.hero-small', [
    'title' => 'Checkout',
    'subtitle' => 'Selesaikan pesanan Anda dengan mudah dan aman.',
    'imageUrl' => asset('images/bg-hero-product.jpg')
])

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
                                        @include('components.checkout-item', ['item' => $item])
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