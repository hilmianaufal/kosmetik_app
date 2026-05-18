@extends('layouts.app')

@section('content')

<div x-data="posApp()" class="relative">

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        <!-- Produk -->
        <div class="xl:col-span-2">

            <div class="mb-6">
                <h1 class="dashboard-title text-3xl font-extrabold text-gray-800">
                    Kasir POS
                </h1>
                <p class="text-gray-500 mt-2">
                    Pilih produk kosmetik untuk transaksi
                </p>
            </div>

            <div class="bg-white/80 p-4 rounded-[28px] shadow-xl border border-pink-100 mb-6">
                <input
                    x-model="search"
                    type="text"
                    placeholder="Cari produk / scan barcode..."
                    class="w-full outline-none bg-transparent text-gray-700"
                >
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
                                    :src="product.image.startsWith('http') ? product.image : '/storage/' + product.image"
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

        <!-- Cart -->
        <div class="cart-panel bg-white/90 rounded-[32px] p-6 shadow-xl border border-pink-100 h-fit xl:sticky xl:top-6">

            <h2 class="text-xl font-extrabold mb-5">
                Keranjang
            </h2>

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

    <!-- Checkout Modal -->
    <div
        x-show="checkoutOpen"
        x-transition
        class="fixed inset-0 bg-black/40 backdrop-blur-sm z-50 flex items-center justify-center p-4">

        <div
            @click.away="checkoutOpen = false"
            class="bg-white w-full max-w-md rounded-[32px] p-6 shadow-2xl">

            <div class="flex items-center justify-between mb-6">

                <h2 class="text-2xl font-extrabold">
                    Checkout
                </h2>

                <button
                    @click="checkoutOpen = false"
                    class="w-10 h-10 rounded-2xl bg-pink-100 text-pink-500">
                    ✕
                </button>

            </div>

            <div class="space-y-4">

                <div class="bg-pink-50 rounded-2xl p-5">
                    <p class="text-gray-500">
                        Total Pembayaran
                    </p>

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
                </div>

                <div class="bg-emerald-50 rounded-2xl p-5">
                    <p class="text-gray-500">
                        Kembalian
                    </p>

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

    <!-- Success Modal -->
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

</div>
<audio id="successSound">
    <source src="https://assets.mixkit.co/active_storage/sfx/2013/2013-preview.mp3" type="audio/mpeg">
</audio>
<script>
    function posApp() {
        return {
            search: '',
            selectedCategory: 'all',
            cart: [],
            checkoutOpen: false,
            successOpen: false,
            payment: 0,
            discount: 0,
            lastTransaction: null,

            products: @json($products),

            categories() {
                return [...new Set(this.products.map(product => product.category).filter(Boolean))];
            },

            filteredProducts() {
                return this.products.filter(product => {
                    const keyword = this.search.toLowerCase();

                    const matchSearch =
                        product.name.toLowerCase().includes(keyword) ||
                        (product.brand ?? '').toLowerCase().includes(keyword) ||
                        (product.barcode ?? '').includes(this.search);

                    const matchCategory =
                        this.selectedCategory === 'all' ||
                        product.category === this.selectedCategory;

                    return matchSearch && matchCategory;
                });
            },

            addToCart(product) {
                if (product.stock <= 0) return;

                let item = this.cart.find(i => i.id === product.id);

                if (item) {
                    if (item.qty < product.stock) {
                        item.qty++;
                    }
                } else {
                    this.cart.push({
                        ...product,
                        qty: 1
                    });
                }
            },

            increaseQty(id) {
                let item = this.cart.find(i => i.id === id);

                if (item && item.qty < item.stock) {
                    item.qty++;
                }
            },

            decreaseQty(id) {
                let item = this.cart.find(i => i.id === id);

                if (item && item.qty > 1) {
                    item.qty--;
                } else {
                    this.cart = this.cart.filter(i => i.id !== id);
                }
            },

            total() {
                return this.cart.reduce((sum, item) => sum + (item.price * item.qty), 0);
            },

            grandTotal() {
                return Math.max(this.total() - this.discount, 0);
            },

            change() {
                return this.payment - this.grandTotal();
            },

            async finishPayment() {
                if (this.payment < this.grandTotal()) return;

                const response = await fetch('/checkout', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute('content')
                    },
                    body: JSON.stringify({
                        items: this.cart,
                        total: this.grandTotal(),
                        payment: this.payment,
                        change: this.change()
                    })
                });

                const result = await response.json();

                if (result.success) {
                    this.lastTransaction = {
                        items: [...this.cart],
                        subtotal: this.total(),
                        discount: this.discount,
                        total: this.grandTotal(),
                        payment: this.payment,
                        change: this.change(),
                        date: new Date().toLocaleString('id-ID')
                    };

                    this.checkoutOpen = false;
                    this.successOpen = true;
                    document.getElementById('successSound').play();
                    this.cart = [];
                    this.payment = 0;
                    this.discount = 0;
                }
            },

            printReceipt() {
                if (!this.lastTransaction) return;

                let receipt = `
                    <div style="font-family: Arial; width: 280px; padding: 10px;">
                        <h2 style="text-align:center;">MATANU BEAUTY STORE</h2>
                        <p style="text-align:center;">${this.lastTransaction.date}</p>
                        <hr>

                        ${this.lastTransaction.items.map(item => `
                            <div style="display:flex; justify-content:space-between; margin-bottom:6px;">
                                <span>${item.name} x${item.qty}</span>
                                <span>Rp ${this.formatRupiah(item.price * item.qty)}</span>
                            </div>
                        `).join('')}

                        <hr>
                        <p>Subtotal: Rp ${this.formatRupiah(this.lastTransaction.subtotal)}</p>
                        <p>Diskon: Rp ${this.formatRupiah(this.lastTransaction.discount)}</p>
                        <p><strong>Total: Rp ${this.formatRupiah(this.lastTransaction.total)}</strong></p>
                        <p>Bayar: Rp ${this.formatRupiah(this.lastTransaction.payment)}</p>
                        <p>Kembali: Rp ${this.formatRupiah(this.lastTransaction.change)}</p>
                        <hr>
                        <p style="text-align:center;">Terima kasih 💖</p>
                    </div>
                `;

                let printWindow = window.open('', '', 'width=400,height=600');

                printWindow.document.write(receipt);
                printWindow.document.close();
                printWindow.print();
            },

            formatRupiah(number) {
                return new Intl.NumberFormat('id-ID').format(number);
            }
        }
    }
</script>

@endsection