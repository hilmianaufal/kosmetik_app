@extends('layouts.app')

@section('content')

<h1 class="dashboard-title text-3xl font-extrabold text-gray-800 mb-2">
    Histori Stok
</h1>

<p class="text-gray-500 mb-6">
    Riwayat keluar masuk stok produk MATANU BEAUTY STORE
</p>

<div class="bg-white/90 backdrop-blur-xl rounded-[36px] p-6 shadow-xl border border-pink-100">

    <div class="overflow-x-auto">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari produk / brand..."
                class="p-4 rounded-2xl border border-pink-100 outline-none focus:border-pink-400">

            <select
                name="type"
                class="p-4 rounded-2xl border border-pink-100 outline-none focus:border-pink-400">
                <option value="">Semua Tipe</option>
                <option value="in" {{ request('type') === 'in' ? 'selected' : '' }}>Stok Masuk</option>
                <option value="out" {{ request('type') === 'out' ? 'selected' : '' }}>Stok Keluar</option>
            </select>

            <button class="rounded-2xl bg-pink-500 text-white font-extrabold">
                Filter
            </button>

        </form>
        <table class="w-full text-left">
            <thead>
                <tr class="text-sm text-gray-400 border-b border-pink-100">
                    <th class="py-4">Tanggal</th>
                    <th>Produk</th>
                    <th>Tipe</th>
                    <th>Qty</th>
                    <th>Catatan</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($movements as $movement)
                    <tr class="border-b border-pink-50">
                        <td class="py-4 text-gray-500">
                            {{ $movement->created_at->format('d M Y H:i') }}
                        </td>

                        <td class="font-bold text-gray-800">
                            {{ $movement->product->name ?? 'Produk Dihapus' }}
                        </td>

                        <td>
                            <span class="px-4 py-2 rounded-xl text-sm font-extrabold {{ $movement->type === 'in' ? 'bg-emerald-50 text-emerald-500' : 'bg-red-50 text-red-500' }}">
                                {{ $movement->type === 'in' ? 'Masuk' : 'Keluar' }}
                            </span>
                        </td>

                        <td class="font-extrabold">
                            {{ $movement->qty }}
                        </td>

                        <td class="text-gray-500">
                            {{ $movement->note ?? '-' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-12 text-center text-gray-400">
                            Belum ada histori stok
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection