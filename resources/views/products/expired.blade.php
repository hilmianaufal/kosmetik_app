@extends('layouts.app')

@section('content')

<h1 class="dashboard-title text-3xl font-extrabold text-gray-800 mb-2">
    Produk Hampir Expired
</h1>

<p class="text-gray-500 mb-6">
    Produk kosmetik yang akan expired dalam 30 hari
</p>

<div class="bg-white/90 backdrop-blur-xl rounded-[36px] p-6 shadow-xl border border-orange-100">

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="text-sm text-gray-400 border-b border-orange-100">
                    <th class="py-4">Produk</th>
                    <th>Brand</th>
                    <th>Stok</th>
                    <th>Expired</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($products as $product)
                    <tr class="border-b border-orange-50">
                        <td class="py-4 font-bold text-gray-800">
                            {{ $product->name }}
                        </td>

                        <td class="text-gray-500">
                            {{ $product->brand ?? '-' }}
                        </td>

                        <td class="font-bold">
                            {{ $product->stock }}
                        </td>

                        <td class="font-bold text-orange-500">
                            {{ \Carbon\Carbon::parse($product->expired_date)->format('d M Y') }}
                        </td>

                        <td>
                            <span class="px-4 py-2 rounded-xl bg-orange-50 text-orange-500 font-extrabold text-sm">
                                Segera Cek
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-12 text-center text-gray-400">
                            Tidak ada produk hampir expired
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection