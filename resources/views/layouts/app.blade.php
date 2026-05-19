<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>MATANU BEAUTY STORE</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body class="font-[Plus_Jakarta_Sans] bg-gradient-to-br from-pink-50 via-white to-rose-50 text-gray-800">

<div class="min-h-screen flex">

    <!-- Sidebar -->
    <aside class="hidden md:flex w-72 bg-white/90 backdrop-blur-xl border-r border-pink-100 flex-col p-6">

        <div class="sidebar-brand mb-10">

    <div class="sidebar-brand mb-10">
        <div class="p-5 rounded-[32px] bg-gradient-to-br from-white via-pink-50 to-rose-50 border border-pink-100 shadow-xl text-center">

        <img
            src="{{ asset('images/logo.png') }}"
            alt="Logo"
            class="w-24 h-24 mx-auto object-contain rounded-3xl mb-3
                brightness-125 contrast-125 saturate-150
                drop-shadow-[0_0_25px_rgba(236,72,153,0.55)]
                hover:scale-105 transition duration-500
                logo-glow">

            <h1 class="text-xl font-extrabold text-pink-500 leading-tight tracking-wide">
                MATANU BEAUTY
            </h1>

            <p class="text-xs text-gray-400 font-bold tracking-[0.35em] mt-1">
                STORE POS
            </p>

        </div>
    </div>

        </div>

        <nav class="space-y-3">
            @if(auth()->user()->role === 'admin')
                <!-- menu Produk / Laporan -->
                <a href="/"
                class="menu-item flex items-center gap-3 p-4 rounded-2xl transition {{ request()->is('dashboard') ? 'bg-gradient-to-r from-pink-500 to-rose-400 text-white shadow-lg shadow-pink-200' : 'text-gray-800 bg-white shadow-sm border border-pink-50 hover:bg-pink-50 hover:text-pink-500' }}">

                    <i data-lucide="layout-dashboard" class="w-5 h-5"></i>

                    <span class="font-semibold">Dashboard</span>
                </a>

                <a href="/products"
                class="menu-item flex items-center gap-3 p-4 rounded-2xl transition {{ request()->is('products') ? 'bg-gradient-to-r from-pink-500 to-rose-400 text-white shadow-lg shadow-pink-200' : 'text-gray-800 bg-white shadow-sm border border-pink-50 hover:bg-pink-50 hover:text-pink-500' }}">

                    <i data-lucide="package" class="w-5 h-5"></i>

                    <span class="font-semibold">Produk</span>
                </a>

                <a href="/pos"
                class="menu-item flex items-center gap-3 p-4 rounded-2xl transition {{ request()->is('pos') ? 'bg-gradient-to-r from-pink-500 to-rose-400 text-white shadow-lg shadow-pink-200' : 'text-gray-800 bg-white shadow-sm border border-pink-50 hover:bg-pink-50 hover:text-pink-500' }}">

                    <i data-lucide="shopping-cart" class="w-5 h-5"></i>

                    <span class="font-semibold">Kasir POS</span>
                </a>

                <a href="/transactions"
                class="menu-item flex items-center gap-3 p-4 rounded-2xl transition {{ request()->is('transactions') ? 'bg-gradient-to-r from-pink-500 to-rose-400 text-white shadow-lg shadow-pink-200' : 'text-gray-800 bg-white shadow-sm border border-pink-50 hover:bg-pink-50 hover:text-pink-500' }}">

                    <i data-lucide="receipt-text" class="w-5 h-5"></i>

                    <span class="font-semibold">Transaksi</span>
                </a>

                <a href="/reports"
                class="menu-item flex items-center gap-3 p-4 rounded-2xl transition {{ request()->is('reports') ? 'bg-gradient-to-r from-pink-500 to-rose-400 text-white shadow-lg shadow-pink-200' : 'text-gray-800 bg-white shadow-sm border border-pink-50 hover:bg-pink-50 hover:text-pink-500' }}">

                    <i data-lucide="bar-chart-3" class="w-5 h-5"></i>

                    <span class="font-semibold">Laporan</span>
                </a>
                @if(auth()->user()->role === 'admin')
                <a href="/stock-movements"
                class="menu-item flex items-center gap-3 p-4 rounded-2xl transition {{ request()->is('stock-movements') ? 'bg-gradient-to-r from-pink-500 to-rose-400 text-white shadow-lg shadow-pink-200' : 'text-gray-800 bg-white shadow-sm border border-pink-50 hover:bg-pink-50 hover:text-pink-500' }}">
                    <i data-lucide="history" class="w-5 h-5"></i>
                    <span class="font-semibold">Histori Stok</span>
                </a>
                @endif
            
                @if(auth()->user()->role === 'admin')
                <a href="/expired-products"
                class="menu-item flex items-center gap-3 p-4 rounded-2xl transition {{ request()->is('expired-products') ? 'bg-gradient-to-r from-pink-500 to-rose-400 text-white shadow-lg shadow-pink-200' : 'text-gray-800 bg-white shadow-sm border border-pink-50 hover:bg-pink-50 hover:text-pink-500' }}">
                    <i data-lucide="calendar" class="w-5 h-5"></i>
                    <span class="font-semibold">Expired</span>
                </a>
                @endif

            @if(auth()->user()->role === 'admin')
            <a href="/customer-orders"
            class="menu-item flex items-center gap-3 p-4 rounded-2xl transition {{ request()->is('customer-orders') ? 'bg-gradient-to-r from-pink-500 to-rose-400 text-white shadow-lg shadow-pink-200' : 'text-gray-800 bg-white shadow-sm border border-pink-50 hover:bg-pink-50 hover:text-pink-500' }}">
                <i data-lucide="shopping-basket" class="w-5 h-5"></i>
                <span class="font-semibold">Pesanan Online</span>
            </a>
            @endif
            
            <a href="/users"
            class="menu-item flex items-center gap-3 p-4 rounded-2xl transition {{ request()->is('users') ? 'bg-gradient-to-r from-pink-500 to-rose-400 text-white shadow-lg shadow-pink-200' : 'text-gray-800 bg-white shadow-sm border border-pink-50 hover:bg-pink-50 hover:text-pink-500' }}">
                <i data-lucide="users" class="w-5 h-5"></i>
                <span class="font-semibold">User</span>
            </a>

            @endif

        </nav>

        <div class="mt-auto pt-6">

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button
                    class="w-full py-4 rounded-2xl bg-gray-100 hover:bg-red-50 hover:text-red-500 transition font-bold">

                    Logout

                </button>
            </form>

        </div>

    </aside>

    <!-- Content -->
    <main class="flex-1 p-6 pb-32 md:pb-6">

        @yield('content')

    </main>

</div>

</body>
</html>