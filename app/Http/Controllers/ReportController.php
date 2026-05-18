<?php

namespace App\Http\Controllers;

use App\Models\Transaction;

class ReportController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('items.product')
            ->latest()
            ->get();

        $totalSales = $transactions->sum('total');
        $totalTransaction = $transactions->count();

        return view('reports.index', compact(
            'transactions',
            'totalSales',
            'totalTransaction'
        ));
    }
}