<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MATANU BEAUTY STORE</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>

<body class="bg-gradient-to-br from-pink-50 via-white to-rose-50 font-[Plus_Jakarta_Sans] text-gray-800">

<div x-data="shopApp(@js($products))" class="min-h-screen pb-32">

    @if(session('success'))
        <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
             class="fixed top-5 left-1/2 -translate-x-1/2 z-[999] w-[92%] max-w-md">
            <div class="bg-white border border-emerald-100 shadow-2xl rounded-[28px] p-5 flex items-start gap-4">
                <div class="w-14 h-14 rounded-2xl bg-emerald-100 flex items-center justify-center text-2xl">✅</div>

                <div class="flex-1">
                    <h3 class="font-black text-emerald-500 text-lg">Pesanan Berhasil</h3>
                    <p class="text-gray-500 text-sm mt-1">{{ session('success') }}</p>
                </div>

                <button @click="show = false" class="text-gray-400 hover:text-gray-600 font-black">✕</button>
            </div>
        </div>
    @endif

    <header class="sticky top-0 z-40 bg-white/80 backdrop-blur-xl border-b border-pink-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-pink-400 to-rose-400 p-2 shadow-lg shadow-pink-200">
                    <img src="{{ asset('images/logo.png') }}" class="w-full h-full object-contain brightness-125 contrast-125 saturate-150">
                </div>

                <div>
                    <h1 class="font-black text-pink-500 leading-tight tracking-wide">MATANU BEAUTY</h1>
                    <p class="text-xs text-gray-400 font-semibold">Premium Beauty Store</p>
                </div>
            </div>

            <button @click="cartOpen = true"
                    class="hidden sm:flex items-center gap-2 px-5 py-3 rounded-2xl bg-pink-500 text-white font-extrabold shadow-lg shadow-pink-200">
                🛒 <span>Cart</span>
                <span x-show="cart.length > 0" class="bg-white text-pink-500 px-2 py-1 rounded-full text-xs" x-text="cartCount()"></span>
            </button>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-3 sm:px-6 py-4 sm:py-6">

        <section class="hidden md:block relative overflow-hidden rounded-[36px] bg-gradient-to-br from-pink-500 via-rose-400 to-pink-300 p-10 lg:p-12 text-white shadow-2xl shadow-pink-200 mb-7">
            <div class="absolute -top-20 -right-16 w-56 h-56 bg-white/20 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-24 -left-20 w-72 h-72 bg-pink-100/20 rounded-full blur-3xl"></div>

            <div class="relative grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                <div>
                    <span class="inline-flex px-4 py-2 rounded-full bg-white/20 backdrop-blur-xl text-sm font-bold mb-4">
                        ✨ Beauty Deals Today
                    </span>

                    <h2 class="text-5xl lg:text-6xl font-black leading-tight">
                        Glow up dari rumah dengan mudah
                    </h2>

                    <p class="text-white/85 mt-4 max-w-xl">
                        Pilih produk favoritmu, masukkan ke keranjang, lalu checkout dengan QRIS manual.
                    </p>

                    <button @click="scrollToProducts()"
                            class="mt-6 px-6 py-4 rounded-2xl bg-white text-pink-500 font-black shadow-xl">
                        Belanja Sekarang
                    </button>
                </div>

                <div class="hidden lg:flex justify-center">
                    <div class="w-72 h-72 rounded-[60px] bg-white/20 backdrop-blur-xl border border-white/30 p-8 shadow-2xl">
                        <img src="{{ asset('images/logo.png') }}" class="w-full h-full object-contain brightness-125 contrast-125 saturate-150">
                    </div>
                </div>
            </div>
        </section>

        <section id="products-section" class="mb-4 sm:mb-6">
            <div class="bg-white/90 backdrop-blur-xl rounded-[24px] sm:rounded-[30px] p-3 sm:p-4 shadow-xl border border-pink-100">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-2xl bg-pink-50 flex items-center justify-center text-pink-500">
                        🔍
                    </div>

                    <input x-model="search" type="text" placeholder="Cari produk..."
                           class="w-full outline-none bg-transparent text-gray-700 placeholder:text-gray-400">
                </div>
            </div>
        </section>

        <section class="mb-5 sm:mb-7">
            <div class="flex gap-2 sm:gap-3 overflow-x-auto pb-2 no-scrollbar">
                <button @click="selectedCategory = 'all'"
                        :class="selectedCategory === 'all' ? 'bg-pink-500 text-white shadow-pink-200' : 'bg-white text-gray-500'"
                        class="px-4 sm:px-5 py-2.5 sm:py-3 rounded-2xl font-black shadow-lg border border-pink-100 whitespace-nowrap transition text-sm sm:text-base">
                    Semua
                </button>

                <template x-for="category in categories()" :key="category">
                    <button @click="selectedCategory = category"
                            :class="selectedCategory === category ? 'bg-pink-500 text-white shadow-pink-200' : 'bg-white text-gray-500'"
                            class="px-4 sm:px-5 py-2.5 sm:py-3 rounded-2xl font-black shadow-lg border border-pink-100 whitespace-nowrap transition text-sm sm:text-base"
                            x-text="category">
                    </button>
                </template>
            </div>
        </section>

        <section>
            <div class="flex items-center justify-between mb-4 sm:mb-5">
                <div>
                    <h2 class="text-xl sm:text-2xl font-black text-gray-800">Produk Pilihan</h2>
                    <p class="text-xs sm:text-sm text-gray-400">Koleksi kosmetik terbaik untuk kamu</p>
                </div>
            </div>

            <div class="grid grid-cols-4 sm:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-2 sm:gap-5">
                <template x-for="product in filteredProducts()" :key="product.id">
                    <div class="group bg-white/90 backdrop-blur-xl rounded-[18px] sm:rounded-[30px] p-2 sm:p-3 shadow-lg sm:shadow-xl border border-pink-100 hover:-translate-y-2 hover:shadow-2xl transition duration-300">

                       <div
                            @click="addToCart(product)"
                                class="relative w-full aspect-square rounded-[14px] sm:rounded-[26px] overflow-hidden bg-gradient-to-br from-pink-50 to-rose-50 mb-2 sm:mb-4 cursor-pointer active:scale-95 transition">
                            <template x-if="product.image">
                                <img :src="imageUrl(product.image)"
                                     class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                            </template>

                            <template x-if="!product.image">
                                <div class="w-full h-full flex items-center justify-center text-3xl sm:text-6xl">💄</div>
                            </template>

                            <div class="absolute top-1.5 left-1.5 sm:top-3 sm:left-3 px-1.5 sm:px-3 py-0.5 sm:py-1 rounded-full bg-white/90 backdrop-blur-xl text-[8px] sm:text-[11px] font-black text-pink-500">
                                Stok <span x-text="product.stock"></span>
                            </div>
                        </div>

                        <h3 class="font-black text-gray-800 text-[10px] sm:text-base leading-tight min-h-[30px] sm:min-h-[40px] line-clamp-2" x-text="product.name"></h3>

                        <p class="text-[9px] sm:text-xs text-gray-400 mt-1 truncate" x-text="product.brand"></p>

                        <p class="text-pink-500 font-black text-[10px] sm:text-base mt-2 sm:mt-4">
                            Rp <span x-text="formatRupiah(product.price)"></span>
                        </p>
                    </div>
                </template>
            </div>

            <div x-show="filteredProducts().length === 0" class="text-center py-20 text-gray-400">
                <div class="text-6xl mb-4">🔎</div>
                <p class="font-bold">Produk tidak ditemukan</p>
            </div>
        </section>
    </main>

    <nav class="fixed bottom-0 left-0 right-0 z-50 sm:hidden px-4 pb-4">
        <div class="bg-white/95 backdrop-blur-xl border border-pink-100 shadow-2xl rounded-[30px] px-5 py-4 flex items-center justify-between">
            <button @click="scrollToTop()" class="flex flex-col items-center text-pink-500">
                <span class="text-xl">🏠</span>
                <span class="text-[11px] font-bold mt-1">Home</span>
            </button>

            <button @click="scrollToProducts()" class="flex flex-col items-center text-gray-400">
                <span class="text-xl">💄</span>
                <span class="text-[11px] font-bold mt-1">Produk</span>
            </button>

            <button @click="cartOpen = true"
                    class="relative w-16 h-16 rounded-full bg-gradient-to-r from-pink-500 to-rose-400 text-white flex items-center justify-center shadow-2xl -mt-10 border-4 border-white">
                <span class="text-2xl">🛒</span>
                <span x-show="cart.length > 0" x-text="cartCount()"
                      class="absolute -top-1 -right-1 bg-white text-pink-500 text-xs font-black w-7 h-7 rounded-full flex items-center justify-center shadow">
                </span>
            </button>

            <a href="/shop/order-status" class="flex flex-col items-center text-gray-400">
                <span class="text-xl">📦</span>
                <span class="text-[11px] font-bold mt-1">Status</span>
            </a>

            <a href="https://wa.me/6281234567890" target="_blank" class="flex flex-col items-center text-gray-400">
                <span class="text-xl">💬</span>
                <span class="text-[11px] font-bold mt-1">WA</span>
            </a>
        </div>
    </nav>

    <button @click="cartOpen = true"
            class="hidden sm:flex fixed bottom-8 right-8 z-50 px-6 py-4 rounded-3xl bg-gradient-to-r from-pink-500 to-rose-400 text-white font-black shadow-2xl shadow-pink-200 items-center gap-3">
        🛒 Keranjang
        <span x-show="cart.length > 0" class="bg-white text-pink-500 px-3 py-1 rounded-full text-sm" x-text="cartCount()"></span>
    </button>

    <div x-show="cartOpen" x-transition.opacity
         class="fixed inset-0 z-[60] bg-black/40 backdrop-blur-sm flex items-end sm:items-center sm:justify-center">

        <div @click.away="cartOpen = false" x-transition
             class="bg-white w-full sm:max-w-lg rounded-t-[38px] sm:rounded-[38px] p-6 max-h-[88vh] overflow-y-auto shadow-2xl">

            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-black">Keranjang</h2>
                    <p class="text-sm text-gray-400">Cek pesanan kamu</p>
                </div>

                <button @click="cartOpen = false" class="w-11 h-11 rounded-2xl bg-pink-100 text-pink-500 font-black">✕</button>
            </div>

            <div x-show="cart.length === 0" class="text-center py-14 text-gray-400">
                <div class="text-6xl mb-4">🛒</div>
                <p class="font-bold">Keranjang masih kosong</p>
            </div>

            <div class="space-y-4">
                <template x-for="item in cart" :key="item.id">
                    <div class="flex items-center gap-4 border-b border-pink-50 pb-4">
                        <div class="w-16 h-16 rounded-2xl overflow-hidden bg-pink-50 shrink-0">
                            <template x-if="item.image">
                                <img :src="imageUrl(item.image)" class="w-full h-full object-cover">
                            </template>
                            <template x-if="!item.image">
                                <div class="w-full h-full flex items-center justify-center text-3xl">💄</div>
                            </template>
                        </div>

                        <div class="flex-1">
                            <p class="font-black text-gray-800" x-text="item.name"></p>
                            <p class="text-sm text-gray-400">Rp <span x-text="formatRupiah(item.price)"></span></p>

                            <div class="flex items-center gap-2 mt-2">
                                <button @click="decreaseQty(item.id)" class="w-8 h-8 rounded-xl bg-pink-100 text-pink-500 font-black">-</button>
                                <span class="font-black" x-text="item.qty"></span>
                                <button @click="increaseQty(item.id)" class="w-8 h-8 rounded-xl bg-pink-500 text-white font-black">+</button>
                            </div>
                        </div>

                        <p class="font-black text-pink-500">
                            Rp <span x-text="formatRupiah(item.price * item.qty)"></span>
                        </p>
                    </div>
                </template>
            </div>

            <div class="border-t border-pink-100 mt-5 pt-5">
                <div class="flex justify-between text-xl font-black">
                    <span>Total</span>
                    <span class="text-pink-500">Rp <span x-text="formatRupiah(total())"></span></span>
                </div>
            <form action="{{ route('shop.checkout') }}" method="POST">
                @csrf

                <textarea name="items" class="hidden" x-text="JSON.stringify(cart)"></textarea>

                <button
                    :disabled="cart.length === 0"
                    class="w-full py-4 rounded-2xl bg-gradient-to-r from-pink-500 to-rose-400 text-white font-black shadow-xl disabled:opacity-40">
                    Lanjutkan Pembayaran
                </button>
            </form>
            </div>
        </div>
    </div>

