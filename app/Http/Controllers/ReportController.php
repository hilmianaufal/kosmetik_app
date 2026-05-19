<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionItem;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
        public function index()
        {
            $query = Transaction::with('items.product')->latest();

            if (request('start_date')) {
                $query->whereDate('created_at', '>=', request('start_date'));
            }

            if (request('end_date')) {
                $query->whereDate('created_at', '<=', request('end_date'));
            }

            $transactions = $query->get();

            $totalSales = $transactions->sum('total');
            $totalTransaction = $transactions->count();
            $totalProfit = $transactions->flatMap->items->sum('profit');

            $bestSellingQuery = TransactionItem::select(
                    'product_id',
                    DB::raw('SUM(qty) as total_qty'),
                    DB::raw('SUM(profit) as total_profit')
                )
                ->with('product')
                ->groupBy('product_id')
                ->orderByDesc('total_qty');

            if (request('start_date')) {
                $bestSellingQuery->whereDate('created_at', '>=', request('start_date'));
            }

            if (request('end_date')) {
                $bestSellingQuery->whereDate('created_at', '<=', request('end_date'));
            }

            $bestSellingProducts = $bestSellingQuery->take(10)->get();

            return view('reports.index', compact(
                'transactions',
                'totalSales',
                'totalTransaction',
                'totalProfit',
                'bestSellingProducts'
            ));
        }

        public function export()
        {
            $query = Transaction::with('items.product')->latest();

            if (request('start_date')) {
                $query->whereDate('created_at', '>=', request('start_date'));
            }

            if (request('end_date')) {
                $query->whereDate('created_at', '<=', request('end_date'));
            }

            $transactions = $query->get();

            $filename = 'laporan-penjualan.csv';

            $headers = [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => "attachment; filename=\"$filename\"",
            ];

            $callback = function () use ($transactions) {
                $file = fopen('php://output', 'w');

                fputcsv($file, [
                    'Tanggal',
                    'Kode Transaksi',
                    'Total',
                    'Bayar',
                    'Kembali',
                    'Profit'
                ]);

                foreach ($transactions as $transaction) {
                    fputcsv($file, [
                        $transaction->created_at->format('d-m-Y H:i'),
                        '#' . $transaction->id,
                        $transaction->total,
                        $transaction->payment,
                        $transaction->change,
                        $transaction->items->sum('profit'),
                    ]);
                }

                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
        }

        public function pdf()
        {
            $query = Transaction::with('items.product')->latest();

            if (request('start_date')) {
                $query->whereDate('created_at', '>=', request('start_date'));
            }

            if (request('end_date')) {
                $query->whereDate('created_at', '<=', request('end_date'));
            }

            $transactions = $query->get();

            $totalSales = $transactions->sum('total');
            $totalProfit = $transactions->flatMap->items->sum('profit');

            $pdf = Pdf::loadView('reports.pdf', compact(
                'transactions',
                'totalSales',
                'totalProfit'
            ));

            return $pdf->download('laporan-penjualan.pdf');
        }
}