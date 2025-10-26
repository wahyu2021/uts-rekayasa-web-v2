@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <!-- Stat Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-3" data-aos="fade-up" data-aos-delay="100">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="flex-shrink-0 bg-primary text-white rounded-3 me-3 p-3">
                        <i class="fas fa-box fa-2x"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="text-muted">Total Products</div>
                        <div class="h4 mb-0">{{ $totalProducts }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3" data-aos="fade-up" data-aos-delay="200">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="flex-shrink-0 bg-success text-white rounded-3 me-3 p-3">
                        <i class="fas fa-tags fa-2x"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="text-muted">Total Categories</div>
                        <div class="h4 mb-0">{{ $totalCategories }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3" data-aos="fade-up" data-aos-delay="300">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="flex-shrink-0 bg-info text-white rounded-3 me-3 p-3">
                        <i class="fas fa-shopping-cart fa-2x"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="text-muted">Total Orders</div>
                        <div class="h4 mb-0">{{ $totalOrders }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3" data-aos="fade-up" data-aos-delay="400">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="flex-shrink-0 bg-warning text-white rounded-3 me-3 p-3">
                        <i class="fas fa-dollar-sign fa-2x"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="text-muted">Total Revenue</div>
                        <div class="h4 mb-0">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sales Chart -->
    <div class="row">
        <div class="col-12" data-aos="fade-up" data-aos-delay="500">
            <div class="card">
                <div class="card-header">
                    Sales in the Last 7 Days
                </div>
                <div class="card-body">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($chartData['labels']) !!},
                datasets: [{
                    label: 'Revenue',
                    data: {!! json_encode($chartData['data']) !!},
                    backgroundColor: 'rgba(249, 115, 22, 0.2)',
                    borderColor: 'rgba(249, 115, 22, 1)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value, index, values) {
                                return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += 'Rp ' + new Intl.NumberFormat('id-ID').format(context.parsed.y);
                                }
                                return label;
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endpush
