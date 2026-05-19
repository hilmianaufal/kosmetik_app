<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran - MATANU BEAUTY</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gradient-to-br from-pink-50 via-white to-rose-50 font-[Plus_Jakarta_Sans] text-gray-800">

<div class="min-h-screen p-4 pb-10">

    <div class="max-w-xl mx-auto">

        <a href="/shop" class="inline-block mb-5 text-pink-500 font-black">
            ← Kembali Belanja
        </a>

        <div class="bg-white rounded-[36px] p-6 shadow-xl border border-pink-100 mb-5">
            <h1 class="text-3xl font-black text-gray-800">
                Pembayaran QRIS
            </h1>

            <p class="text-gray-400 mt-2">
                Scan QRIS, lalu upload bukti pembayaran.
            </p>
        </div>

        @php
            $total = collect($items)->sum(fn($item) => $item['price'] * $item['qty']);
        @endphp

        <div class="bg-white rounded-[36px] p-6 shadow-xl border border-pink-100 mb-5">

            <h2 class="text-xl font-black mb-4">
                Ringkasan Pesanan
            </h2>

            <div class="space-y-3">
                @foreach($items as $item)
                    <div class="flex justify-between border-b border-pink-50 pb-3">
                        <div>
                            <p class="font-bold">{{ $item['name'] }}</p>
                            <p class="text-sm text-gray-400">
                                {{ $item['qty'] }} x Rp {{ number_format($item['price'], 0, ',', '.') }}
                            </p>
                        </div>

                        <p class="font-black text-pink-500">
                            Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}
                        </p>
                    </div>
                @endforeach
            </div>

            <div class="flex justify-between text-xl font-black mt-5 pt-5 border-t border-pink-100">
                <span>Total</span>
                <span class="text-pink-500">
                    Rp {{ number_format($total, 0, ',', '.') }}
                </span>
            </div>

        </div>

        <form action="{{ route('shop.order') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-[36px] p-6 shadow-xl border border-pink-100 space-y-4">
            @csrf

            <textarea name="items" class="hidden">{{ json_encode($items) }}</textarea>

            <div class="bg-pink-50 rounded-[30px] p-5 text-center">
                <p class="font-black text-gray-800 mb-4">
                    Scan QRIS Pembayaran
                </p>

                <img src="{{ asset('images/qris.jpeg') }}"
                     class="w-64 h-64 object-contain mx-auto rounded-3xl bg-white p-4 shadow-xl">

                <p class="text-sm text-gray-500 mt-4">
                    Total bayar:
                    <span class="font-black text-pink-500">
                        Rp {{ number_format($total, 0, ',', '.') }}
                    </span>
                </p>
            </div>

            <input name="customer_name" required placeholder="Nama lengkap"
                   class="w-full p-4 rounded-2xl border border-pink-100 outline-none focus:border-pink-400">

            <input name="customer_phone" required placeholder="Nomor WhatsApp"
                   class="w-full p-4 rounded-2xl border border-pink-100 outline-none focus:border-pink-400">

            <textarea name="customer_address" required rows="3" placeholder="Alamat lengkap"
                      class="w-full p-4 rounded-2xl border border-pink-100 outline-none focus:border-pink-400"></textarea>

            <div>
                <label class="text-sm font-bold text-gray-500">
                    Upload Bukti Pembayaran
                </label>

                <input type="file" name="payment_proof" required
                       class="w-full mt-2 p-4 rounded-2xl border border-pink-100 bg-white">
            </div>

            <button class="w-full py-4 rounded-2xl bg-green-500 text-white font-black shadow-xl">
                Kirim Pesanan
            </button>

        </form>

    </div>

</div>

</body>
</html>