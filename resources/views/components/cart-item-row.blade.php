

<tr data-product-id="{{ $item->product->id }}" data-product-price="{{ $item->price }}">
    <td class="align-middle text-center">
        <input type="checkbox" name="selected_products[]" value="{{ $item->product->id }}" class="form-check-input product-checkbox">
    </td>
    <td>
        <div class="d-flex align-items-center">
            @if($item->product->image_path)
                <img src="{{ asset('storage/' . $item->product->image_path) }}" alt="{{ $item->product->name }}" class="img-thumbnail me-3" style="width: 80px; height: 80px; object-fit: cover; border-radius: var(--border-radius-sm);">
            @else
                <img src="https://via.placeholder.com/80x80.png/f97316/ffffff?text=TAASHOP" alt="{{ $item->product->name }}" class="img-thumbnail me-3" style="width: 80px; height: 80px; object-fit: cover; border-radius: var(--border-radius-sm);">
            @endif
            <div>
                <h6 class="mb-0 text-secondary">{{ $item->product->name }}</h6>
                <small class="text-muted">ID: {{ $item->product->id }}</small>
            </div>
        </div>
    </td>
    <td class="align-middle">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
    <td class="align-middle">
        <input type="number" value="{{ $item->quantity }}" class="form-control quantity-input" min="1" data-id="{{ $item->product->id }}" style="width: 80px;" name="quantities[{{ $item->product->id }}]">
    </td>
    <td class="align-middle product-subtotal">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
    <td class="align-middle">
        <button type="button" class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $item->product->id }}" title="Hapus Produk"><i class="fas fa-trash"></i></button>
    </td>
</tr>
