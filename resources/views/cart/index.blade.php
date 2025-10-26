@extends('layouts.app')

@section('title', 'Keranjang Belanja - TAASHOP')

@section('content')
<section class="section">
    <div class="container">
        <h1 class="text-center mb-4">Keranjang Belanja Anda</h1>

        @if(empty($cart))
            <div class="alert alert-info text-center" role="alert">
                Keranjang Anda kosong. Mulai belanja sekarang!
            </div>
            <div class="text-center">
                <a href="{{ route('products.index') }}" class="btn btn-primary">Lihat Produk</a>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Kuantitas</th>
                            <th>Subtotal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @foreach($cart as $id => $details)
                            @php $subtotal = $details['price'] * $details['quantity']; $total += $subtotal; @endphp
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($details['image'])
                                            <img src="{{ asset('storage/' . $details['image']) }}" alt="{{ $details['name'] }}" class="img-thumbnail me-3" style="width: 80px; height: 80px; object-fit: cover;">
                                        @else
                                            <img src="https://via.placeholder.com/80x80.png/f97316/ffffff?text=TAASHOP" alt="{{ $details['name'] }}" class="img-thumbnail me-3" style="width: 80px; height: 80px; object-fit: cover;">
                                        @endif
                                        <div>
                                            <h5 class="mb-0">{{ $details['name'] }}</h5>
                                            <small class="text-muted">ID: {{ $id }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>Rp {{ number_format($details['price'], 0, ',', '.') }}</td>
                                <td>
                                    <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity-input" min="1" data-id="{{ $id }}" style="width: 80px;">
                                </td>
                                <td>Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                                <td>
                                    <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}">Hapus</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-end"><strong>Total:</strong></td>
                            <td><strong>Rp {{ number_format($total, 0, ',', '.') }}</strong></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Lanjutkan Belanja</a>
                <button class="btn btn-success">Checkout</button>
            </div>
        @endif
    </div>
</section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Update quantity functionality (requires a route for cart.update)
        document.querySelectorAll('.quantity-input').forEach(input => {
            input.addEventListener('change', function() {
                const productId = this.dataset.id;
                const newQuantity = this.value;

                fetch(`{{ route('cart.update', ['product' => 'PRODUCT_ID_PLACEHOLDER']) }}`.replace('PRODUCT_ID_PLACEHOLDER', productId), {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ quantity: newQuantity })
                })
                .then(response => {
                    if (!response.ok) {
                        return response.text().then(text => { throw new Error(text) });
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        window.location.reload(); // Reload page to reflect changes
                    } else {
                        alert('Failed to update cart: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error updating cart:', error);
                    alert('An error occurred while updating cart.');
                });
            });
        });

        // Remove from cart functionality (requires a route for cart.remove)
        document.querySelectorAll('.remove-from-cart').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.dataset.id;

                if (confirm('Are you sure you want to remove this item from your cart?')) {
                    fetch(`{{ route('cart.remove', ['product' => 'PRODUCT_ID_PLACEHOLDER']) }}`.replace('PRODUCT_ID_PLACEHOLDER', productId), {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            return response.text().then(text => { throw new Error(text) });
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            window.location.reload(); // Reload page to reflect changes
                        } else {
                            alert('Failed to remove item: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error removing item:', error);
                        alert('An error occurred while removing item.');
                    });
                }
            });
        });
    });
</script>
@endpush
