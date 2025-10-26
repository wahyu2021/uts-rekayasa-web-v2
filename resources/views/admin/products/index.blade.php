@extends('admin.layouts.app')

@section('title', 'Products')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card" data-aos="fade-up">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="m-0">All Products</h5>
                    <a href="{{ route('admin.products.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus me-1"></i> Add New</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.products.index') }}" method="GET" class="mb-4">
                        <div class="row g-3 align-items-end">
                            <div class="col-md-4">
                                <label for="categoryFilter" class="form-label">Filter by Category:</label>
                                <select class="form-select" id="categoryFilter" name="category_id">
                                    <option value="">All Categories</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-auto">
                                <button type="submit" class="btn btn-primary">Apply Filter</button>
                                @if(request('category_id'))
                                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">Reset</a>
                                @endif
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-hover m-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col" style="width: 80px;">Image</th>
                                <th scope="col">Name</th>
                                <th scope="col">Category</th>
                                <th scope="col">Price</th>
                                <th scope="col">Stock</th>
                                <th scope="col">Featured</th>
                                <th scope="col" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <tr>
                                    <td>{{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}</td>
                                    <td>
                                        @if ($product->image_path)
                                            <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" width="60" class="img-thumbnail">
                                        @else
                                            <span class="text-muted">No Image</span>
                                        @endif
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category->name ?? 'N/A' }}</td>
                                    <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                    <td>{{ $product->stock }}</td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input feature-toggle" type="checkbox" role="switch" id="featureSwitch{{ $product->id }}" data-id="{{ $product->id }}" {{ $product->is_featured ? 'checked' : '' }}>
                                            <label class="form-check-label" for="featureSwitch{{ $product->id }}"></label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-pencil-alt me-1"></i> Edit</a>
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-action="{{ route('admin.products.destroy', $product->id) }}">
                                            <i class="fas fa-trash me-1"></i> Delete
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">No products found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.feature-toggle').forEach(function (toggle) {
            toggle.addEventListener('change', function () {
                const productId = this.dataset.id;
                const isFeatured = this.checked;

                fetch(`/admin/products/${productId}/toggle-feature`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ is_featured: isFeatured })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log('Product feature status updated successfully.');
                    } else {
                        console.error('Failed to update product feature status.');
                        this.checked = !isFeatured;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    this.checked = !isFeatured;
                });
            });
        });
    });
</script>
@endpush
