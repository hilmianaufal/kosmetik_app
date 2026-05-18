@extends('layouts.app')

@section('content')

<h1 class="text-3xl font-extrabold text-gray-800 mb-2">
    Laporan Penjualan
</h1>

<p class="text-gray-500 mb-6">
    Rekap penjualan MATANU BEAUTY STORE
</p>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

    <div class="bg-white rounded-[32px] p-6 shadow-xl border border-pink-100">
        <p class="text-gray-500">Total Penjualan</p>
        <h2 class="text-3xl font-extrabold text-pink-500 mt-3">
            Rp {{ number_format($totalSales, 0, ',', '.') }}
        </h2>
    </div>

    <div class="bg-white rounded-[32px] p-6 shadow-xl border border-pink-100">
        <p class="text-gray-500">Total Transaksi</p>
        <h2 class="text-3xl font-extrabold text-gray-800 mt-3">
            {{ $totalTransaction }}
        </h2>
    </div>

</div>

<div class="bg-white rounded-[32px] p-6 shadow-xl border border-pink-100">

    <h2 class="text-xl font-extrabold mb-5">
        Detail Transaksi
    </h2>

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="text-sm text-gray-400 border-b">
                    <th class="py-3">Tanggal</th>
                    <th>Total</th>
                    <th>Bayar</th>
                    <th>Kembali</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($transactions as $transaction)
                <tr class="border-b border-pink-50">
                    <td class="py-4">
                        {{ $transaction->created_at->format('d M Y H:i') }}
                    </td>
                    <td class="font-bold text-pink-500">
                        Rp {{ number_format($transaction->total, 0, ',', '.') }}
                    </td>
                    <td>
                        Rp {{ number_format($transaction->payment, 0, ',', '.') }}
                    </td>
                    <td>
                        Rp {{ number_format($transaction->change, 0, ',', '.') }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

@endsection