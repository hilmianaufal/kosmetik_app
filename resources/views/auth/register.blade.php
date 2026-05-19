<x-guest-layout>

    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-pink-50 via-white to-rose-50 p-6">

        <div class="w-full max-w-md bg-white/90 backdrop-blur-xl rounded-[40px] shadow-2xl border border-pink-100 p-10">

            <div class="text-center mb-10">

                <div class="w-24 h-24 mx-auto rounded-full bg-gradient-to-r from-pink-500 to-rose-400 flex items-center justify-center text-white text-4xl shadow-xl mb-5">
                    ✨
                </div>

                <h1 class="text-4xl font-extrabold text-pink-500">
                    MATANU BEAUTY
                </h1>

                <p class="text-gray-400 mt-2">
                    Buat akun kasir/admin baru
                </p>

            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <input name="name" type="text" required placeholder="Nama lengkap"
                    class="w-full rounded-2xl border border-pink-100 p-4 outline-none focus:border-pink-400">

                <input name="email" type="email" required placeholder="Email"
                    class="w-full rounded-2xl border border-pink-100 p-4 outline-none focus:border-pink-400">

                <input name="password" type="password" required placeholder="Password"
                    class="w-full rounded-2xl border border-pink-100 p-4 outline-none focus:border-pink-400">

                <input name="password_confirmation" type="password" required placeholder="Konfirmasi password"
                    class="w-full rounded-2xl border border-pink-100 p-4 outline-none focus:border-pink-400">

                <button class="w-full py-4 rounded-2xl bg-gradient-to-r from-pink-500 to-rose-400 text-white font-extrabold shadow-xl">
                    Register
                </button>

                <a href="{{ route('login') }}" class="block text-center text-pink-500 font-bold">
                    Sudah punya akun? Login
                </a>

            </form>

        </div>

    </div>

</x-guest-layout>