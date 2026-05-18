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
            <h1 class="text-xl font-extrabold text-pink-500 leading-tight">
                MATANU BEAUTY
            </h1>

            <p class="text-xs text-gray-400 font-semibold tracking-widest">
                STORE POS
            </p>
        </div>

        <nav class="space-y-3">

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