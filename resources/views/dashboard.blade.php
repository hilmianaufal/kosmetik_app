@extends('layouts.app')

@section('content')

<h1 class="dashboard-title text-3xl font-extrabold mb-2">
    Dashboard
</h1>

<p class="text-gray-500 mb-8">
    Ringkasan penjualan MATANU BEAUTY STORE hari ini
</p>

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

    <div class="stat-card bg-white/80 backdrop-blur-xl p-6 rounded-[32px] shadow-xl border border-pink-100 hover:-translate-y-1 transition duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 font-medium">Penjualan Hari Ini</p>
                <h2 class="text-3xl font-extrabold mt-3 text-gray-800">Rp {{ number_format($todaySales, 0, ',', '.') }}</h2>
                <p class="text-sm text-pink-500 mt-2 font-semibold">+12% dari kemarin</p>
            </div>

            <div class="w-16 h-16 rounded-3xl bg-gradient-to-br from-pink-400 to-rose-500 flex items-center justify-center shadow-lg">
                <i data-lucide="wallet" class="w-8 h-8 text-white"></i>
            </div>
        </div>
    </div>

    <div class="stat-card bg-white/80 backdrop-blur-xl p-6 rounded-[32px] shadow-xl border border-purple-100 hover:-translate-y-1 transition duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 font-medium">Total Produk</p>
                <h2 class="text-3xl font-extrabold mt-3 text-gray-800">{{ $totalProducts }}</h2>
                <p class="text-sm text-purple-500 mt-2 font-semibold">8 stok menipis</p>
            </div>

            <div class="w-16 h-16 rounded-3xl bg-gradient-to-br from-purple-400 to-fuchsia-500 flex items-center justify-center shadow-lg">
                <i data-lucide="package" class="w-8 h-8 text-white"></i>
            </div>
        </div>
    </div>

    <div class="stat-card bg-white/80 backdrop-blur-xl p-6 rounded-[32px] shadow-xl border border-blue-100 hover:-translate-y-1 transition duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 font-medium">Transaksi</p>
                <h2 class="text-3xl font-extrabold mt-3 text-gray-800">{{ $totalTransactions }}</h2>
                <p class="text-sm text-blue-500 mt-2 font-semibold">Hari ini</p>
            </div>

            <div class="w-16 h-16 rounded-3xl bg-gradient-to-br from-blue-400 to-cyan-500 flex items-center justify-center shadow-lg">
                <i data-lucide="shopping-bag" class="w-8 h-8 text-white"></i>
            </div>
        </div>
    </div>

    <div class="stat-card bg-white/80 backdrop-blur-xl p-6 rounded-[32px] shadow-xl border border-emerald-100 hover:-translate-y-1 transition duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 font-medium">Stok Menipis</p>
                <h2 class="text-3xl font-extrabold mt-3 text-gray-800">{{ $lowStockProducts }}</h2>
                <p class="text-sm text-emerald-500 mt-2 font-semibold">Produk perlu restock</p>
            </div>

            <div class="w-16 h-16 rounded-3xl bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center shadow-lg">
                <i data-lucide="users" class="w-8 h-8 text-white"></i>
            </div>
        </div>
    </div>

</div>
<div class="bg-white rounded-[32px] p-6 shadow-xl border border-pink-100 mt-8">

    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-extrabold text-gray-800">
                Grafik Penjualan
            </h2>

            <p class="text-gray-400 text-sm mt-1">
                7 hari terakhir
            </p>
        </div>
    </div>

    <canvas id="salesChart" height="100"></canvas>

</div>

<script>
    const salesCtx = document.getElementById('salesChart');

    new Chart(salesCtx, {
        type: 'line',
        data: {
            labels: @json($salesChart->pluck('date')),
            datasets: [{
                label: 'Penjualan',
                data: @json($salesChart->pluck('total')),
                borderColor: '#ec4899',
                backgroundColor: 'rgba(236,72,153,0.1)',
                tension: 0.4,
                fill: true,
            }]
        },
        options: {
            responsive: true,
        }
    });
</script>
@endsection