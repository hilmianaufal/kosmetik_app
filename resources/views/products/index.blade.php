@extends('layouts.app')

@section('content')

<h1 class="dashboard-title text-3xl font-extrabold text-gray-800 mb-2">
    Produk
</h1>

<p class="text-gray-500 mb-6">
    Kelola produk MATANU BEAUTY STORE
</p>

<div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

    <div class="bg-white/90 rounded-[32px] p-6 shadow-xl border border-pink-100">
        <h2 class="text-xl font-extrabold mb-5">Tambah Produk</h2>

       <form action="/products" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <input name="name" placeholder="Nama Produk" class="w-full p-4 rounded-2xl border border-pink-100 outline-none">
            <input name="brand" placeholder="Brand" class="w-full p-4 rounded-2xl border border-pink-100 outline-none">
            <input name="category" placeholder="Kategori" class="w-full p-4 rounded-2xl border border-pink-100 outline-none">
            <input name="barcode" placeholder="Barcode" class="w-full p-4 rounded-2xl border border-pink-100 outline-none">
            <input name="stock" type="number" placeholder="Stok" class="w-full p-4 rounded-2xl border border-pink-100 outline-none">
            <input name="price" type="number" placeholder="Harga Jual" class="w-full p-4 rounded-2xl border border-pink-100 outline-none">
            <input name="cost_price" type="number" placeholder="Harga Modal" class="w-full p-4 rounded-2xl border border-pink-100 outline-none">
            <input name="expired_date" type="date" class="w-full p-4 rounded-2xl border border-pink-100 outline-none">
            <input
                    type="file"
                    name="image"
                    class="w-full p-4 rounded-2xl border border-pink-100 outline-none">
            <button class="w-full py-4 rounded-2xl bg-gradient-to-r from-pink-500 to-rose-400 text-white font-extrabold shadow-xl">
                Simpan Produk
            </button>
        </form>
    </div>

    <div class="xl:col-span-2 bg-white/90 rounded-[32px] p-6 shadow-xl border border-pink-100">
        <h2 class="text-xl font-extrabold mb-5">Daftar Produk</h2>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-gray-400 text-sm border-b">
                        <th class="py-3">Produk</th>
                        <th>Brand</th>
                        <th>Stok</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($products as $product)
                    <tr class="border-b border-pink-50">
                        <td class="py-4 font-bold">{{ $product->name }}</td>
                        <td>{{ $product->brand }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td>
                            <form action="/products/{{ $product->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <a href="/products/{{ $product->id }}/edit" class="px-4 py-2 rounded-xl bg-pink-50 text-pink-500 font-bold">
                                    Edit
                                </a>
                                <button class="px-4 py-2 rounded-xl bg-red-50 text-red-500 font-bold">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

</div>

@endsection