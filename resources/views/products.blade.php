@extends('layouts.app')

@section('title', 'Produk Kami - TAASHOP')

@section('content')

    @include('components.hero-small', [
    'title' => 'Produk Kami',
    'subtitle' => 'Jelajahi berbagai pilihan produk konveksi berkualitas dari TAASHOP.',
    'imageUrl' => asset('images/bg-hero-product.jpg')
])

    <section class="section section-compact-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    @include('components.filter-sidebar', ['categories' => $categories, 'selectedCategories' => $selectedCategories])
                </div>
                <div class="col-lg-9">
                    <div class="products-grid">
                        @forelse ($products as $product)
                            @include('components.product-card', ['product' => $product])
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

