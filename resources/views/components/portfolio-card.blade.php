<div class="portfolio-card">
    <img src="{{ $product->image_path ? asset('storage/' . $product->image_path) : 'https://via.placeholder.com/400x500.png/f97316/ffffff?text=TAASHOP' }}" alt="{{ $product->name }}">
    <div class="portfolio-overlay">
        <h6>{{ $product->name }}</h6>
        <p>{{ $product->category->name ?? '' }}</p>
    </div>
    <a href="{{ route('products.show', $product->slug) }}" class="stretched-link"></a>
</div>