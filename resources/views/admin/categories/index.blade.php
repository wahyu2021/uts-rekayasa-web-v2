@extends('admin.layouts.app')

@section('title', 'Categories')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card" data-aos="fade-up">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="m-0">All Categories</h5>
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus me-1"></i> Add New</a>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover m-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $category)
                                <tr>
                                    <td>{{ ($categories->currentPage() - 1) * $categories->perPage() + $loop->iteration }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->description }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-pencil-alt me-1"></i> Edit</a>
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-action="{{ route('admin.categories.destroy', $category->id) }}">
                                            <i class="fas fa-trash me-1"></i> Delete
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4">No categories found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
