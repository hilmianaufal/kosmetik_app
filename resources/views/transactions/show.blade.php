@extends('layouts.app')

@section('content')

<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="dashboard-title text-3xl font-extrabold text-gray-800">
            Detail Transaksi #{{ $transaction->id }}
        </h1>

        <p class="text-gray-500 mt-2">
            {{ $transaction->created_at->format('d M Y H:i') }}
        </p>
    </div>

    <button onclick="window.print()"
        class="px-6 py-4 rounded-2xl bg-pink-500 text-white font-extrabold shadow-xl">
        Print Ulang
    </button>
</div>

<div class="print-area bg-white rounded-[32px] p-6 shadow-xl border border-pink-100">

    <h2 class="text-xl font-extrabold mb-5">
        Produk Dibeli
    </h2>

    <div class="space-y-4">
        @foreach ($transaction->items as $item)

            <div class="flex items-center justify-between border-b border-pink-50 pb-4">
                <div>
                    <p class="font-bold text-gray-800">
                        {{ $item->product->name ?? 'Produk Dihapus' }}
                    </p>

                    <p class="text-sm text-gray-400">
                        {{ $item->qty }} x Rp {{ number_format($item->price, 0, ',', '.') }}
                    </p>
                </div>

                <p class="font-extrabold text-pink-500">
                    Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                </p>
            </div>

        @endforeach
    </div>

    <div class="mt-6 pt-6 border-t border-pink-100 space-y-3">
        <div class="flex justify-between text-gray-500">
            <span>Total</span>
            <span>Rp {{ number_format($transaction->total, 0, ',', '.') }}</span>
        </div>

        <div class="flex justify-between text-gray-500">
            <span>Bayar</span>
            <span>Rp {{ number_format($transaction->payment, 0, ',', '.') }}</span>
        </div>

        <div class="flex justify-between text-xl font-extrabold">
            <span>Kembalian</span>
            <span class="text-emerald-500">
                Rp {{ number_format($transaction->change, 0, ',', '.') }}
            </span>
        </div>
    </div>

</div>

<a href="/transactions"
   class="inline-block mt-6 px-6 py-4 rounded-2xl bg-gray-100 text-gray-700 font-extrabold">
    Kembali
</a>
<style>
@media print {

    body {
        background: white !important;
    }

    aside,
    nav,
    button,
    a {
        display: none !important;
    }

    main {
        padding: 0 !important;
    }

    .print-area {
        width: 320px;
        margin: auto;
        box-shadow: none !important;
        border: none !important;
        border-radius: 0 !important;
    }

}
</style>
@endsection