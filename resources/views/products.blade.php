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
                            <a href="{{ route('products.show', $product->slug) }}" class="product-card d-flex flex-column" data-aos="fade-up" data-category="{{ $product->category->slug ?? '' }}">
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
                            </a>
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

