@extends('layouts.app')

@section('content')

<h1 class="text-3xl font-extrabold text-gray-800 mb-2">
    Laporan Penjualan
</h1>

<p class="text-gray-500 mb-6">
    Rekap penjualan MATANU BEAUTY STORE
</p>
<form method="GET" class="bg-white rounded-[32px] p-6 shadow-xl border border-pink-100 mb-6 grid grid-cols-1 md:grid-cols-3 gap-4">

    <input
        type="date"
        name="start_date"
        value="{{ request('start_date') }}"
        class="p-4 rounded-2xl border border-pink-100 outline-none">

    <input
        type="date"
        name="end_date"
        value="{{ request('end_date') }}"
        class="p-4 rounded-2xl border border-pink-100 outline-none">

    <button class="rounded-2xl bg-pink-500 text-white font-extrabold">
        Filter Laporan
    </button>

</form>
<a href="/reports/export?start_date={{ request('start_date') }}&end_date={{ request('end_date') }}"
   class="inline-block mb-6 px-6 py-4 rounded-2xl bg-emerald-500 text-white font-extrabold shadow-xl">
    Export CSV
</a>

<a href="/reports/pdf?start_date={{ request('start_date') }}&end_date={{ request('end_date') }}"
   class="inline-block mb-6 px-6 py-4 rounded-2xl bg-red-500 text-white font-extrabold shadow-xl">
    Export PDF
</a>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

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

    <div class="bg-white rounded-[32px] p-6 shadow-xl border border-emerald-100">
        <p class="text-gray-500">Total Laba</p>
        <h2 class="text-3xl font-extrabold text-emerald-500 mt-3">
            Rp {{ number_format($totalProfit, 0, ',', '.') }}
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
<div class="bg-white rounded-[32px] p-6 shadow-xl border border-pink-100 mt-8">

    <h2 class="text-xl font-extrabold mb-5">
        Produk Terlaris
    </h2>

    <div class="space-y-4">
        @forelse ($bestSellingProducts as $item)

            <div class="flex items-center justify-between border-b border-pink-50 pb-4">
                <div>
                    <p class="font-bold text-gray-800">
                        {{ $item->product->name ?? 'Produk Dihapus' }}
                    </p>

                    <p class="text-sm text-gray-400">
                        Terjual {{ $item->total_qty }} pcs
                    </p>
                </div>

                <p class="font-extrabold text-emerald-500">
                    Laba Rp {{ number_format($item->total_profit, 0, ',', '.') }}
                </p>
            </div>

        @empty
            <div class="text-center py-10 text-gray-400">
                Belum ada produk terjual
            </div>
        @endforelse
    </div>

</div>
@endsection