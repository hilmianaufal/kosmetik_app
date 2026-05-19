@extends('layouts.app')

@section('content')

<div class="space-y-8">

    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
        <div>
            <h1 class="dashboard-title text-4xl font-black text-gray-800 tracking-tight">
                Dashboard
            </h1>

            <p class="page-subtitle text-gray-500 mt-2">
                Ringkasan performa MATANU BEAUTY STORE hari ini
            </p>
        </div>

        <a href="/pos"
           class="inline-flex items-center justify-center gap-3 px-6 py-4 rounded-3xl bg-gradient-to-r from-pink-500 to-rose-400 text-white font-extrabold shadow-xl shadow-pink-200 hover:scale-[1.02] transition">
            <i data-lucide="shopping-cart" class="w-5 h-5"></i>
            Buka Kasir
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-5 gap-6">

        <div class="stat-card relative overflow-hidden bg-white/80 backdrop-blur-xl p-6 rounded-[34px] shadow-xl border border-pink-100">
            <div class="absolute -right-8 -top-8 w-28 h-28 bg-pink-200/50 rounded-full blur-2xl"></div>
            <div class="relative flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-bold">Penjualan Hari Ini</p>
                    <h2 class="text-3xl font-black mt-3 text-gray-800">
                        Rp {{ number_format($todaySales, 0, ',', '.') }}
                    </h2>
                    <p class="text-sm text-pink-500 mt-2 font-bold">Realtime hari ini</p>
                </div>

                <div class="w-16 h-16 rounded-3xl bg-gradient-to-br from-pink-400 to-rose-500 flex items-center justify-center shadow-lg shadow-pink-200">
                    <i data-lucide="wallet" class="w-8 h-8 text-white"></i>
                </div>
            </div>
        </div>

        <div class="stat-card relative overflow-hidden bg-white/80 backdrop-blur-xl p-6 rounded-[34px] shadow-xl border border-purple-100">
            <div class="absolute -right-8 -top-8 w-28 h-28 bg-purple-200/50 rounded-full blur-2xl"></div>
            <div class="relative flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-bold">Total Produk</p>
                    <h2 class="text-3xl font-black mt-3 text-gray-800">{{ $totalProducts }}</h2>
                    <p class="text-sm text-purple-500 mt-2 font-bold">Produk aktif</p>
                </div>

                <div class="w-16 h-16 rounded-3xl bg-gradient-to-br from-purple-400 to-fuchsia-500 flex items-center justify-center shadow-lg">
                    <i data-lucide="package" class="w-8 h-8 text-white"></i>
                </div>
            </div>
        </div>

        <div class="stat-card relative overflow-hidden bg-white/80 backdrop-blur-xl p-6 rounded-[34px] shadow-xl border border-blue-100">
            <div class="absolute -right-8 -top-8 w-28 h-28 bg-blue-200/50 rounded-full blur-2xl"></div>
            <div class="relative flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-bold">Transaksi</p>
                    <h2 class="text-3xl font-black mt-3 text-gray-800">{{ $totalTransactions }}</h2>
                    <p class="text-sm text-blue-500 mt-2 font-bold">Transaksi hari ini</p>
                </div>

                <div class="w-16 h-16 rounded-3xl bg-gradient-to-br from-blue-400 to-cyan-500 flex items-center justify-center shadow-lg">
                    <i data-lucide="shopping-bag" class="w-8 h-8 text-white"></i>
                </div>
            </div>
        </div>

        <div class="stat-card relative overflow-hidden bg-white/80 backdrop-blur-xl p-6 rounded-[34px] shadow-xl border border-red-100">
            <div class="absolute -right-8 -top-8 w-28 h-28 bg-red-200/50 rounded-full blur-2xl"></div>
            <div class="relative flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-bold">Stok Menipis</p>
                    <h2 class="text-3xl font-black mt-3 text-gray-800">{{ $lowStockProducts }}</h2>
                    <p class="text-sm text-red-500 mt-2 font-bold">Perlu restock</p>
                </div>

                <div class="w-16 h-16 rounded-3xl bg-gradient-to-br from-red-400 to-orange-500 flex items-center justify-center shadow-lg">
                    <i data-lucide="alert-triangle" class="w-8 h-8 text-white"></i>
                </div>
            </div>
        </div>

        <div class="stat-card relative overflow-hidden bg-white/80 backdrop-blur-xl p-6 rounded-[34px] shadow-xl border border-emerald-100">
            <div class="absolute -right-8 -top-8 w-28 h-28 bg-emerald-200/50 rounded-full blur-2xl"></div>

            <div class="relative flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-bold">Laba Hari Ini</p>
                    <h2 class="text-3xl font-black mt-3 text-gray-800">
                        Rp {{ number_format($todayProfit, 0, ',', '.') }}
                    </h2>
                    <p class="text-sm text-emerald-500 mt-2 font-bold">Profit bersih produk</p>
                </div>

                <div class="w-16 h-16 rounded-3xl bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center shadow-lg">
                    <i data-lucide="trending-up" class="w-8 h-8 text-white"></i>
                </div>
            </div>
        </div>

    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        <div class="stat-card xl:col-span-2 bg-white/85 backdrop-blur-xl rounded-[36px] p-6 shadow-xl border border-pink-100">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                <div>
                    <h2 class="text-2xl font-black text-gray-800">
                        Grafik Penjualan
                    </h2>
                    <p class="text-gray-400 text-sm mt-1">
                        7 hari terakhir
                    </p>
                </div>

                <span class="px-4 py-2 rounded-2xl bg-pink-50 text-pink-500 font-extrabold text-sm">
                    Sales Analytics
                </span>
            </div>

            <div class="h-[280px]">
                <canvas id="salesChart"></canvas>
            </div>
        </div>

        <div class="stat-card bg-gradient-to-br from-pink-500 via-rose-400 to-pink-300 rounded-[36px] p-6 shadow-xl shadow-pink-200 text-white overflow-hidden relative">
            <div class="absolute -right-12 -top-12 w-40 h-40 bg-white/20 rounded-full blur-2xl"></div>
            <div class="absolute -left-10 -bottom-10 w-36 h-36 bg-white/10 rounded-full blur-2xl"></div>

            <div class="relative">
                <div class="w-16 h-16 rounded-3xl bg-white/20 backdrop-blur-xl flex items-center justify-center mb-6">
                    <i data-lucide="sparkles" class="w-8 h-8"></i>
                </div>

                <h2 class="text-3xl font-black leading-tight">
                    Beauty POS Premium
                </h2>

                <p class="text-white/80 mt-3">
                    Kelola penjualan, produk, stok, dan laporan toko kosmetik dalam satu sistem.
                </p>

                <a href="/reports"
                   class="inline-flex mt-8 px-5 py-3 rounded-2xl bg-white text-pink-500 font-extrabold shadow-lg">
                    Lihat Laporan
                </a>
            </div>
        </div>

    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        <div class="stat-card xl:col-span-2 bg-white/85 backdrop-blur-xl rounded-[36px] p-6 shadow-xl border border-pink-100">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-black text-gray-800">
                        Transaksi Terbaru
                    </h2>
                    <p class="text-gray-400 text-sm mt-1">
                        Aktivitas kasir terbaru
                    </p>
                </div>

                <a href="/transactions" class="text-pink-500 font-extrabold text-sm">
                    Lihat Semua
                </a>
            </div>

            <div class="space-y-4">
                @forelse ($recentTransactions as $transaction)
                    <a href="/transactions/{{ $transaction->id }}"
                       class="flex items-center justify-between gap-4 p-4 rounded-3xl border border-pink-50 hover:bg-pink-50/60 transition">

                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-pink-100 text-pink-500 flex items-center justify-center">
                                <i data-lucide="receipt-text" class="w-6 h-6"></i>
                            </div>

                            <div>
                                <h3 class="font-extrabold text-gray-800">
                                    Transaksi #{{ $transaction->id }}
                                </h3>
                                <p class="text-sm text-gray-400">
                                    {{ $transaction->created_at->format('d M Y H:i') }}
                                </p>
                            </div>
                        </div>

                        <h2 class="font-black text-pink-500 whitespace-nowrap">
                            Rp {{ number_format($transaction->total, 0, ',', '.') }}
                        </h2>
                    </a>
                @empty
                    <div class="text-center py-12 text-gray-400">
                        <div class="text-5xl mb-3">🧾</div>
                        Belum ada transaksi
                    </div>
                @endforelse
            </div>
        </div>

        <div class="stat-card bg-white/85 backdrop-blur-xl rounded-[36px] p-6 shadow-xl border border-red-100">
            <h2 class="text-2xl font-black text-gray-800 mb-6">
                Stok Menipis
            </h2>

            <div class="space-y-4">
                @forelse ($lowStockList as $product)
                    <div class="flex items-center justify-between gap-4 p-4 rounded-3xl bg-red-50/60 border border-red-100">
                        <div>
                            <h3 class="font-extrabold text-gray-800">
                                {{ $product->name }}
                            </h3>
                            <p class="text-sm text-gray-400">
                                {{ $product->brand }}
                            </p>
                        </div>

                        <span class="px-4 py-2 rounded-2xl bg-red-500 text-white font-black">
                            {{ $product->stock }}
                        </span>
                    </div>
                @empty
                    <div class="text-center py-12 text-gray-400">
                        <div class="text-5xl mb-3">✅</div>
                        Stok aman
                    </div>
                @endforelse
            </div>
        </div>

    </div>

    <div class="stat-card bg-white/85 backdrop-blur-xl rounded-[36px] p-6 shadow-xl border border-pink-100">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-black text-gray-800">
                    Produk Terlaris
                </h2>
                <p class="text-gray-400 text-sm mt-1">
                    Ranking produk berdasarkan total penjualan
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-4">
            @forelse ($bestSellingProducts as $item)
                <div class="rounded-[30px] p-5 bg-gradient-to-br from-pink-50 to-white border border-pink-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-pink-500 text-white flex items-center justify-center mb-4">
                        <i data-lucide="crown" class="w-6 h-6"></i>
                    </div>

                    <h3 class="font-black text-gray-800">
                        {{ $item->product->name ?? 'Produk Dihapus' }}
                    </h3>

                    <p class="text-sm text-gray-400 mt-1">
                        Total terjual
                    </p>

                    <span class="inline-flex mt-4 px-4 py-2 rounded-2xl bg-pink-500 text-white font-black">
                        {{ $item->total_qty }} pcs
                    </span>
                </div>
            @empty
                <div class="col-span-full text-center py-12 text-gray-400">
                    <div class="text-5xl mb-3">👑</div>
                    Belum ada produk terjual
                </div>
            @endforelse
        </div>
    </div>

