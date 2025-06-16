<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>{{ config('app.name') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />

    <!-- CSS files -->
    <link href="{{ asset('dist/css/tabler.min.css') }}" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://rsms.me/inter/inter.css');
        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }
        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>

    <!-- Custom CSS for specific page.  -->
    @stack('page-styles')
    @livewireStyles
</head>
    <body>

        <div class="page">

            @include('layouts.body.header')

            <div class="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <!-- Sidebar -->
                        <div class="col-md-2 bg-white min-vh-100 px-0 border-end sidebar-menu-custom">
                            <nav class="nav flex-column nav-pills gap-1 pt-4">
                                <a class="nav-link d-flex align-items-center px-4 py-3 fw-semibold {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                                    <i class="ti ti-home me-3 fs-5"></i> Dashboard
                                </a>
                                <a class="nav-link d-flex align-items-center px-4 py-3 fw-semibold {{ request()->routeIs('products.*') ? 'active' : '' }}" href="{{ route('products.index') }}">
                                    <i class="ti ti-box me-3 fs-5"></i> Products
                                </a>
                                <a class="nav-link d-flex align-items-center px-4 py-3 fw-semibold {{ request()->routeIs('customers.*') ? 'active' : '' }}" href="{{ route('customers.index') }}">
                                    <i class="ti ti-users me-3 fs-5"></i> Customers
                                </a>
                                <div class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle d-flex align-items-center px-4 py-3 fw-semibold" data-bs-toggle="dropdown" href="#">
                                        <i class="ti ti-archive me-3 fs-5"></i> Inventory
                                    </a>
                                    <div class="dropdown-menu ps-4">
                                        <a class="dropdown-item py-2" href="{{ route('products.index') }}"><i class="ti ti-list me-2"></i> Stock List</a>
                                        <a class="dropdown-item py-2" href="{{ route('suppliers.index') }}"><i class="ti ti-truck me-2"></i> Suppliers</a>
                                        <a class="dropdown-item py-2" href="#"><i class="ti ti-rotate me-2"></i> Returns</a>
                                    </div>
                                </div>
                                <a class="nav-link d-flex align-items-center px-4 py-3 fw-semibold {{ request()->routeIs('orders.*') ? 'active' : '' }}" href="{{ route('orders.index') }}">
                                    <i class="ti ti-point me-3 fs-5"></i> Point of Sale
                                </a>
                                <div class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle d-flex align-items-center px-4 py-3 fw-semibold" data-bs-toggle="dropdown" href="#">
                                        <i class="ti ti-report me-3 fs-5"></i> Reports
                                    </a>
                                    <div class="dropdown-menu ps-4">
                                        <a class="dropdown-item py-2" href="#"><i class="ti ti-chart-bar me-2"></i> Sales Report</a>
                                        <a class="dropdown-item py-2" href="#"><i class="ti ti-chart-pie me-2"></i> Inventory Reports</a>
                                        <a class="dropdown-item py-2" href="#"><i class="ti ti-users-group me-2"></i> Customers Reports</a>
                                    </div>
                                </div>
                                <div class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle d-flex align-items-center px-4 py-3 fw-semibold" data-bs-toggle="dropdown" href="#">
                                        <i class="ti ti-credit-card me-3 fs-5"></i> Accounts
                                    </a>
                                    <div class="dropdown-menu ps-4">
                                        <a class="dropdown-item py-2" href="#"><i class="ti ti-cash me-2"></i> Expenses</a>
                                        <a class="dropdown-item py-2" href="{{ route('quotations.index') }}"><i class="ti ti-file-invoice me-2"></i> Invoices</a>
                                    </div>
                                </div>
                                <div class="nav-item dropdown mt-2">
                                    <a class="nav-link dropdown-toggle d-flex align-items-center px-4 py-3 fw-semibold" data-bs-toggle="dropdown" href="#">
                                        <i class="ti ti-settings me-3 fs-5"></i> Settings
                                    </a>
                                    <div class="dropdown-menu ps-4">
                                        <a class="dropdown-item py-2" href="#"><i class="ti ti-sliders me-2"></i> General Settings</a>
                                        <a class="dropdown-item py-2" href="{{ route('admin.users.index') }}"><i class="ti ti-user-cog me-2"></i> Users</a>
                                        <a class="dropdown-item py-2" href="{{ route('admin.roles.index') }}"><i class="ti ti-id me-2"></i> Roles</a>
                                        <a class="dropdown-item py-2" href="#"><i class="ti ti-bell me-2"></i> Notification Settings</a>
                                    </div>
                                </div>
                            </nav>
                        </div>
                        <!-- Main Content -->
                        <div class="col-md-10 px-0">
                            @yield('content')
                        </div>
                    </div>
                </div>
                @include('layouts.body.footer')
            </div>
        </div>

        <!-- Tabler Core -->
        <script src="{{ asset('dist/js/tabler.min.js') }}" defer></script>
        {{--- Page Scripts ---}}
        @stack('page-scripts')

        @livewireScripts
    </body>
</html>
