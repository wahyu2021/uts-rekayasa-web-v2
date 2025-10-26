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
                    <form action="{{ route('products.index') }}" method="GET">
                        <div class="filter-section mb-4">
                            <h3 class="filter-title mb-3">Filter Berdasarkan Kategori</h3>
                            <div class="filter-options">
                                @if($categories->isNotEmpty())
                                    @foreach($categories as $category)
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" name="categories[]" value="{{ $category->slug }}" id="filter-{{ $category->slug }}"
                                                @if(in_array($category->slug, $selectedCategories)) checked @endif>
                                            <label class="form-check-label" for="filter-{{ $category->slug }}">{{ $category->name }}</label>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary mt-3 w-100">Terapkan Filter</button>
                            @if(!empty($selectedCategories))
                                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary mt-2 w-100">Reset Filter</a>
                            @endif
                        </div>
                    </form>
                </div>
                <div class="col-lg-9">
                    <div class="products-grid">
                        @forelse ($products as $product)
                            <div class="product-card d-flex flex-column" data-aos="fade-up" data-category="{{ $product->category->slug ?? '' }}"
                                data-id="{{ $product->id }}"
                                data-name="{{ $product->name }}"
                                data-description="{{ $product->description }}"
                                data-price="{{ number_format($product->price, 0, ',', '.') }}"
                                data-image="{{ $product->image_path ? asset('storage/' . $product->image_path) : 'https://via.placeholder.com/400x500.png/f97316/ffffff?text=TAASHOP' }}"
                                data-stock="{{ $product->stock }}"
                                style="cursor: pointer;">
                                <div class="product-image">
                                    <img src="{{ $product->image_path ? asset('storage/' . $product->image_path) : 'https://via.placeholder.com/400x500.png/f97316/ffffff?text=TAASHOP' }}" alt="{{ $product->name }}">
                                    @if($product->is_featured)
                                        <div class="product-badge">Best Seller</div>
                                    @endif
                                </div>
                                <div class="product-info">
                                    <h5>{{ $product->name }}</h5>
                                    <p class="product-desc">{{ Str::limit($product->description, 100) }}</p>
                                    <div class="product-specs">
                                        <div class="spec-item">Mulai dari Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <p class="text-center">Tidak ada produk yang ditemukan.</p>
                            </div>
                        @endforelse
                    </div>
                    <div class="pagination-wrapper mt-5">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

<div class="modal fade" id="productDetailModal" tabindex="-1" aria-labelledby="productDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productDetailModalLabel">Detail Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <img src="" class="img-fluid rounded mb-3" alt="Product Image" id="modalProductImage">
                    </div>
                    <div class="col-md-6">
                        <h3 id="modalProductName"></h3>
                        <p class="text-muted mb-2">Kategori: <span id="modalProductCategory"></span></p>
                        <h4 class="text-primary mb-3" id="modalProductPrice"></h4>
                        <p id="modalProductDescription"></p>
                        <p class="fw-bold">Stok: <span id="modalProductStock"></span></p>

                        <div class="d-flex align-items-center mb-3">
                            <label for="quantity" class="form-label me-2 mb-0">Jumlah:</label>
                            <input type="number" id="productQuantity" class="form-control w-auto" value="1" min="1">
                        </div>

                        <div class="d-grid gap-2">
                            <button type="button" class="btn btn-primary btn-lg" id="addToCartBtn">Tambahkan Ke Keranjang</button>
                            <button type="button" class="btn btn-outline-primary btn-lg" id="buyNowBtn">Beli Sekarang</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const productDetailModalEl = document.getElementById('productDetailModal');
        // Instance modal sekarang akan berhasil karena window.bootstrap sudah ada
        const productModal = new bootstrap.Modal(productDetailModalEl);
        
        const cartCountBadge = document.querySelector('.cart-count');

        document.querySelectorAll('.product-card').forEach(card => {
            card.addEventListener('click', function() {
                const id = this.dataset.id;
                const name = this.dataset.name;
                const description = this.dataset.description;
                const price = this.dataset.price;
                const image = this.dataset.image;
                const stock = this.dataset.stock;
                const category = this.dataset.category;

                productDetailModalEl.querySelector('#modalProductImage').src = image;
                productDetailModalEl.querySelector('#modalProductName').textContent = name;
                productDetailModalEl.querySelector('#modalProductCategory').textContent = category;
                productDetailModalEl.querySelector('#modalProductPrice').textContent = `Rp ${price}`;
                productDetailModalEl.querySelector('#modalProductDescription').textContent = description;
                productDetailModalEl.querySelector('#modalProductStock').textContent = stock;
                
                const productQuantity = productDetailModalEl.querySelector('#productQuantity');
                productQuantity.value = 1; 
                productQuantity.max = stock; 
                
                productDetailModalEl.querySelector('#addToCartBtn').dataset.productId = id;
                productDetailModalEl.querySelector('#buyNowBtn').dataset.productId = id;

                productDetailModalEl.setAttribute('aria-hidden', 'false');
                productModal.show();
            });
        });

        document.getElementById('addToCartBtn').addEventListener('click', function() {
            const productId = this.dataset.productId;
            const quantity = document.getElementById('productQuantity').value;
            
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
                    document.activeElement.blur(); // Remove focus from the active element
                    productModal.hide();
                    productDetailModalEl.setAttribute('aria-hidden', 'true');
                } else {
                    alert('Gagal: ' + (data.message || 'Error tidak diketahui'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan. Cek konsol.');
            });
        });

        document.getElementById('buyNowBtn').addEventListener('click', function() {
            const productId = this.dataset.productId;
            const quantity = document.getElementById('productQuantity').value;
            
            fetch(`{{ route('cart.add', ['product' => '__PRODUCT_ID__']) }}`.replace('__PRODUCT_ID__', productId), {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ quantity: quantity, buy_now: true })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.activeElement.blur(); // Remove focus from the active element
            window.location.href = '{{ route('checkout.index') }}';
                } else {
                    alert('Gagal: ' + (data.message || 'Error tidak diketahui'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat memproses Beli Sekarang. Cek konsol.');
            });
        });
    });
</script>
@endpush