@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Order Details</h5>
                        <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-arrow-left"></i> Back to Orders
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-sm-4"><strong>Order Code:</strong></div>
                            <div class="col-sm-8">{{ $order->order_code }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4"><strong>Total Price:</strong></div>
                            <div class="col-sm-8">Rp {{ number_format($order->total_price, 0, ',', '.') }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4"><strong>Status:</strong></div>
                            <div class="col-sm-8">
                                <span class="badge bg-{{ $order->status == 'paid' ? 'success' : 'warning' }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4"><strong>Shipping Status:</strong></div>
                            <div class="col-sm-8">
                                <span class="badge bg-info text-dark">
                                    {{ ucfirst($order->shipping_status) }}
                                </span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4"><strong>Tracking Number:</strong></div>
                            <div class="col-sm-8">{{ $order->tracking_number ?? 'N/A' }}</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4"><strong>Order Date:</strong></div>
                            <div class="col-sm-8">{{ $order->created_at->format('d M Y H:i') }}</div>
                        </div>
                    </div>
                </div>

                @if ($order->tracking_history && count($order->tracking_history) > 0)
                    <div class="card shadow-sm">
                        <div class="card-header bg-white">
                            <h5 class="mb-0">Tracking History</h5>
                        </div>
                        <div class="card-body">
                            <div class="timeline">
                                @foreach ($order->tracking_history as $history)
                                    <div class="timeline-item">
                                        <div class="timeline-marker"></div>
                                        <div class="timeline-content">
                                            <p class="fw-bold mb-1">{{ $history['status'] }}</p>
                                            <p class="text-muted mb-1">{{ $history['location'] }}</p>
                                            <p class="text-muted mb-1">{{ $history['description'] }}</p>
                                            <small class="text-muted">{{ \Carbon\Carbon::parse($history['timestamp'])->format('d M Y H:i') }}</small>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .timeline {
            position: relative;
            padding-left: 2rem;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 2px;
            background-color: #e9ecef;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 2rem;
        }

        .timeline-marker {
            position: absolute;
            left: -8px;
            top: 5px;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background-color: #0d6efd;
            border: 3px solid #fff;
        }

        .timeline-content {
            padding-left: 1.5rem;
        }
    </style>
@endpush
