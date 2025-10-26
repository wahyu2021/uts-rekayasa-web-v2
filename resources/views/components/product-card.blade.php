

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
