@extends('layouts.app')

@section('title', 'My Orders')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4">My Orders</h1>
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Order Code</th>
                                <th scope="col">Total Price</th>
                                <th scope="col">Status</th>
                                <th scope="col">Shipping Status</th>
                                <th scope="col">Order Date</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                                <tr>
                                    <td>{{ $order->order_code }}</td>
                                    <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="badge bg-{{ $order->status == 'paid' ? 'success' : 'warning' }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-info text-dark">
                                            {{ ucfirst($order->shipping_status) }}
                                        </span>
                                    </td>
                                    <td>{{ $order->created_at->format('d M Y') }}</td>
                                    <td>
                                        <a href="{{ route('orders.show', $order) }}" class="btn btn-primary btn-sm">
                                            <i class="bi bi-eye"></i> View
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">You have no orders yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
@endsection
