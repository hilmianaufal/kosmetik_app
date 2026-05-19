@extends('layouts.app')

@section('content')

<div x-data="posApp(@js($products))" class="relative">
    <div
        x-show="notice"
        x-transition
        class="fixed top-6 right-6 z-[60] bg-white border border-pink-100 shadow-2xl rounded-2xl px-5 py-4 font-bold text-pink-500"
        x-text="notice">
    </div>
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        <div class="xl:col-span-2">

            <div class="mb-6">
                <h1 class="dashboard-title text-3xl font-extrabold text-gray-800">
                    Kasir POS
                </h1>
                <p class="text-gray-500 mt-2">
                    Pilih produk kosmetik untuk transaksi
                </p>
            </div>

            <div class="flex gap-3 mb-6">
                <div class="flex-1 bg-white/80 p-4 rounded-[28px] shadow-xl border border-pink-100">
                    <input
                        x-model="search"
                        type="text"
                        placeholder="Cari produk / scan barcode..."
                        class="w-full outline-none bg-transparent text-gray-700"
                    >
                </div>

                <button
                    @click="openScanner()"
                    class="px-5 py-3 rounded-2xl bg-pink-500 text-white font-bold shadow-lg">
                    Scan
                </button>
            </div>

            <div class="flex gap-3 overflow-x-auto mb-6 pb-2">
                <button
                    @click="selectedCategory = 'all'"
                    :class="selectedCategory === 'all' ? 'bg-pink-500 text-white' : 'bg-white text-gray-600'"
                    class="px-5 py-3 rounded-2xl font-bold shadow border border-pink-100">
                    Semua
                </button>

                <template x-for="category in categories()" :key="category">
                    <button
                        @click="selectedCategory = category"
                        :class="selectedCategory === category ? 'bg-pink-500 text-white' : 'bg-white text-gray-600'"
                        class="px-5 py-3 rounded-2xl font-bold shadow border border-pink-100 whitespace-nowrap"
                        x-text="category">
                    </button>
                </template>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 gap-5">

                <template x-for="product in filteredProducts()" :key="product.id">

                    <div class="stat-card bg-white/80 rounded-[30px] p-5 shadow-xl border border-pink-100 hover:-translate-y-2 hover:shadow-2xl transition duration-300 cursor-pointer">

                        <div class="w-20 h-20 rounded-3xl overflow-hidden mb-4 bg-pink-50">
                            <template x-if="product.image">
                                <img
                                    :src="imageUrl(product.image)"
                                    class="w-full h-full object-cover">
                            </template>

                            <template x-if="!product.image">
                                <div class="w-full h-full flex items-center justify-center text-3xl">
                                    💄
                                </div>
                            </template>
                        </div>

                        <h3 class="font-extrabold text-gray-800" x-text="product.name"></h3>
                        <p class="text-sm text-gray-400" x-text="product.brand"></p>

                        <div class="mt-4">
                            <p class="text-xs font-bold"
                               :class="product.stock > 5 ? 'text-emerald-500' : product.stock > 0 ? 'text-orange-500' : 'text-red-500'">
                                Stok: <span x-text="product.stock"></span>
                            </p>
                        </div>

                        <div class="flex items-center justify-between mt-3">
                            <p class="font-bold text-pink-500">
                                Rp <span x-text="formatRupiah(product.price)"></span>
                            </p>

                            <button
                                @click="addToCart(product)"
                                :disabled="product.stock <= 0"
                                class="add-cart-btn w-10 h-10 rounded-2xl bg-gradient-to-r from-pink-500 to-rose-400 text-white font-bold shadow-lg hover:scale-110 transition duration-300 disabled:opacity-40 disabled:cursor-not-allowed">
                                +
                            </button>
                        </div>

                    </div>

                </template>

            </div>

        </div>

        <div class="cart-panel bg-white/90 rounded-[32px] p-6 shadow-xl border border-pink-100 h-fit xl:sticky xl:top-6">

            <div class="flex items-center justify-between mb-5">
                <h2 class="text-xl font-extrabold">
                    Keranjang
                </h2>

                <button
                    x-show="cart.length > 0"
                    @click="clearCart()"
                    class="text-sm font-bold text-red-500 bg-red-50 px-3 py-2 rounded-xl">
                    Kosongkan
                </button>
            </div>

            <div x-show="cart.length === 0" class="text-center py-10 text-gray-400">
                <div class="text-5xl mb-3">🛒</div>
                <p>Keranjang masih kosong</p>
            </div>

            <div class="space-y-4" x-show="cart.length > 0">

                <template x-for="item in cart" :key="item.id">

                    <div class="flex justify-between items-center border-b border-pink-50 pb-4">

                        <div>
                            <p class="font-bold" x-text="item.name"></p>

                            <p class="text-sm text-gray-400">
                                <span x-text="item.qty"></span> x Rp <span x-text="formatRupiah(item.price)"></span>
                            </p>

                            <div class="flex items-center gap-2 mt-2">
                                <button
                                    @click="decreaseQty(item.id)"
                                    class="w-7 h-7 rounded-lg bg-pink-100 text-pink-500 font-bold">
                                    -
                                </button>

                                <span class="font-bold" x-text="item.qty"></span>

                                <button
                                    @click="increaseQty(item.id)"
                                    class="w-7 h-7 rounded-lg bg-pink-500 text-white font-bold">
                                    +
                                </button>
                            </div>
                        </div>

                        <p class="font-bold">
                            Rp <span x-text="formatRupiah(item.price * item.qty)"></span>
                        </p>

                    </div>

                </template>

            </div>

            <div class="border-t border-pink-100 mt-6 pt-6 space-y-3">

                <div class="flex justify-between text-gray-500">
                    <span>Subtotal</span>
                    <span>Rp <span x-text="formatRupiah(total())"></span></span>
                </div>

                <div>
                    <label class="text-sm text-gray-500 font-semibold">
                        Diskon
                    </label>

                    <input
                        x-model.number="discount"
                        type="number"
                        placeholder="Masukkan diskon"
                        class="w-full mt-2 rounded-2xl border border-pink-100 p-3 outline-none focus:border-pink-400">
                </div>

                <div class="flex justify-between text-xl font-extrabold">
                    <span>Total</span>
                    <span class="text-pink-500">
                        Rp <span x-text="formatRupiah(grandTotal())"></span>
                    </span>
                </div>

            </div>

            <button
                @click="checkoutOpen = true"
                :disabled="cart.length === 0"
                class="w-full mt-6 py-4 rounded-2xl bg-gradient-to-r from-pink-500 to-rose-400 text-white font-extrabold shadow-xl hover:scale-[1.02] transition disabled:opacity-40 disabled:cursor-not-allowed">
                Bayar Sekarang
            </button>

        </div>

    </div>

    <div
        x-show="checkoutOpen"
        x-transition
        class="fixed inset-0 bg-black/40 backdrop-blur-sm z-50 flex items-center justify-center p-4">

        <div
            @click.away="checkoutOpen = false"
            class="bg-white w-full max-w-md rounded-[32px] p-6 shadow-2xl">

            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-extrabold">Checkout</h2>

                <button
                    @click="checkoutOpen = false"
                    class="w-10 h-10 rounded-2xl bg-pink-100 text-pink-500">
                    ✕
                </button>
            </div>

            <div class="space-y-4">

                <div class="bg-pink-50 rounded-2xl p-5">
                    <p class="text-gray-500">Total Pembayaran</p>

                    <h1 class="text-4xl font-extrabold text-pink-500 mt-2">
                        Rp <span x-text="formatRupiah(grandTotal())"></span>
                    </h1>
                </div>

                <div>
                    <label class="text-sm font-semibold text-gray-500">
                        Uang Bayar
                    </label>

                    <input
                        x-model.number="payment"
                        type="number"
                        placeholder="Masukkan uang bayar"
                        class="w-full mt-2 rounded-2xl border border-pink-100 p-4 outline-none focus:border-pink-400">

                        <div class="grid grid-cols-3 gap-3 mt-4">

                            <button
                                @click="payment = grandTotal()"
                                class="py-3 rounded-2xl bg-pink-100 text-pink-500 font-bold">
                                Uang Pas
                            </button>

                            <button
                                @click="payment = 50000"
                                class="py-3 rounded-2xl bg-white border border-pink-100 font-bold">
                                50K
                            </button>

                            <button
                                @click="payment = 100000"
                                class="py-3 rounded-2xl bg-white border border-pink-100 font-bold">
                                100K
                            </button>

                            <button
                                @click="payment = 200000"
                                class="py-3 rounded-2xl bg-white border border-pink-100 font-bold">
                                200K
                            </button>

                            <button
                                @click="payment = 500000"
                                class="py-3 rounded-2xl bg-white border border-pink-100 font-bold">
                                500K
                            </button>

                            <button
                                @click="payment = 1000000"
                                class="py-3 rounded-2xl bg-white border border-pink-100 font-bold">
                                1JT
                            </button>

                        </div>
                </div>

                <div class="bg-emerald-50 rounded-2xl p-5">
                    <p class="text-gray-500">Kembalian</p>

                    <h2 class="text-3xl font-extrabold text-emerald-500 mt-2">
                        Rp <span x-text="formatRupiah(change() > 0 ? change() : 0)"></span>
                    </h2>
                </div>

                <button
                    @click="finishPayment()"
                    :disabled="payment < grandTotal()"
                    class="w-full py-4 rounded-2xl bg-gradient-to-r from-pink-500 to-rose-400 text-white font-extrabold shadow-xl hover:scale-[1.02] transition disabled:opacity-40 disabled:cursor-not-allowed">
                    Selesaikan Pembayaran
                </button>

            </div>

        </div>

    </div>

    <div
        x-show="successOpen"
        x-transition
        class="fixed inset-0 bg-black/40 backdrop-blur-sm z-50 flex items-center justify-center p-4">

        <div class="bg-white w-full max-w-sm rounded-[32px] p-8 shadow-2xl text-center">

            <div class="w-20 h-20 mx-auto rounded-full bg-emerald-100 flex items-center justify-center text-4xl mb-5">
                ✅
            </div>

            <h2 class="text-2xl font-extrabold text-gray-800">
                Pembayaran Berhasil
            </h2>

            <p class="text-gray-500 mt-2">
                Transaksi berhasil disimpan.
            </p>

            <button
                @click="printReceipt()"
                class="w-full mt-6 py-4 rounded-2xl bg-pink-500 text-white font-extrabold shadow-xl">
                Print Struk
            </button>

            <button
                @click="successOpen = false"
                class="w-full mt-3 py-4 rounded-2xl bg-emerald-500 text-white font-extrabold shadow-xl">
                Selesai
            </button>

        </div>

    </div>

    <div
        x-show="scannerOpen"
        x-transition
        class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">

        <div class="bg-white w-full max-w-md rounded-[32px] p-6 shadow-2xl">

            <div class="flex items-center justify-between mb-5">
                <h2 class="text-xl font-extrabold">Scan Barcode</h2>

                <button
                    @click="closeScanner()"
                    class="w-10 h-10 rounded-2xl bg-pink-100 text-pink-500">
                    ✕
                </button>
            </div>

            <div id="reader" class="rounded-3xl overflow-hidden"></div>

        </div>

    </div>

    <audio id="successSound">
        <source src="https://assets.mixkit.co/active_storage/sfx/2013/2013-preview.mp3" type="audio/mpeg">
    </audio>

</div>

@endsection