@extends('layouts.app')

@section('title', $product->name . ' - TAASHOP')

@section('content')
    <section class="section section-compact-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <img src="{{ $product->image_path ? asset('storage/' . $product->image_path) : 'https://via.placeholder.com/600x600.png/f97316/ffffff?text=TAASHOP' }}" class="img-fluid rounded mb-4" alt="{{ $product->name }}">
                </div>
                <div class="col-lg-6">
                    <h1 class="mb-3">{{ $product->name }}</h1>
                    <p class="text-muted mb-2">Kategori: {{ $product->category->name ?? 'Uncategorized' }}</p>
                    <h3 class="text-primary mb-4">Rp {{ number_format($product->price, 0, ',', '.') }}</h3>
                    <p class="lead">{{ $product->description }}</p>
                    <p class="fw-bold">Stok Tersedia: {{ $product->stock }}</p>

                    <div class="d-flex align-items-center mb-4">
                        <label for="quantity" class="form-label me-3 mb-0">Jumlah:</label>
                        <input type="number" id="productQuantity" class="form-control w-auto" value="1" min="1" max="{{ $product->stock }}">
                    </div>

                    <div class="d-grid gap-2">
                        <button type="button" class="btn btn-primary btn-lg" id="addToCartBtn" data-product-id="{{ $product->id }}">Tambahkan Ke Keranjang</button>
                        <button type="button" class="btn btn-outline-primary btn-lg" id="buyNowBtn" data-product-id="{{ $product->id }}">Beli Sekarang</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Hidden form for Buy Now --}}
    <form id="buyNowForm" action="{{ route('checkout.buy-now') }}" method="POST" style="display: none;">
        @csrf
        <input type="hidden" name="product_id" id="buyNowProductId">
        <input type="hidden" name="quantity" id="buyNowQuantity">
    </form>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const productQuantityInput = document.getElementById('productQuantity');
        const addToCartBtn = document.getElementById('addToCartBtn');
        const buyNowBtn = document.getElementById('buyNowBtn');
        const cartCountBadge = document.querySelector('.cart-count'); // Assuming this exists in your layout

        // Add to Cart functionality
        addToCartBtn.addEventListener('click', function() {
            const productId = this.dataset.productId;
            const quantity = productQuantityInput.value;

            fetch(`{{ route('cart.add', ['product' => '__PRODUCT_ID__']) }}`.replace('__PRODUCT_ID__', productId), {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ quantity: quantity })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    if (cartCountBadge && data.cart_count !== undefined) {
                        cartCountBadge.textContent = data.cart_count;
                    }
                } else {
                    alert('Gagal: ' + (data.message || 'Error tidak diketahui'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan. Cek konsol.');
            });
        });

        // Buy Now functionality
        buyNowBtn.addEventListener('click', function() {
            const productId = this.dataset.productId;
            const quantity = productQuantityInput.value;
            
            document.getElementById('buyNowProductId').value = productId;
            document.getElementById('buyNowQuantity').value = quantity;
            document.getElementById('buyNowForm').submit();
        });
    });
</script>
@endpush