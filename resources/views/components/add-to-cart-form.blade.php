<div class="d-flex align-items-center mb-4">
    <label for="productQuantity" class="form-label me-3 mb-0">Jumlah:</label>
    <input type="number" id="productQuantity" class="form-control w-auto" value="1" min="1" max="{{ $product->stock }}">
</div>

@auth
<div class="d-grid gap-2">
    <button type="button" class="btn btn-primary btn-lg" id="addToCartBtn" data-product-id="{{ $product->id }}">Tambahkan Ke Keranjang</button>
    <button type="button" class="btn btn-outline-primary btn-lg" id="buyNowBtn" data-product-id="{{ $product->id }}">Beli Sekarang</button>
</div>
@endauth
@guest
<div class="d-grid gap-2">
    <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Login untuk Belanja</a>
</div>
@endguest
