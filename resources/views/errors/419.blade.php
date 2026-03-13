<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Session Expired</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta http-equiv="refresh" content="3;url={{ route('login') }}" />
</head>

<body class="bg-slate-900 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full text-center">
        <div class="w-20 h-20 bg-amber-500/20 rounded-full flex items-center justify-center mx-auto mb-6 animate-pulse">
            <svg class="w-10 h-10 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>
        <h1 class="text-2xl font-bold text-white mb-2">Sesi Anda Telah Berakhir</h1>
        <p class="text-slate-400 mb-8">Halaman kadaluarsa (419). Anda akan dialihkan ke halaman login dalam 3 detik...
        </p>
        <a href="{{ route('login') }}"
            class="inline-block px-6 py-3 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700 transition">
            Login Kembali Sekarang
        </a>
    </div>
</body>

</html>