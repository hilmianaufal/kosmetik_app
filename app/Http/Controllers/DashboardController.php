<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
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
        return view('dashboard', [
            'todaySales' => Transaction::whereDate('created_at', today())->sum('total'),
            'totalProducts' => Product::count(),
            'totalTransactions' => Transaction::whereDate('created_at', today())->count(),
            'lowStockProducts' => Product::where('stock', '<=', 5)->count(),
            'salesChart' => $salesChart,
        ]);
    }
}