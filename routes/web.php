<?php

use App\Http\Controllers\BackupController;
use App\Http\Controllers\CustomerOrderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StockMovementController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/dashboard');
Route::get('/shop', [ProductController::class, 'shop'])->name('shop');
Route::post('/shop/order', [CustomerOrderController::class, 'store'])
    ->name('shop.order');
Route::get('/shop/order-status', [CustomerOrderController::class, 'status'])
    ->name('shop.order-status');
Route::post('/shop/checkout', [CustomerOrderController::class, 'checkout'])
    ->name('shop.checkout');
        
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/pos', [PosController::class, 'index'])->name('pos.index');
    Route::post('/checkout', [PosController::class, 'checkout'])->name('pos.checkout');

    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('/products', ProductController::class)->except(['show']);

    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/export', [ReportController::class, 'export'])->name('reports.export');
    Route::resource('/users', UserController::class);
    Route::get('/transactions/{transaction}', [TransactionController::class, 'show'])
    ->name('transactions.show');
    Route::post('/products/{product}/restock', [ProductController::class, 'restock'])
    ->name('products.restock');
    Route::get('/stock-movements', [StockMovementController::class, 'index'])
    ->name('stock-movements.index');
    Route::get('/expired-products', [ProductController::class, 'expired'])
    ->name('products.expired');
    Route::get('/reports/pdf', [ReportController::class, 'pdf'])
    ->name('reports.pdf');

    Route::get('/backup/download', [BackupController::class, 'download'])
    ->name('backup.download');
    Route::get('/customer-orders', [CustomerOrderController::class, 'index'])
    ->name('customer-orders.index');
    Route::post('/customer-orders/{order}/confirm', [CustomerOrderController::class, 'confirm'])
    ->name('customer-orders.confirm');
    Route::post('/customer-orders/{order}/reject', [CustomerOrderController::class, 'reject'])
    ->name('customer-orders.reject');


});

require __DIR__.'/auth.php';