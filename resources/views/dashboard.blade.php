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
                    <div class="fw-bold display-6 mb-1">{{ $totalSales ?? 'FCFA 0' }}</div>
                    <div class="text-success small fw-semibold">100% <i class="ti ti-arrow-up"></i> from last month</div>
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
                    <div class="fw-bold display-6 mb-1">{{ $orders ?? '0' }}</div>
                    <div class="text-success small fw-semibold">0% <i class="ti ti-arrow-up"></i> from last month</div>
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
                    <div class="fw-bold display-6 mb-1">{{ $totalProducts ?? '0' }}</div>
                    <div class="text-success small fw-semibold">0% <i class="ti ti-arrow-up"></i> from last month</div>
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
                    <div class="fw-bold display-6 mb-1">{{ $topSellingProducts ?? '0' }}</div>
                    <div class="text-success small fw-semibold">0% <i class="ti ti-arrow-up"></i> from last month</div>
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
                    <div class="fw-bold display-6 mb-1">{{ $totalExpenses ?? '0' }}</div>
                    <div class="text-danger small fw-semibold">0% <i class="ti ti-arrow-down"></i> from last month</div>
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
                    <div class="fw-bold display-6 mb-1">{{ $totalRevenue ?? '0' }}</div>
                    <div class="text-success small fw-semibold">0% <i class="ti ti-arrow-up"></i> from last month</div>
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
                    <div class="fw-bold display-6 mb-1">{{ $averageSale ?? '0' }}</div>
                    <div class="text-success small fw-semibold">0% <i class="ti ti-arrow-up"></i> from last month</div>
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
                    <div class="fw-bold display-6 mb-1">{{ $totalCustomers ?? '0' }}</div>
                    <div class="text-success small fw-semibold">0% <i class="ti ti-arrow-up"></i> from last month</div>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-3 mb-3">
        <!-- Middle Row: Charts -->
        <div class="col-md-6">
            <x-card.index title="Product Analysis">
                <div id="pieChart" style="height: 250px;"></div>
                <div class="text-center mt-2 small">
                    <span class="me-2"><span class="badge bg-primary"></span> Click</span>
                    <span class="me-2"><span class="badge bg-success"></span> Active</span>
                    <span class="me-2"><span class="badge bg-warning"></span> Not Recognized</span>
                    <span class="me-2"><span class="badge bg-danger"></span> Bot Activity</span>
                </div>
            </x-card.index>
        </div>
        <div class="col-md-6">
            <x-card.index title="Shopping Status">
                <div id="lineChart" style="height: 250px;"></div>
                <div class="text-center mt-2 small">
                    <span class="me-2">Mon</span>
                    <span class="me-2">Tue</span>
                    <span class="me-2">Wed</span>
                    <span class="me-2">Thu</span>
                    <span class="me-2">Fri</span>
                    <span class="me-2">Sat</span>
                    <span class="me-2">Sun</span>
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
                        <div class="me-3">Revenue: <strong>FCFA 12,345</strong></div>
                        <div>Expenses: <strong>FCFA 6,789</strong></div>
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
        // Pie Chart
        var pieOptions = {
            chart: { type: 'pie', height: 250 },
            labels: ['Click', 'Active', 'Not Recognized', 'Bot Activity'],
            series: [35, 45, 10, 10],
            colors: ['#206bc4', '#28a745', '#ffc107', '#dc3545'],
            legend: { position: 'bottom' },
        };
        var pieChart = new ApexCharts(document.querySelector('#pieChart'), pieOptions);
        pieChart.render();

        // Line Chart
        var lineOptions = {
            chart: { type: 'line', height: 250 },
            series: [{
                name: 'Shopping Status',
                data: [10, 20, 15, 30, 25, 40, 35]
            }],
            xaxis: {
                categories: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
            },
            colors: ['#206bc4'],
        };
        var lineChart = new ApexCharts(document.querySelector('#lineChart'), lineOptions);
        lineChart.render();
    });
</script>
@endpush
