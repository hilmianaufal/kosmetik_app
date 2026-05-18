@extends('layouts.app')

@section('content')

<h1 class="dashboard-title text-3xl font-extrabold text-gray-800 mb-2">
    Edit Produk
</h1>

<p class="text-gray-500 mb-6">
    Update data produk MATANU BEAUTY STORE
</p>

<div class="bg-white/90 rounded-[32px] p-6 shadow-xl border border-pink-100 max-w-2xl">

    <form action="/products/{{ $product->id }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <input name="name" value="{{ $product->name }}" placeholder="Nama Produk" class="w-full p-4 rounded-2xl border border-pink-100 outline-none">
        <input name="brand" value="{{ $product->brand }}" placeholder="Brand" class="w-full p-4 rounded-2xl border border-pink-100 outline-none">
        <input name="category" value="{{ $product->category }}" placeholder="Kategori" class="w-full p-4 rounded-2xl border border-pink-100 outline-none">
        <input name="barcode" value="{{ $product->barcode }}" placeholder="Barcode" class="w-full p-4 rounded-2xl border border-pink-100 outline-none">
        <input name="stock" type="number" value="{{ $product->stock }}" placeholder="Stok" class="w-full p-4 rounded-2xl border border-pink-100 outline-none">
        <input name="price" type="number" value="{{ $product->price }}" placeholder="Harga Jual" class="w-full p-4 rounded-2xl border border-pink-100 outline-none">
        <input name="cost_price" type="number" value="{{ $product->cost_price }}" placeholder="Harga Modal" class="w-full p-4 rounded-2xl border border-pink-100 outline-none">
        <input name="expired_date" type="date" value="{{ $product->expired_date }}" class="w-full p-4 rounded-2xl border border-pink-100 outline-none">

        @if ($product->image)
            <img src="/storage/{{ $product->image }}" class="w-32 h-32 object-cover rounded-3xl border border-pink-100">
        @endif

        <input type="file" name="image" class="w-full p-4 rounded-2xl border border-pink-100 outline-none">

        <div class="flex gap-3">
            <button class="px-6 py-4 rounded-2xl bg-gradient-to-r from-pink-500 to-rose-400 text-white font-extrabold shadow-xl">
                Update Produk
            </button>

            <a href="/products" class="px-6 py-4 rounded-2xl bg-gray-100 text-gray-700 font-extrabold">
                Kembali
            </a>
        </div>

    </form>

</div>

@endsection