</div>

<script>
    function shopApp(products = []) {
        return {
            products,
            search: '',
            selectedCategory: 'all',
            cart: [],
            cartOpen: false,

            categories() {
                return [...new Set(this.products.map(product => product.category).filter(Boolean))];
            },

            filteredProducts() {
                const keyword = this.search.toLowerCase();

                return this.products.filter(product => {
                    const matchSearch =
                        product.name.toLowerCase().includes(keyword) ||
                        (product.brand ?? '').toLowerCase().includes(keyword);

                    const matchCategory =
                        this.selectedCategory === 'all' ||
                        product.category === this.selectedCategory;

                    return matchSearch && matchCategory;
                });
            },

            imageUrl(image) {
                return image.startsWith('http') ? image : `/storage/${image}`;
            },

            addToCart(product) {
                const item = this.cart.find(i => i.id === product.id);

                if (item) {
                    if (item.qty < product.stock) item.qty++;
                } else {
                    this.cart.push({ ...product, qty: 1 });
                }

                this.cartOpen = true;
            },

            increaseQty(id) {
                const item = this.cart.find(i => i.id === id);
                if (item && item.qty < item.stock) item.qty++;
            },

            decreaseQty(id) {
                const item = this.cart.find(i => i.id === id);

                if (item && item.qty > 1) {
                    item.qty--;
                } else {
                    this.cart = this.cart.filter(i => i.id !== id);
                }
            },

            cartCount() {
                return this.cart.reduce((sum, item) => sum + item.qty, 0);
            },

            total() {
                return this.cart.reduce((sum, item) => sum + item.price * item.qty, 0);
            },

            scrollToProducts() {
                document.getElementById('products-section')?.scrollIntoView({
                    behavior: 'smooth'
                });
            },

            scrollToTop() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            },

            formatRupiah(number) {
                return new Intl.NumberFormat('id-ID').format(number);
            }
        }
    }
</script>

</body>
</html>