@extends('layouts.app')

@section('content')

<h1 class="dashboard-title text-3xl font-extrabold text-gray-800 mb-2">
    Manajemen User
</h1>

<p class="text-gray-500 mb-6">
    Kelola akun admin dan kasir MATANU BEAUTY STORE
</p>

@if ($errors->any())
    <div class="mb-6 bg-red-50 border border-red-100 text-red-500 rounded-2xl p-4 font-semibold">
        {{ $errors->first() }}
    </div>
@endif

@if (session('success'))
    <div class="mb-6 bg-emerald-50 border border-emerald-100 text-emerald-500 rounded-2xl p-4 font-semibold">
        {{ session('success') }}
    </div>
@endif

<div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

    <!-- Form -->
    <div class="bg-white rounded-[32px] p-6 shadow-xl border border-pink-100">

        <h2 class="text-xl font-extrabold mb-5">
            Tambah User
        </h2>

        <form action="/users" method="POST" class="space-y-4">
            @csrf

            <input
                name="name"
                required
                placeholder="Nama lengkap"
                class="w-full p-4 rounded-2xl border border-pink-100 outline-none focus:border-pink-400">

            <input
                name="email"
                type="email"
                required
                placeholder="Email"
                class="w-full p-4 rounded-2xl border border-pink-100 outline-none focus:border-pink-400">

            <input
                name="password"
                type="password"
                required
                placeholder="Password"
                class="w-full p-4 rounded-2xl border border-pink-100 outline-none focus:border-pink-400">

            <select
                name="role"
                required
                class="w-full p-4 rounded-2xl border border-pink-100 outline-none focus:border-pink-400">

                <option value="kasir">Kasir</option>
                <option value="admin">Admin</option>

            </select>

            <button
                class="w-full py-4 rounded-2xl bg-gradient-to-r from-pink-500 to-rose-400 text-white font-extrabold shadow-xl hover:scale-[1.02] transition">

                Simpan User

            </button>

        </form>

    </div>

    <!-- Table -->
    <div class="xl:col-span-2 bg-white rounded-[32px] p-6 shadow-xl border border-pink-100">

        <div class="flex items-center justify-between mb-6">

            <div>
                <h2 class="text-xl font-extrabold">
                    Daftar User
                </h2>

                <p class="text-gray-400 text-sm mt-1">
                    Semua akun admin dan kasir
                </p>
            </div>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead>
                    <tr class="border-b border-pink-100 text-left text-gray-400 text-sm">
                        <th class="pb-4">Nama</th>
                        <th class="pb-4">Email</th>
                        <th class="pb-4">Role</th>
                        <th class="pb-4">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($users as $user)

                    <tr class="border-b border-pink-50">

                        <td class="py-4 font-bold text-gray-800">
                            {{ $user->name }}
                        </td>

                        <td class="text-gray-500">
                            {{ $user->email }}
                        </td>

                        <td>

                            <form action="/users/{{ $user->id }}" method="POST">
                                @csrf
                                @method('PUT')

                                <select
                                    name="role"
                                    onchange="this.form.submit()"
                                    class="px-4 py-2 rounded-xl text-sm font-bold border border-pink-100 outline-none {{ $user->role === 'admin' ? 'bg-pink-50 text-pink-500' : 'bg-gray-100 text-gray-600' }}">

                                    <option value="kasir" {{ $user->role === 'kasir' ? 'selected' : '' }}>
                                        Kasir
                                    </option>

                                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>
                                        Admin
                                    </option>

                                </select>
                            </form>

                        </td>

                        <td>

                            @if ($user->id !== auth()->id())

                                <form action="/users/{{ $user->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        onclick="return confirm('Yakin ingin menghapus user ini?')"
                                        class="px-4 py-2 rounded-xl bg-red-50 text-red-500 font-bold hover:bg-red-100 transition">

                                        Hapus

                                    </button>

                                </form>

                            @else

                                <span class="text-gray-400 text-sm">
                                    Akun aktif
                                </span>

                            @endif

                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="4" class="py-10 text-center text-gray-400">

                            <div class="flex flex-col items-center">

                                <div class="text-5xl mb-4">
                                    👤
                                </div>

                                <h3 class="font-bold text-lg text-gray-700">
                                    Belum Ada User
                                </h3>

                                <p class="text-sm text-gray-400 mt-1">
                                    Tambahkan akun admin atau kasir baru
                                </p>

                            </div>

                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection