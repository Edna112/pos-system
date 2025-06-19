@extends('layouts.tabler')

@section('content')
<div class="container-xl py-3">
    <!-- Key Metrics Card Row -->
    <h5 class="mb-3 mt-2">Key Metrics</h5>
    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <span class="text-muted fw-medium">Total Sales</span>
                        <span class="bg-purple-lt text-purple rounded-circle p-2"><i class="ti ti-credit-card"></i></span>
                    </div>
                    <div class="fw-bold display-6 mb-1">{{ Number::currency($totalSales ?? 0, 'XAF') }}</div>
                    <div class="small fw-semibold {{ $salesGrowth >= 0 ? 'text-success' : 'text-danger' }}">
                        {{ number_format(abs($salesGrowth), 1) }}% 
                        <i class="ti ti-arrow-{{ $salesGrowth >= 0 ? 'up' : 'down' }}"></i> from last month
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <span class="text-muted fw-medium">Orders</span>
                        <span class="bg-purple-lt text-purple rounded-circle p-2"><i class="ti ti-shopping-cart"></i></span>
                    </div>
                    <div class="fw-bold display-6 mb-1">{{ $orders ?? 0 }}</div>
                    <div class="small fw-semibold {{ $ordersGrowth >= 0 ? 'text-success' : 'text-danger' }}">
                        {{ number_format(abs($ordersGrowth), 1) }}% 
                        <i class="ti ti-arrow-{{ $ordersGrowth >= 0 ? 'up' : 'down' }}"></i> from last month
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <span class="text-muted fw-medium">Total Products</span>
                        <span class="bg-purple-lt text-purple rounded-circle p-2"><i class="ti ti-box"></i></span>
                    </div>
                    <div class="fw-bold display-6 mb-1">{{ $products ?? 0 }}</div>
                    <div class="small fw-semibold {{ $productsGrowth >= 0 ? 'text-success' : 'text-danger' }}">
                        {{ number_format(abs($productsGrowth), 1) }}% 
                        <i class="ti ti-arrow-{{ $productsGrowth >= 0 ? 'up' : 'down' }}"></i> from last month
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <span class="text-muted fw-medium">Top Selling Products</span>
                        <span class="bg-purple-lt text-purple rounded-circle p-2"><i class="ti ti-star"></i></span>
                    </div>
                    <div class="fw-bold display-6 mb-1">{{ $topSellingProducts ?? 0 }}</div>
                    <div class="small fw-semibold text-muted">
                        Top performers this month
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Additional Metrics Card Row -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <span class="text-muted fw-medium">Total Expenses</span>
                        <span class="bg-red-lt text-danger rounded-circle p-2"><i class="ti ti-arrow-down"></i></span>
                    </div>
                    <div class="fw-bold display-6 mb-1">{{ Number::currency($totalExpenses ?? 0, 'XAF') }}</div>
                    <div class="small fw-semibold {{ $expensesGrowth >= 0 ? 'text-danger' : 'text-success' }}">
                        {{ number_format(abs($expensesGrowth), 1) }}% 
                        <i class="ti ti-arrow-{{ $expensesGrowth >= 0 ? 'up' : 'down' }}"></i> from last month
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <span class="text-muted fw-medium">Total Revenue</span>
                        <span class="bg-green-lt text-success rounded-circle p-2"><i class="ti ti-currency-dollar"></i></span>
                    </div>
                    <div class="fw-bold display-6 mb-1">{{ Number::currency($totalRevenue ?? 0, 'XAF') }}</div>
                    <div class="small fw-semibold {{ $revenueGrowth >= 0 ? 'text-success' : 'text-danger' }}">
                        {{ number_format(abs($revenueGrowth), 1) }}% 
                        <i class="ti ti-arrow-{{ $revenueGrowth >= 0 ? 'up' : 'down' }}"></i> from last month
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <span class="text-muted fw-medium">Average Sale</span>
                        <span class="bg-blue-lt text-primary rounded-circle p-2"><i class="ti ti-chart-bar"></i></span>
                    </div>
                    <div class="fw-bold display-6 mb-1">{{ Number::currency($averageSale ?? 0, 'XAF') }}</div>
                    <div class="small fw-semibold {{ $averageSaleGrowth >= 0 ? 'text-success' : 'text-danger' }}">
                        {{ number_format(abs($averageSaleGrowth), 1) }}% 
                        <i class="ti ti-arrow-{{ $averageSaleGrowth >= 0 ? 'up' : 'down' }}"></i> from last month
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <span class="text-muted fw-medium">Total Customers</span>
                        <span class="bg-yellow-lt text-warning rounded-circle p-2"><i class="ti ti-users"></i></span>
                    </div>
                    <div class="fw-bold display-6 mb-1">{{ $totalCustomers ?? 0 }}</div>
                    <div class="small fw-semibold {{ $customersGrowth >= 0 ? 'text-success' : 'text-danger' }}">
                        {{ number_format(abs($customersGrowth), 1) }}% 
                        <i class="ti ti-arrow-{{ $customersGrowth >= 0 ? 'up' : 'down' }}"></i> from last month
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-3 mb-3">
        <!-- Middle Row: Charts -->
        <div class="col-md-6">
            <x-card.index title="Product Categories">
                <div id="pieChart" style="height: 250px;"></div>
                <div class="text-center mt-2 small">
                    @foreach($productCategoryData['labels'] as $index => $label)
                        <span class="me-2">
                            <span class="badge bg-{{ ['primary', 'success', 'warning', 'danger', 'info', 'secondary'][$index % 6] }}"></span> 
                            {{ $label }}
                        </span>
                    @endforeach
                </div>
            </x-card.index>
        </div>
        <div class="col-md-6">
            <x-card.index title="Daily Sales Trend">
                <div id="lineChart" style="height: 250px;"></div>
                <div class="text-center mt-2 small">
                    @foreach($dailySalesData['labels'] as $day)
                        <span class="me-2">{{ $day }}</span>
                    @endforeach
                </div>
            </x-card.index>
        </div>
    </div>
    <div class="row g-3">
        <!-- Bottom Right Panel: Tables and Lists -->
        <div class="col-12">
            <x-card.index title="Recent Activity">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div>
                        <button class="btn btn-sm btn-outline-primary">Month</button>
                        <button class="btn btn-sm btn-outline-secondary">Year</button>
                    </div>
                    <div>
                        <div class="me-3">Revenue: <strong>{{ Number::currency($totalRevenue ?? 0, 'XAF') }}</strong></div>
                        <div>Expenses: <strong>{{ Number::currency($totalExpenses ?? 0, 'XAF') }}</strong></div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-sm mb-0">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Sales</th>
                                <th>Inventory</th>
                                <th>Expiry</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Product A</td>
                                <td>120</td>
                                <td>50</td>
                                <td>2025-12-31</td>
                            </tr>
                            <tr>
                                <td>Product B</td>
                                <td>80</td>
                                <td>30</td>
                                <td>2025-10-15</td>
                            </tr>
                            <tr>
                                <td>Product C</td>
                                <td>60</td>
                                <td>20</td>
                                <td>2025-08-20</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </x-card.index>
        </div>
    </div>
