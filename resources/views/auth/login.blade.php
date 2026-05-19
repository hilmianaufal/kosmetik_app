<x-guest-layout>
    <div class="relative min-h-screen bg-gradient-to-br from-pink-50 via-white to-rose-100 flex items-center justify-center p-4 overflow-hidden">

        <div class="bg-particles">
            <span></span><span></span><span></span><span></span><span></span>
            <span></span><span></span><span></span><span></span><span></span>
        </div>

        <div class="relative z-10 w-full max-w-6xl grid grid-cols-1 lg:grid-cols-2 bg-white/80 backdrop-blur-xl rounded-[40px] shadow-2xl border border-pink-100 overflow-hidden">

            <div class="hidden lg:flex relative bg-gradient-to-br from-pink-500 via-rose-400 to-pink-300 p-12 items-center justify-center overflow-hidden">

                <div class="absolute inset-0 overflow-hidden">
                    <div class="blob blob-1"></div>
                    <div class="blob blob-2"></div>
                    <div class="blob blob-3"></div>
                </div>

                <div class="shine"></div>

                <div class="relative z-20 text-center text-white">
                    <div class="w-52 h-52 mx-auto rounded-[48px] bg-white/10 backdrop-blur-xl border border-white/20 shadow-[0_20px_80px_rgba(255,255,255,0.15)] p-6 mb-10">
                        <div class="w-full h-full rounded-[36px] bg-gradient-to-br from-pink-400 to-rose-400 flex items-center justify-center shadow-inner">
                            <img
                                src="{{ asset('images/logo.png') }}"
                                alt="Logo"
                                class="w-36 h-36 object-contain brightness-110 contrast-110 saturate-125 drop-shadow-[0_0_20px_rgba(255,255,255,0.45)]">
                        </div>
                    </div>

                    <h1 class="text-6xl font-black tracking-tight leading-none text-white drop-shadow-lg">
                        MATANU BEAUTY
                    </h1>

                    <p class="mt-6 text-white/85 text-xl font-medium tracking-wide">
                        Premium Cosmetic Point of Sale
                    </p>
                </div>
            </div>

            <div class="p-8 sm:p-12 lg:p-16 bg-white/90">

                <div class="lg:hidden text-center mb-8">
                    <div class="w-32 h-32 mx-auto rounded-[32px] bg-gradient-to-br from-pink-300 via-pink-400 to-rose-400 p-3 shadow-2xl shadow-pink-300/50 mb-4">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-full h-full object-contain brightness-125 contrast-125 saturate-150">
                    </div>

                    <h1 class="text-3xl font-extrabold text-pink-500">
                        MATANU BEAUTY
                    </h1>
                </div>

                <div class="mb-8">
                    <p class="text-pink-500 font-bold mb-2">Welcome back 👋</p>

                    <h2 class="text-4xl font-extrabold text-gray-800">
                        Login Kasir
                    </h2>

                    <p class="text-gray-400 mt-3">
                        Masuk untuk mengelola transaksi toko kosmetik kamu.
                    </p>
                </div>

                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border border-red-100 text-red-500 rounded-2xl p-4 font-semibold">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label class="text-sm font-bold text-gray-500">Email</label>
                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            placeholder="admin@matanubeauty.com"
                            class="w-full mt-2 rounded-2xl border border-pink-100 p-4 outline-none focus:border-pink-400 focus:ring-4 focus:ring-pink-100 transition">
                    </div>

                    <div>
                        <label class="text-sm font-bold text-gray-500">Password</label>
                        <input
                            type="password"
                            name="password"
                            required
                            placeholder="Masukkan password"
                            class="w-full mt-2 rounded-2xl border border-pink-100 p-4 outline-none focus:border-pink-400 focus:ring-4 focus:ring-pink-100 transition">
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-2 text-sm text-gray-500">
                            <input type="checkbox" name="remember" class="rounded border-pink-300 text-pink-500 focus:ring-pink-400">
                            Ingat saya
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm text-pink-500 font-bold">
                                Lupa password?
                            </a>
                        @endif
                    </div>

                    <button class="w-full py-4 rounded-2xl bg-gradient-to-r from-pink-500 to-rose-400 text-white font-extrabold shadow-xl shadow-pink-200 hover:scale-[1.02] active:scale-[0.98] transition">
                        Login
                    </button>
                </form>

            </div>

        </div>

    </div>
</x-guest-layout>