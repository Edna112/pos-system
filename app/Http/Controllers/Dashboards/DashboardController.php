<?php

namespace App\Http\Controllers\Dashboards;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Quotation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Cache duration - 15 minutes
        $cacheDuration = 900;

        // Get current and last month dates
        $currentMonth = Carbon::now()->startOfMonth();
        $lastMonth = Carbon::now()->subMonth()->startOfMonth();

        // Calculate total sales and comparison with last month
        $totalSales = Cache::remember('total_sales', $cacheDuration, function () use ($currentMonth) {
            return Order::where('order_status', OrderStatus::COMPLETE)
                ->whereMonth('order_date', $currentMonth->month)
                ->sum('total');
        });

        $lastMonthSales = Cache::remember('last_month_sales', $cacheDuration, function () use ($lastMonth) {
            return Order::where('order_status', OrderStatus::COMPLETE)
                ->whereMonth('order_date', $lastMonth->month)
                ->sum('total');
        });

        $salesGrowth = $lastMonthSales > 0 ? (($totalSales - $lastMonthSales) / $lastMonthSales) * 100 : 100;

        // Calculate orders metrics
        $orders = Cache::remember('orders_count', $cacheDuration, function () use ($currentMonth) {
            return Order::whereMonth('order_date', $currentMonth->month)->count();
        });

        $lastMonthOrders = Cache::remember('last_month_orders', $cacheDuration, function () use ($lastMonth) {
            return Order::whereMonth('order_date', $lastMonth->month)->count();
        });

        $ordersGrowth = $lastMonthOrders > 0 ? (($orders - $lastMonthOrders) / $lastMonthOrders) * 100 : 100;

        // Calculate products metrics
        $products = Cache::remember('products_count', $cacheDuration, function () {
            return Product::where('status', true)->count();
        });

        $lastMonthProducts = Cache::remember('last_month_products', $cacheDuration, function () use ($lastMonth) {
            return Product::where('status', true)
                ->where('created_at', '<', $lastMonth->endOfMonth())
                ->count();
        });

        $productsGrowth = $lastMonthProducts > 0 ? (($products - $lastMonthProducts) / $lastMonthProducts) * 100 : 100;

        // Calculate top selling products
        $topSellingProducts = Cache::remember('top_selling_products', $cacheDuration, function () use ($currentMonth) {
            return DB::table('order_details')
                ->join('orders', 'orders.id', '=', 'order_details.order_id')
                ->where('orders.order_status', OrderStatus::COMPLETE)
                ->whereMonth('orders.order_date', $currentMonth->month)
                ->select('product_id', DB::raw('SUM(quantity) as total_quantity'))
                ->groupBy('product_id')
                ->orderByRaw('SUM(quantity) DESC')
                ->limit(5)
                ->count();
        });

        // Calculate expenses (from purchases)
        $totalExpenses = Cache::remember('total_expenses', $cacheDuration, function () use ($currentMonth) {
            return Purchase::whereMonth('date', $currentMonth->month)->sum('total_amount');
        });

        $lastMonthExpenses = Cache::remember('last_month_expenses', $cacheDuration, function () use ($lastMonth) {
            return Purchase::whereMonth('date', $lastMonth->month)->sum('total_amount');
        });

        $expensesGrowth = $lastMonthExpenses > 0 ? (($totalExpenses - $lastMonthExpenses) / $lastMonthExpenses) * 100 : 100;

        // Calculate total revenue (sales - expenses)
        $totalRevenue = $totalSales - $totalExpenses;
        $lastMonthRevenue = $lastMonthSales - $lastMonthExpenses;
        $revenueGrowth = $lastMonthRevenue > 0 ? (($totalRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100 : 100;

        // Calculate average sale
        $completedOrders = Order::where('order_status', OrderStatus::COMPLETE)
            ->whereMonth('order_date', $currentMonth->month)
            ->count();
        $averageSale = $completedOrders > 0 ? $totalSales / $completedOrders : 0;

        $lastMonthCompletedOrders = Order::where('order_status', OrderStatus::COMPLETE)
            ->whereMonth('order_date', $lastMonth->month)
            ->count();
        $lastMonthAverageSale = $lastMonthCompletedOrders > 0 ? $lastMonthSales / $lastMonthCompletedOrders : 0;

        $averageSaleGrowth = $lastMonthAverageSale > 0 ? (($averageSale - $lastMonthAverageSale) / $lastMonthAverageSale) * 100 : 100;

        // Calculate total customers
        $totalCustomers = Cache::remember('total_customers', $cacheDuration, function () use ($currentMonth) {
            return Customer::whereMonth('created_at', $currentMonth->month)->count();
        });

        $lastMonthCustomers = Cache::remember('last_month_customers', $cacheDuration, function () use ($lastMonth) {
            return Customer::whereMonth('created_at', $lastMonth->month)->count();
        });

        $customersGrowth = $lastMonthCustomers > 0 ? (($totalCustomers - $lastMonthCustomers) / $lastMonthCustomers) * 100 : 100;

        // Get chart data
        $dailySalesData = $this->getDailySalesData();
        $productCategoryData = $this->getProductCategoryData();

        return view('dashboard', compact(
            'totalSales',
            'salesGrowth',
            'orders',
            'ordersGrowth',
            'products',
            'productsGrowth',
            'topSellingProducts',
            'totalExpenses',
            'expensesGrowth',
            'totalRevenue',
            'revenueGrowth',
            'averageSale',
            'averageSaleGrowth',
            'totalCustomers',
            'customersGrowth',
            'dailySalesData',
            'productCategoryData'
        ));
    }

    private function getDailySalesData()
    {
        return Cache::remember('daily_sales_data', 900, function () {
            $days = collect(range(0, 6))->map(function ($day) {
                $date = Carbon::now()->subDays($day);
                return [
                    'day' => $date->format('D'),
                    'sales' => Order::where('order_status', OrderStatus::COMPLETE)
                        ->whereDate('order_date', $date)
                        ->sum('total')
                ];
            })->reverse()->values();

            return [
                'labels' => $days->pluck('day'),
                'data' => $days->pluck('sales')
            ];
        });
    }

    private function getProductCategoryData()
    {
        return Cache::remember('product_category_data', 900, function () {
            $categories = Category::withCount('products')->get();
            return [
                'labels' => $categories->pluck('name'),
                'data' => $categories->pluck('products_count')
            ];
        });
    }
}
