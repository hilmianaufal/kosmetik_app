<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Status Pesanan - MATANU BEAUTY</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>

<body class="bg-gradient-to-br from-pink-50 via-white to-rose-50 font-[Plus_Jakarta_Sans] text-gray-800">

<div class="min-h-screen p-4 pb-24">

    <div class="max-w-2xl mx-auto">

        <!-- Header -->
        <div class="text-center mb-8">

            <img
                src="{{ asset('images/logo.png') }}"
                class="w-24 h-24 object-contain mx-auto brightness-125 contrast-125 saturate-150">

            <h1 class="text-3xl sm:text-4xl font-black text-pink-500 mt-4">
                Status Pesanan
            </h1>

            <p class="text-gray-400 mt-2">
                Cek status pesanan online kamu
            </p>

        </div>

        <!-- Search -->
        <div class="bg-white rounded-[36px] p-5 sm:p-6 shadow-xl border border-pink-100 mb-6">

            <form method="GET" action="{{ route('shop.order-status') }}">

                <label class="block text-sm font-bold text-gray-500 mb-2">
                    Nomor WhatsApp
                </label>

                <div class="flex gap-3">

                    <input
                        type="text"
                        name="phone"
                        value="{{ request('phone') }}"
                        placeholder="Contoh: 08123456789"
                        class="flex-1 p-4 rounded-2xl border border-pink-100 outline-none focus:border-pink-400">

                    <button
                        class="px-6 rounded-2xl bg-gradient-to-r from-pink-500 to-rose-400 text-white font-black shadow-xl">
                        Cari
                    </button>

                </div>

            </form>

        </div>

        <!-- Orders -->
        <div class="space-y-5">

            @forelse($orders as $order)

                <div class="bg-white rounded-[36px] p-5 sm:p-6 shadow-xl border border-pink-100">

                    <!-- Top -->
                    <div class="flex items-start justify-between gap-4 mb-5">

                        <div>
                            <h2 class="text-xl font-black text-gray-800">
                                Order #{{ $order->id }}
                            </h2>

                            <p class="text-sm text-gray-400 mt-1">
                                {{ $order->created_at->format('d M Y H:i') }}
                            </p>
                        </div>

                        <span class="px-4 py-2 rounded-2xl text-xs font-black
                            {{ $order->status === 'pending' ? 'bg-orange-50 text-orange-500' : '' }}
                            {{ $order->status === 'confirmed' ? 'bg-emerald-50 text-emerald-500' : '' }}
                            {{ $order->status === 'rejected' ? 'bg-red-50 text-red-500' : '' }}">
                            {{ strtoupper($order->status) }}
                        </span>

                    </div>

                    <!-- Items -->
                    <div class="space-y-3">

                        @foreach($order->items as $item)

                            <div class="flex items-center justify-between border-b border-pink-50 pb-3">

                                <div class="flex items-center gap-3">

                                    <div class="w-14 h-14 rounded-2xl overflow-hidden bg-pink-50">

                                        @if($item->product && $item->product->image)

                                            <img
                                                src="{{ str_starts_with($item->product->image, 'http')
                                                    ? $item->product->image
                                                    : asset('storage/' . $item->product->image) }}"
                                                class="w-full h-full object-cover">

                                        @else

                                            <div class="w-full h-full flex items-center justify-center text-2xl">
                                                💄
                                            </div>

                                        @endif

                                    </div>

                                    <div>
                                        <p class="font-black text-gray-800">
                                            {{ $item->product->name ?? 'Produk Dihapus' }}
                                        </p>

                                        <p class="text-sm text-gray-400">
                                            {{ $item->qty }} x Rp {{ number_format($item->price, 0, ',', '.') }}
                                        </p>
                                    </div>

                                </div>

                                <p class="font-black text-pink-500">
                                    Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                </p>

                            </div>

                        @endforeach

                    </div>

                    <!-- Total -->
                    <div class="flex justify-between items-center mt-5 pt-5 border-t border-pink-100">

                        <span class="font-black text-gray-800">
                            Total Pembayaran
                        </span>

                        <span class="text-2xl font-black text-pink-500">
                            Rp {{ number_format($order->total, 0, ',', '.') }}
                        </span>

                    </div>

                </div>

            @empty

                @if(request('phone'))

                    <div class="bg-white rounded-[36px] p-10 shadow-xl border border-pink-100 text-center">

                        <div class="text-6xl mb-4">
                            📦
                        </div>

                        <h2 class="text-xl font-black text-gray-800">
                            Pesanan Tidak Ditemukan
                        </h2>

                        <p class="text-gray-400 mt-2">
                            Pastikan nomor WhatsApp yang dimasukkan benar
                        </p>

                    </div>

                @endif

            @endforelse

        </div>

        <!-- Back -->
        <div class="text-center mt-8">

            <a
                href="/shop"
                class="inline-flex items-center gap-2 text-pink-500 font-black">

                ← Kembali Belanja

            </a>

        </div>

    </div>

</div>

</body>
</html>