<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\Order\DueOrderController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Purchase\PurchaseController;
use App\Http\Controllers\Order\OrderPendingController;
use App\Http\Controllers\Order\OrderCompleteController;
use App\Http\Controllers\Quotation\QuotationController;
use App\Http\Controllers\Dashboards\DashboardController;
use App\Http\Controllers\Product\ProductExportController;
use App\Http\Controllers\Product\ProductImportController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\SettingsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('php/', function () {
    return phpinfo();
});

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/search', [DashboardController::class, 'search'])->name('dashboard.search');

    // Admin Routes
    Route::middleware(['auth', 'role:Administrator'])->prefix('admin')->name('admin.')->group(function () {
        Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
        Route::resource('roles', \App\Http\Controllers\Admin\RoleController::class);
    });

    // User Management
    Route::resource('/users', UserController::class); //->except(['show']);
    Route::put('/user/change-password/{username}', [UserController::class, 'updatePassword'])->name('users.updatePassword');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/settings', [ProfileController::class, 'settings'])->name('profile.settings');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/quotations', QuotationController::class);
    Route::resource('/customers', CustomerController::class);
    Route::resource('/suppliers', SupplierController::class);
    Route::resource('/categories', CategoryController::class);
    Route::resource('/units', UnitController::class);

    // Route Products
    Route::get('/products/import', [ProductImportController::class, 'create'])->name('products.import.view');
    Route::post('/products/import', [ProductImportController::class, 'store'])->name('products.import.store');
    Route::get('/products/export', [ProductExportController::class, 'create'])->name('products.export.store');
    Route::resource('/products', ProductController::class);

    // Route Orders
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/pending', OrderPendingController::class)->name('orders.pending');
    Route::get('/orders/complete', OrderCompleteController::class)->name('orders.complete');

    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders/store', [OrderController::class, 'store'])->name('orders.store');

    Route::post('/invoice/create', [InvoiceController::class, 'create'])->name('invoice.create');

    // SHOW ORDER
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::put('/orders/update/{order}', [OrderController::class, 'update'])->name('orders.update');

    // DUES
    Route::get('/due/orders/', [DueOrderController::class, 'index'])->name('due.index');
    Route::get('/due/order/view/{order}', [DueOrderController::class, 'show'])->name('due.show');
    Route::get('/due/order/edit/{order}', [DueOrderController::class, 'edit'])->name('due.edit');
    Route::put('/due/order/update/{order}', [DueOrderController::class, 'update'])->name('due.update');

    // TODO: Remove from OrderController
    Route::get('/orders/details/{order_id}/download', [OrderController::class, 'downloadInvoice'])->name('order.downloadInvoice');

    // Route Purchases
    Route::get('/purchases/approved', [PurchaseController::class, 'approvedPurchases'])->name('purchases.approvedPurchases');
    Route::get('/purchases/report', [PurchaseController::class, 'dailyPurchaseReport'])->name('purchases.dailyPurchaseReport');
    Route::get('/purchases/report/export', [PurchaseController::class, 'getPurchaseReport'])->name('purchases.getPurchaseReport');
    Route::post('/purchases/report/export', [PurchaseController::class, 'exportPurchaseReport'])->name('purchases.exportPurchaseReport');

    Route::get('/purchases', [PurchaseController::class, 'index'])->name('purchases.index');
    Route::get('/purchases/create', [PurchaseController::class, 'create'])->name('purchases.create');
    Route::post('/purchases', [PurchaseController::class, 'store'])->name('purchases.store');

    Route::get('/purchases/{purchase}', [PurchaseController::class, 'show'])->name('purchases.show');
    Route::get('/purchases/{purchase}/edit', [PurchaseController::class, 'edit'])->name('purchases.edit');
    Route::put('/purchases/{purchase}/edit', [PurchaseController::class, 'update'])->name('purchases.update');
    Route::delete('/purchases/{purchase}', [PurchaseController::class, 'destroy'])->name('purchases.delete');

    // Sales Report
    Route::get('/sales/report', [SalesController::class, 'report'])->name('sales.report');
    Route::get('/sales/report/export/pdf', [SalesController::class, 'exportPdf'])->name('sales.report.export.pdf');

    // Invoice Report
    Route::get('/invoices/report', [InvoiceController::class, 'report'])->name('invoices.report');
    Route::get('/invoices/report/export/pdf', [InvoiceController::class, 'exportPdf'])->name('invoices.report.export.pdf');

    // Expenses Routes
    Route::prefix('expenses')->group(function () {
        // Basic CRUD routes
        Route::get('/', [ExpenseController::class, 'index'])->name('expenses.index');
        Route::get('/create', [ExpenseController::class, 'create'])->name('expenses.create');
        Route::post('/', [ExpenseController::class, 'store'])->name('expenses.store');
        Route::get('/{expense}', [ExpenseController::class, 'show'])->name('expenses.show');
        Route::get('/{expense}/edit', [ExpenseController::class, 'edit'])->name('expenses.edit');
        Route::put('/{expense}', [ExpenseController::class, 'update'])->name('expenses.update');
        Route::delete('/{expense}', [ExpenseController::class, 'destroy'])->name('expenses.destroy');

        // Report routes
        Route::get('/report/daily', [ExpenseController::class, 'dailyReport'])->name('expenses.report.daily');
        Route::get('/report/monthly', [ExpenseController::class, 'monthlyReport'])->name('expenses.report.monthly');
        Route::get('/report/yearly', [ExpenseController::class, 'yearlyReport'])->name('expenses.report.yearly');
        Route::get('/report/custom', [ExpenseController::class, 'customReport'])->name('expenses.report.custom');
        
        // Export routes
        Route::get('/report/export/pdf', [ExpenseController::class, 'exportPdf'])->name('expenses.report.export.pdf');
        Route::get('/report/export/excel', [ExpenseController::class, 'exportExcel'])->name('expenses.report.export.excel');
        
        // Approval routes
        Route::put('/{expense}/approve', [ExpenseController::class, 'approve'])->name('expenses.approve');
        Route::put('/{expense}/reject', [ExpenseController::class, 'reject'])->name('expenses.reject');
        
        // Category routes
        Route::get('/categories', [ExpenseController::class, 'categories'])->name('expenses.categories');
        Route::post('/categories', [ExpenseController::class, 'storeCategory'])->name('expenses.categories.store');
        Route::put('/categories/{category}', [ExpenseController::class, 'updateCategory'])->name('expenses.categories.update');
        Route::delete('/categories/{category}', [ExpenseController::class, 'destroyCategory'])->name('expenses.categories.destroy');
    });

    // General Settings
    Route::get('/settings', [SettingsController::class, 'edit'])->name('settings.edit');
    Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');
});

require __DIR__.'/auth.php';

Route::get('test/', function (){
//    return view('test');
    return view('orders.create');
});
