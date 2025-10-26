@extends('layouts.app')

@section('title', 'Keranjang Belanja - TAASHOP')

@section('content')
    <section class="hero-section-small" style="background-image: url('{{ asset('images/bg-hero-product.jpg') }}'); background-size: cover; background-position: center;">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="hero-title-small">Keranjang Belanja</h1>
                    <p class="hero-subtitle-small">Periksa kembali pesanan Anda sebelum melanjutkan pembayaran.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section section-compact-top">
        <div class="container">
            @if(empty($cart))
                <div class="text-center py-5">
                    <i class="fas fa-shopping-cart fa-5x text-muted mb-4"></i>
                    <h3 class="text-secondary mb-3">Keranjang Anda kosong</h3>
                    <p class="lead text-muted mb-4">Sepertinya Anda belum menambahkan apapun ke keranjang. Jelajahi produk kami dan temukan yang Anda suka!</p>
                    <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg">Mulai Belanja Sekarang</a>
                </div>
            @else
                <form id="checkoutForm" action="{{ route('checkout.selected') }}" method="POST">
                    @csrf
                    <div class="row">
                    <div class="col-lg-8">
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-white py-3">
                                <h5 class="mb-0 text-secondary">Detail Pesanan</h5>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="border-0 text-center">
                                                    <input type="checkbox" id="selectAllProducts" class="form-check-input">
                                                </th>
                                                <th scope="col" class="border-0">Produk</th>
                                                <th scope="col" class="border-0">Harga</th>
                                                <th scope="col" class="border-0">Kuantitas</th>
                                                <th scope="col" class="border-0">Subtotal</th>
                                                <th scope="col" class="border-0">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($cart as $id => $details)
                                                    <tr data-product-id="{{ $id }}" data-product-price="{{ $details['price'] }}">
                                                        <td class="align-middle text-center">
                                                            <input type="checkbox" name="selected_products[]" value="{{ $id }}" class="form-check-input product-checkbox">
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                @if($details['image'])
                                                                    <img src="{{ asset('storage/' . $details['image']) }}" alt="{{ $details['name'] }}" class="img-thumbnail me-3" style="width: 80px; height: 80px; object-fit: cover; border-radius: var(--border-radius-sm);">
                                                                @else
                                                                    <img src="https://via.placeholder.com/80x80.png/f97316/ffffff?text=TAASHOP" alt="{{ $details['name'] }}" class="img-thumbnail me-3" style="width: 80px; height: 80px; object-fit: cover; border-radius: var(--border-radius-sm);">
                                                                @endif
                                                                <div>
                                                                    <h6 class="mb-0 text-secondary">{{ $details['name'] }}</h6>
                                                                    <small class="text-muted">ID: {{ $id }}</small>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="align-middle">Rp {{ number_format($details['price'], 0, ',', '.') }}</td>
                                                        <td class="align-middle">
                                                            <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity-input" min="1" data-id="{{ $id }}" style="width: 80px;" name="quantities[{{ $id }}]">
                                                        </td>
                                                        <td class="align-middle product-subtotal">Rp {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}</td>
                                                        <td class="align-middle">
                                                            <button type="button" class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}" title="Hapus Produk"><i class="fas fa-trash"></i></button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card shadow-sm">
                            <div class="card-header bg-white py-3">
                                <h5 class="mb-0 text-secondary">Ringkasan Belanja</h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                        Total Produk Dipilih
                                        <span id="selectedProductsTotal">Rp 0</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 text-primary fw-bold">
                                        Total Pembayaran
                                        <span class="h5 mb-0" id="totalPayment">Rp 0</span>
                                    </li>
                                </ul>
                                <div class="d-grid gap-2 mt-4">
                                    <button type="submit" class="btn btn-primary btn-lg" id="checkoutButton" disabled>Lanjutkan ke Checkout</button>
                                    <a href="{{ route('products.index') }}" class="btn btn-secondary btn-lg">Lanjutkan Belanja</a>
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkoutForm = document.getElementById('checkoutForm');
        const selectAllProducts = document.getElementById('selectAllProducts');
        const productCheckboxes = document.querySelectorAll('.product-checkbox');
        const quantityInputs = document.querySelectorAll('.quantity-input');
        const selectedProductsTotalSpan = document.getElementById('selectedProductsTotal');
        const totalPaymentSpan = document.getElementById('totalPayment');
        const checkoutButton = document.getElementById('checkoutButton');

        function formatRupiah(number) {
            return 'Rp ' + new Intl.NumberFormat('id-ID').format(number);
        }

        function updateSelectedTotal() {
            let selectedTotal = 0;
            let anyProductSelected = false;

            productCheckboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    anyProductSelected = true;
                    const row = checkbox.closest('tr');
                    const price = parseFloat(row.dataset.productPrice);
                    const quantity = parseInt(row.querySelector('.quantity-input').value);
                    selectedTotal += price * quantity;
                }
            });

            selectedProductsTotalSpan.textContent = formatRupiah(selectedTotal);
            totalPaymentSpan.textContent = formatRupiah(selectedTotal);
            checkoutButton.disabled = !anyProductSelected;
        }

        // Event Listeners
        selectAllProducts.addEventListener('change', function() {
            productCheckboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            updateSelectedTotal();
        });

        productCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                if (!this.checked) {
                    selectAllProducts.checked = false;
                }
                updateSelectedTotal();
            });
        });

        // Explicitly handle checkout button click
        checkoutButton.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default form submission initially
            console.log('Checkout button clicked.');

            // Check if any product is selected before submitting
            let anyProductSelected = false;
            productCheckboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    anyProductSelected = true;
                }
            });

            if (anyProductSelected) {
                console.log('Submitting checkout form...');
                checkoutForm.submit();
            } else {
                alert('Pilih setidaknya satu produk untuk melanjutkan checkout.');
            }
        });

        quantityInputs.forEach(input => {
            input.addEventListener('change', function() {
                const productId = this.dataset.id;
                const newQuantity = this.value;

                // Update subtotal display for the row
                const row = this.closest('tr');
                const price = parseFloat(row.dataset.productPrice);
                const subtotalElement = row.querySelector('.product-subtotal');
                subtotalElement.textContent = formatRupiah(price * newQuantity);

                // Update cart via AJAX
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
                        // No page reload, just update totals if checkbox is checked
                        if (row.querySelector('.product-checkbox').checked) {
                            updateSelectedTotal();
                        }
                    } else {
                        alert('Gagal memperbarui keranjang: ' + data.message);
                        // Revert quantity if update failed
                        // window.location.reload(); 
                    }
                })
                .catch(error => {
                    console.error('Error updating cart:', error);
                    alert('Terjadi kesalahan saat memperbarui keranjang. Periksa konsol untuk detail.');
                    // window.location.reload(); 
                });
            });
        });

        // Remove from cart functionality
        document.querySelectorAll('.remove-from-cart').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.dataset.id;

                if (confirm('Apakah Anda yakin ingin menghapus item ini dari keranjang?')) {
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
                            alert('Gagal menghapus item: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error removing item:', error);
                        alert('Terjadi kesalahan saat menghapus item. Periksa konsol untuk detail.');
                    });
                }
            });
        });

        // Initial update of total when page loads
        updateSelectedTotal();
    });
</script>
@endpush