</div>
<div class="stat-card bg-white/85 backdrop-blur-xl rounded-[36px] p-6 shadow-xl border border-orange-100">

    <h2 class="text-2xl font-black text-gray-800 mb-6">
        Produk Hampir Expired
    </h2>

    <div class="space-y-4">
        @forelse ($almostExpiredProducts as $product)
            <div class="flex items-center justify-between gap-4 p-4 rounded-3xl bg-orange-50/70 border border-orange-100">
                <div>
                    <h3 class="font-extrabold text-gray-800">
                        {{ $product->name }}
                    </h3>

                    <p class="text-sm text-gray-400">
                        {{ $product->brand }}
                    </p>
                </div>

                <span class="px-4 py-2 rounded-2xl bg-orange-500 text-white font-black">
                    {{ \Carbon\Carbon::parse($product->expired_date)->format('d M Y') }}
                </span>
            </div>
        @empty
            <div class="text-center py-12 text-gray-400">
                Tidak ada produk hampir expired
            </div>
        @endforelse
    </div>

</div>
<script>
    const salesCtx = document.getElementById('salesChart');

    if (salesCtx) {
        new Chart(salesCtx, {
            type: 'line',
            data: {
                labels: @json($salesChart->pluck('date')),
                datasets: [{
                    label: 'Penjualan',
                    data: @json($salesChart->pluck('total')),
                    borderColor: '#ec4899',
                    backgroundColor: 'rgba(236,72,153,0.12)',
                    tension: 0.45,
                    fill: true,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        grid: {
                            color: 'rgba(236,72,153,0.08)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    }
</script>

@endsection