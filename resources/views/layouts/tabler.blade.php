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
        
        /* SIDEBAR STYLES - UPDATED 2024 */
        /* Force sidebar link colors with maximum specificity */
        .page .page-wrapper .container-fluid .row .sidebar-menu-custom .nav-link,
        .sidebar-menu-custom .nav-link {
            color: #000000 !important;
            font-weight: 700 !important;
            transition: all 0.3s ease !important;
        }

        .page .page-wrapper .container-fluid .row .sidebar-menu-custom .nav-link i,
        .sidebar-menu-custom .nav-link i {
            color: #000000 !important;
        }

        /* Active state */
        .page .page-wrapper .container-fluid .row .sidebar-menu-custom .nav-link.active,
        .sidebar-menu-custom .nav-link.active {
            background: #ed1f29 !important;
            color: #ffffff !important;
            border-radius: 8px !important;
            margin: 0 8px !important;
        }

        .page .page-wrapper .container-fluid .row .sidebar-menu-custom .nav-link.active i,
        .sidebar-menu-custom .nav-link.active i {
            color: #ffffff !important;
        }

        /* Hover state */
        .page .page-wrapper .container-fluid .row .sidebar-menu-custom .nav-link:hover,
        .sidebar-menu-custom .nav-link:hover {
            background: #ed1f29 !important;
            color: #ffffff !important;
            border-radius: 8px !important;
            margin: 0 8px !important;
            transform: translateX(5px) !important;
        }

        .page .page-wrapper .container-fluid .row .sidebar-menu-custom .nav-link:hover i,
        .sidebar-menu-custom .nav-link:hover i {
            color: #ffffff !important;
        }

        /* Dropdown items */
        .page .page-wrapper .container-fluid .row .sidebar-menu-custom .dropdown-item,
        .sidebar-menu-custom .dropdown-item {
            color: #000000 !important;
            font-weight: 600 !important;
        }

        .page .page-wrapper .container-fluid .row .sidebar-menu-custom .dropdown-item:hover,
        .sidebar-menu-custom .dropdown-item:hover {
            background: #ed1f29 !important;
            color: #ffffff !important;
            border-radius: 4px !important;
        }

        .page .page-wrapper .container-fluid .row .sidebar-menu-custom .dropdown-item:hover i,
        .sidebar-menu-custom .dropdown-item:hover i {
            color: #ffffff !important;
        }

        /* Header and Logo Styles */
        .navbar {
            background: linear-gradient(135deg, #58a1b8 0%, #4a90a8 100%) !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-bottom: 2px solid #ed1f29;
        }

        .navbar-brand {
            padding: 10px 0;
            transition: all 0.3s ease;
        }

        .navbar-brand:hover {
            transform: scale(1.05);
        }

        .navbar-brand-image {
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
            transition: all 0.3s ease;
        }

        .navbar-brand-image:hover {
            filter: drop-shadow(0 4px 8px rgba(0,0,0,0.3));
        }

        /* User menu styles */
        .nav-item.dropdown .nav-link {
            color: #fff !important;
            font-weight: 500;
        }

        .nav-item.dropdown .nav-link:hover {
            color: #ed1f29 !important;
        }

        .avatar {
            border: 2px solid #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

    </style>

    <!-- Custom CSS for specific page.  -->
    @stack('page-styles')
    @livewireStyles

    <!-- Tabler Icons CDN -->
    <script src="https://kit.fontawesome.com/bdd56f4c49.js" crossorigin="anonymous"></script>
    <!--<link href="https://unpkg.com/@tabler/icons@latest/iconfont/tabler-icons.min.css" rel="stylesheet">-->
</head>
    <body>

        <div class="page">

            @include('layouts.body.header')

            <div class="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <!-- Sidebar -->
                        <div class="col-md-2 d-none d-md-block bg-in min-vh-100 px-0 border-end sidebar-menu-custom" style="background:#58a1b8;">
                            <nav class="nav flex-column nav-pills gap-1 pt-4">
                                <a class="nav-link d-flex align-items-center px-4 py-3 fw-semibold {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                                    <i class="ti ti-home me-3 fs-5 fa-solid fa-house"></i>
                                    <span class="d-none d-md-inline ">
                                        Dashboard</span>
                                </a>
                                <a class="nav-link d-flex align-items-center px-4 py-3 fw-semibold {{ request()->routeIs('products.*') ? 'active' : '' }}" href="{{ route('products.index') }}">
                                    <i class="ti ti-box me-3 fs-5 fa-solid fa-box"></i>
                                    <span class="d-none d-md-inline">
                                        Products</span>
                                </a>
                               <!--<a class="nav-link d-flex align-items-center px-4 py-3 fw-semibold {{ request()->routeIs('customers.*') ? 'active' : '' }}" href="{{ route('customers.index') }}">
                                    <i class="ti ti-users me-3 fs-5 fa-solid fa-users"></i>
                                    <span class="d-none d-md-inline">
                                        Customers</span> -->
                                </a>
                                <div class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle d-flex align-items-center px-4 py-3 fw-semibold" data-bs-toggle="dropdown" href="#">
                                        <i class="ti ti-archive me-3 fs-5 fa-solid fa-chart-simple"></i>
                                        <span class="d-none d-md-inline">
                                            Inventory</span>
                                    </a>
                                    <div class="dropdown-menu ps-4">
                                        <a class="dropdown-item py-2" href="{{ route('products.index') }}"><i class="ti ti-list me-2 fa-solid fa-list"></i> Stock List</a>
                                        <a class="dropdown-item py-2" href="{{ route('suppliers.index') }}"><i class="ti ti-truck me-2 fa-solid fa-truck "></i> Suppliers</a>
                                        <!--<a class="dropdown-item py-2" href="#"><i class="ti ti-rotate me-2 fa-solid fa-rotate"></i> Returns</a> -->
                                    </div>
                                </div>
                                <a class="nav-link d-flex align-items-center px-4 py-3 fw-semibold {{ request()->routeIs('orders.*') ? 'active' : '' }}" href="{{ route('orders.index') }}">
                                    <i class="ti ti-point me-3 fs-5 fa-solid fa-cash-register"></i>
                                    <span class="d-none d-md-inline">
                                        Point of Sale</span>
                                </a>
                                <div class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle d-flex align-items-center px-4 py-3 fw-semibold" data-bs-toggle="dropdown" href="#">
                                        <i class="ti ti-report me-3 fs-5 fa-solid fa-chart-simple"></i>
                                        <span class="d-none d-md-inline">
                                            Reports</span>
                                    </a>
                                    <div class="dropdown-menu ps-4">
                                        <a class="dropdown-item py-2" href="{{ route('sales.report') }}">
                                            <i class="ti ti-chart-bar me-2 fa-solid fa-chart-simple"></i> Sales Report
                                        </a>
                                        <a class="dropdown-item py-2" href="{{ route('invoices.report') }}">
                                            <i class="ti ti-file-invoice me-2 fa-solid fa-file-invoice"></i> Invoice Report
                                        </a>
                                        <!--<a class="dropdown-item py-2" href="#"><i class="ti ti-users-group me-2 fa-solid fa-users"></i> Customers Reports</a> -->
                                    </div>
                                </div>
                                <div class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle d-flex align-items-center px-4 py-3 fw-semibold" data-bs-toggle="dropdown" href="#">
                                        <i class="ti ti-credit-card me-3 fs-5 fa-solid fa-money-bill"></i>
                                        <span class="d-none d-md-inline">
                                            Accounts</span>
                                    </a>
                                    <div class="dropdown-menu ps-4">
                                        <a class="dropdown-item py-2" href="{{ route('expenses.index') }}"><i class="ti ti-cash me-2 fa-solid fa-cash-register"></i> Expenses</a>
                                        <a class="dropdown-item py-2" href="{{ route('quotations.index') }}"><i class="ti ti-file-invoice me-2 fa-solid fa-file-invoice"></i> Invoices</a>
                                    </div>
                                </div>
                                <div class="nav-item dropdown mt-2">
                                    <a class="nav-link dropdown-toggle d-flex align-items-center px-4 py-3 fw-semibold" data-bs-toggle="dropdown" href="#">
                                        <i class="ti ti-settings me-3 fs-5 fa-solid fa-gears"></i>
                                        <span class="d-none d-md-inline">
                                            Settings</span>
                                    </a>
                                    <div class="dropdown-menu ps-4">
                                        <a class="dropdown-item py-2" href="{{ route('settings.edit') }}"><i class="fa-solid fa-gears me-2"></i> General Settings</a>
                                        <a class="dropdown-item py-2" href="{{ route('admin.users.index') }}"><i class="ti ti-user-cog me-2 fa-solid fa-user-cog"></i> Users</a>
                                        <a class="dropdown-item py-2" href="{{ route('admin.roles.index') }}"><i class="ti ti-id me-2 fa-solid fa-id-card"></i> Roles</a>
                                        <!--<a class="dropdown-item py-2" href="#"><i class="ti ti-bell me-2 fa-solid fa-bell"></i> Notification Settings</a> -->
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