</div>
@endsection

@push('page-scripts')
<script src="{{ asset('dist/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Pie Chart for Product Categories
        var pieOptions = {
            chart: { type: 'pie', height: 250 },
            labels: @json($productCategoryData['labels']),
            series: @json($productCategoryData['data']),
            colors: ['#206bc4', '#28a745', '#ffc107', '#dc3545', '#0dcaf0', '#6c757d'],
            legend: { position: 'bottom' },
        };
        var pieChart = new ApexCharts(document.querySelector('#pieChart'), pieOptions);
        pieChart.render();

        // Line Chart for Daily Sales
        var lineOptions = {
            chart: { 
                type: 'line',
                height: 250,
                toolbar: {
                    show: false
                }
            },
            series: [{
                name: 'Daily Sales',
                data: @json($dailySalesData['data'])
            }],
            xaxis: {
                categories: @json($dailySalesData['labels'])
            },
            colors: ['#206bc4'],
            stroke: {
                curve: 'smooth',
                width: 3
            },
            markers: {
                size: 4
            },
            tooltip: {
                y: {
                    formatter: function(value) {
                        return 'FCFA ' + value.toLocaleString()
                    }
                }
            }
        };
        var lineChart = new ApexCharts(document.querySelector('#lineChart'), lineOptions);
        lineChart.render();
    });
</script>
@endpush
