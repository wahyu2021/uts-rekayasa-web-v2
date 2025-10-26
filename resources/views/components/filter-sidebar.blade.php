

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
