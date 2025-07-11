<?php

namespace App\Http\Controllers\Dashboards;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Quotation;
use App\Models\Expense;
use App\Models\Customer;
use App\Models\Invoice;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $orders = Order::count();
        $completedOrders = Order::where('order_status', OrderStatus::COMPLETE)
            ->count();

        $products = Product::count();

        $purchases = Purchase::count();
        $todayPurchases = Purchase::query()
            ->where('date', today())
            ->get()
            ->count();

        $categories = Category::count();

        $quotations = Quotation::count();
        $todayQuotations = Quotation::query()
            ->where('date', today()->format('Y-m-d'))
            ->get()
            ->count();

        // Calculate total expenses for the last month
        $totalExpenses = Expense::whereBetween('expense_date', [now()->subMonth(), now()])
            ->sum('amount');

        // Calculate the date range for the last 30 days
        $endDate = now();
        $startDate = now()->copy()->subDays(30);

        // Format as '14th Feb' etc.
        $dateRange = $startDate->format('jS M') . ' to ' . $endDate->format('jS M');

        // Example: Get top 3 selling products (adjust logic as needed)
        $topProducts = Product::withSum('orderDetails as total_sales', 'quantity')
            ->orderByDesc('total_sales')
            ->take(3)
            ->get();


        return view('dashboard', [
            'products' => $products,
            'orders' => $orders,
            'completedOrders' => $completedOrders,
            'purchases' => $purchases,
            'todayPurchases' => $todayPurchases,
            'categories' => $categories,
            'quotations' => $quotations,
            'todayQuotations' => $todayQuotations,
            'dateRange' => $dateRange,
            'totalExpenses' => number_format($totalExpenses, 2),
            'topProducts' => $topProducts,
        ]);
    }
    public function Charts() {
        

    }

    /*public function search(Request $request)
    {
        $q = $request->input('q');
        $products = Product::where('name', 'like', "%$q%")->limit(5)->get();
        $orders = Order::where('invoice_no', 'like', "%$q%")->orWhere('id', $q)->limit(5)->get();
        $customers = Customer::where('name', 'like', "%$q%")
            ->orWhere('email', 'like', "%$q%")
            ->orWhere('phone', 'like', "%$q%")
            ->limit(5)->get();

        return view('dashboard.search-results', compact('products', 'orders', 'customers'))->render(); 
    }*/
}
