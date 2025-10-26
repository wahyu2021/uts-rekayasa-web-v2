<div class="mb-3">
    <label for="name" class="form-label">Nama Produk</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $product->name ?? '') }}" required>
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="category_id" class="form-label">Kategori</label>
    <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
        <option value="" disabled {{ !isset($product) ? 'selected' : '' }}>Pilih Kategori</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    @error('category_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="price" class="form-label">Harga</label>
            <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', $product->price ?? '') }}" required>
            @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label for="stock" class="form-label">Stok</label>
            <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ old('stock', $product->stock ?? '') }}" required>
            @error('stock')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="mb-3">
    <label for="description" class="form-label">Deskripsi</label>
    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" required>{{ old('description', $product->description ?? '') }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="image_path" class="form-label">Gambar Produk</label>
    <input class="form-control @error('image_path') is-invalid @enderror" type="file" id="image_path" name="image_path">
    @error('image_path')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    @if(isset($product) && $product->image_path)
        <div class="mt-2">
            <small>Gambar saat ini:</small>
            <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="img-thumbnail mt-1" width="150">
        </div>
    @endif
</div>

<div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="is_featured" name="is_featured" value="1" {{ old('is_featured', isset($product) && $product->is_featured) ? 'checked' : '' }}>
    <label class="form-check-label" for="is_featured">Jadikan Produk Unggulan (Best Seller)</label>
</div>
