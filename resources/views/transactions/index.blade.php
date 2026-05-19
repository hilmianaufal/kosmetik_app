@extends('layouts.app')

@section('content')

<h1 class="text-3xl font-extrabold text-gray-800 mb-2">
    Riwayat Transaksi
</h1>

<p class="text-gray-500 mb-6">
    Semua transaksi MATANU BEAUTY STORE
</p>

<div class="space-y-6">

    @foreach ($transactions as $transaction)

    <div class="bg-white rounded-[32px] p-6 shadow-xl border border-pink-100">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-5">

            <div>
                <h2 class="font-extrabold text-xl text-pink-500">
                    Transaksi #{{ $transaction->id }}
                </h2>

                <p class="text-gray-400 text-sm">
                    {{ $transaction->created_at->format('d M Y H:i') }}
                </p>
            </div>

            <div class="text-right">
                <p class="text-gray-400 text-sm">Total</p>

                <h1 class="text-2xl font-extrabold text-gray-800">
                    Rp {{ number_format($transaction->total, 0, ',', '.') }}
                </h1>
            </div>
                <a href="/transactions/{{ $transaction->id }}"
                class="px-4 py-2 rounded-xl bg-pink-50 text-pink-500 font-bold">
                    Detail
                </a>
        </div>

        <div class="space-y-3">

@foreach ($transaction->items as $item)

<div class="flex items-center justify-between border-b border-pink-50 pb-3">

    <div class="flex items-center gap-4">

        <div class="w-14 h-14 rounded-2xl overflow-hidden bg-pink-50">
            @if ($item->product && $item->product->image)

                @if (Str::startsWith($item->product->image, 'http'))
                    <img src="{{ $item->product->image }}" class="w-full h-full object-cover">
                @else
                    <img src="/storage/{{ $item->product->image }}" class="w-full h-full object-cover">
                @endif

            @else
                <div class="w-full h-full flex items-center justify-center">
                    💄
                </div>
            @endif
        </div>

        <div>
            <p class="font-bold">
                {{ $item->product->name ?? 'Produk Dihapus' }}
            </p>

            <p class="text-sm text-gray-400">
                {{ $item->qty }} x Rp {{ number_format($item->price, 0, ',', '.') }}
            </p>
        </div>

    </div>

    <h3 class="font-extrabold text-pink-500">
        Rp {{ number_format($item->subtotal, 0, ',', '.') }}
    </h3>

</div>

@endforeach

        </div>

    </div>

    @endforeach

</div>

@endsection