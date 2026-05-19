<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $salesChart = Transaction::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(total) as total')
            )
            ->groupBy('date')
            ->orderBy('date')
            ->take(7)
            ->get();

        $recentTransactions = Transaction::latest()
            ->take(5)
            ->get();

        $lowStockList = Product::where('stock', '<=', 5)
            ->orderBy('stock')
            ->take(5)
            ->get();

        $bestSellingProducts = TransactionItem::select(
                'product_id',
                DB::raw('SUM(qty) as total_qty')
            )
            ->with('product')
            ->groupBy('product_id')
            ->orderByDesc('total_qty')
            ->take(5)
            ->get();

        $almostExpiredProducts = Product::whereNotNull('expired_date')
            ->whereDate('expired_date', '<=', now()->addDays(30))
            ->orderBy('expired_date')
            ->take(5)
            ->get();

        return view('dashboard', [
            'todaySales' => Transaction::whereDate('created_at', today())->sum('total'),
            'todayProfit' => TransactionItem::whereDate('created_at', today())->sum('profit'),
            'totalProducts' => Product::count(),
            'totalTransactions' => Transaction::whereDate('created_at', today())->count(),
            'lowStockProducts' => Product::where('stock', '<=', 5)->count(),
            'salesChart' => $salesChart,
            'recentTransactions' => $recentTransactions,
            'lowStockList' => $lowStockList,
            'bestSellingProducts' => $bestSellingProducts,
            'almostExpiredProducts' => $almostExpiredProducts,
        ]);
    }
}