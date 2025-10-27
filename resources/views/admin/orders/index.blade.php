@extends('admin.layouts.app')

@section('title', 'Orders')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card" data-aos="fade-up">
                <div class="card-header">
                    <h3 class="card-title">All Orders</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover m-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Order ID</th>
                                <th scope="col">Customer</th>
                                <th scope="col">Order Date</th>
                                <th scope="col">Total</th>
                                <th scope="col">Status</th>
                                <th scope="col">Shipping Status</th>
                                <th scope="col" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                                <tr>
                                    <td>#{{ $order->id }}</td>
                                    <td>{{ $order->user->name }}</td>
                                    <td>{{ $order->created_at->format('d M Y') }}</td>
                                    <td>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                    <td><span class="badge bg-{{ $order->status == 'paid' ? 'success' : 'warning' }}">{{ ucfirst($order->status) }}</span></td>
                                    <td><span class="badge bg-info">{{ $order->shipping_status ?? 'N/A' }}</span></td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-pencil-alt me-1"></i> Edit</a>
                                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-info"><i class="fas fa-eye me-1"></i> View</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">No orders found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
