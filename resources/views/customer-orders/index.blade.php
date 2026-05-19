@extends('layouts.app')

@section('content')

<h1 class="dashboard-title text-3xl font-extrabold text-gray-800 mb-2">
    Pesanan Customer
</h1>

<p class="text-gray-500 mb-6">
    Pesanan dari halaman shop customer
</p>
@if (session('success'))
    <div class="mb-6 bg-emerald-50 border border-emerald-100 text-emerald-500 rounded-2xl p-4 font-bold">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="mb-6 bg-red-50 border border-red-100 text-red-500 rounded-2xl p-4 font-bold">
        {{ session('error') }}
    </div>
@endif
<div class="space-y-6">
    @forelse ($orders as $order)

        <div class="bg-white/90 rounded-[36px] p-6 shadow-xl border border-pink-100">

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-5">
                <div>
                    <h2 class="text-xl font-black text-pink-500">
                        Order #{{ $order->id }}
                    </h2>

                    <p class="text-sm text-gray-400">
                        {{ $order->created_at->format('d M Y H:i') }}
                    </p>
                </div>

                <span class="px-4 py-2 rounded-2xl font-black text-sm
                    {{ $order->status === 'pending' ? 'bg-orange-50 text-orange-500' : 'bg-emerald-50 text-emerald-500' }}">
                    {{ strtoupper($order->status) }}
                </span>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <div class="lg:col-span-2 space-y-4">
                    <div>
                        <p class="font-black text-gray-800">{{ $order->customer_name }}</p>
                        <p class="text-gray-500">{{ $order->customer_phone }}</p>
                        <p class="text-gray-400 text-sm mt-1">{{ $order->customer_address }}</p>
                    </div>

                    <div class="space-y-3">
                        @foreach ($order->items as $item)
                            <div class="flex justify-between border-b border-pink-50 pb-3">
                                <div>
                                    <p class="font-bold">
                                        {{ $item->product->name ?? 'Produk Dihapus' }}
                                    </p>
                                    <p class="text-sm text-gray-400">
                                        {{ $item->qty }} x Rp {{ number_format($item->price, 0, ',', '.') }}
                                    </p>
                                </div>

                                <p class="font-black text-pink-500">
                                    Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                </p>
                            </div>
                        @endforeach
                    </div>

                    <div class="text-xl font-black flex justify-between pt-3">
                        <span>Total</span>
                        <span class="text-pink-500">
                            Rp {{ number_format($order->total, 0, ',', '.') }}
                        </span>
                    </div>
                </div>

                <div>
                    <p class="font-black text-gray-800 mb-3">Bukti Bayar</p>

                    @if ($order->payment_proof)
                        <a href="/storage/{{ $order->payment_proof }}" target="_blank">
                            <img src="/storage/{{ $order->payment_proof }}"
                                class="w-full rounded-[28px] border border-pink-100 shadow-lg">
                        </a>
                    @else
                        <div class="p-6 rounded-3xl bg-gray-50 text-gray-400 text-center">
                            Tidak ada bukti
                        </div>
                    @endif
                </div>

                @if ($order->status === 'pending')
                    <form action="{{ route('customer-orders.confirm', $order->id) }}" method="POST" class="mt-4">
                        @csrf

                        <button
                            onclick="return confirm('Konfirmasi pesanan ini? Stok akan otomatis berkurang.')"
                            class="w-full py-4 rounded-2xl bg-emerald-500 text-white font-black shadow-xl">
                            Konfirmasi Pesanan
                        </button>
                    </form>
                @endif

                @if ($order->status === 'pending')
                    <form action="{{ route('customer-orders.reject', $order->id) }}" method="POST" class="mt-3">
                        @csrf

                        <button
                            onclick="return confirm('Yakin ingin menolak pesanan ini?')"
                            class="w-full py-4 rounded-2xl bg-red-500 text-white font-black shadow-xl">
                            Tolak Pesanan
                        </button>
                    </form>
                @endif

            </div>

        </div>

    @empty
        <div class="bg-white rounded-[36px] p-12 text-center shadow-xl border border-pink-100 text-gray-400">
            Belum ada pesanan customer
        </div>
    @endforelse
</div>

@endsection