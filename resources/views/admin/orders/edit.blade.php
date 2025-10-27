@extends('admin.layouts.app')

@section('title', 'Edit Order')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Order #{{ $order->id }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tracking_number" class="form-label">Tracking Number</label>
                                    <input type="text" class="form-control" id="tracking_number" name="tracking_number" value="{{ old('tracking_number', $order->tracking_number) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" id="status" name="status">
                                        <option value="pending" {{ old('status', $order->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="paid" {{ old('status', $order->status) == 'paid' ? 'selected' : '' }}>Paid</option>
                                        <option value="failed" {{ old('status', $order->status) == 'failed' ? 'selected' : '' }}>Failed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="shipping_status" class="form-label">Shipping Status</label>
                                    <select class="form-select" id="shipping_status" name="shipping_status">
                                        <option value="pending" {{ old('shipping_status', $order->shipping_status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="processing" {{ old('shipping_status', $order->shipping_status) == 'processing' ? 'selected' : '' }}>Processing</option>
                                        <option value="shipped" {{ old('shipping_status', $order->shipping_status) == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                        <option value="delivered" {{ old('shipping_status', $order->shipping_status) == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                        <option value="cancelled" {{ old('shipping_status', $order->shipping_status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <h4>Add Tracking History</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="location" class="form-label">Location</label>
                                    <input type="text" class="form-control" id="location" name="tracking_history[location]">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <input type="text" class="form-control" id="status" name="tracking_history[status]">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <input type="text" class="form-control" id="description" name="tracking_history[description]">
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Order</button>
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>

                    <hr>

                    <h4>Current Tracking History</h4>
                    @if ($order->tracking_history && count($order->tracking_history) > 0)
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Timestamp</th>
                                    <th>Location</th>
                                    <th>Status</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (collect($order->tracking_history)->sortByDesc('timestamp') as $history)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($history['timestamp'])->format('d M Y, H:i') }}</td>
                                        <td>{{ $history['location'] }}</td>
                                        <td>{{ $history['status'] }}</td>
                                        <td>{{ $history['description'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>No tracking history available.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
