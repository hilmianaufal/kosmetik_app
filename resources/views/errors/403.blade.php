<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>403 - Akses Ditolak</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body class="min-h-screen bg-gradient-to-br from-pink-50 via-white to-rose-50 flex items-center justify-center p-6 font-[Plus_Jakarta_Sans]">

    <div class="max-w-lg w-full bg-white/90 backdrop-blur-xl rounded-[40px] p-10 shadow-2xl border border-pink-100 text-center">

        <div class="w-28 h-28 mx-auto rounded-full bg-red-50 flex items-center justify-center text-6xl mb-8 shadow-inner">
            🚫
        </div>

        <h1 class="text-6xl font-extrabold text-red-500">
            403
        </h1>

        <h2 class="text-3xl font-extrabold text-gray-800 mt-4">
            Akses Ditolak
        </h2>

        <p class="text-gray-500 mt-4 leading-relaxed">
            Kamu tidak memiliki izin untuk membuka halaman ini.
            Silakan hubungi administrator MATANU BEAUTY STORE.
        </p>

        <div class="flex flex-col sm:flex-row gap-4 mt-8">

            <a href="/dashboard"
               class="flex-1 py-4 rounded-2xl bg-gradient-to-r from-pink-500 to-rose-400 text-white font-extrabold shadow-xl hover:scale-[1.02] transition">
                Kembali ke Dashboard
            </a>

            <form method="POST" action="{{ route('logout') }}" class="flex-1">
                @csrf

                <button
                    class="w-full py-4 rounded-2xl bg-gray-100 hover:bg-red-50 hover:text-red-500 transition font-bold">
                    Logout
                </button>
            </form>

        </div>

    </div>

</body>
</html>