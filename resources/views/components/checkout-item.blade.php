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
