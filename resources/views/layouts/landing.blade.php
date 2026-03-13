<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description"
        content="SMK 6 Balikpapan - Platform resmi untuk menyampaikan laporan, kritik, dan saran terkait sarana & prasarana sekolah.">

    <title>{{ config('app.name', 'SMK 6 Balikpapan') }} - Aspirasi & Pengaduan</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.7s ease-out both;
        }

        .animate-fade-in-left {
            animation: fadeInLeft 0.7s ease-out both;
        }

        .animate-fade-in-right {
            animation: fadeInRight 0.7s ease-out both;
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        .delay-100 {
            animation-delay: 100ms;
        }

        .delay-200 {
            animation-delay: 200ms;
        }

        .delay-300 {
            animation-delay: 300ms;
        }

        .delay-400 {
            animation-delay: 400ms;
        }

        .delay-500 {
            animation-delay: 500ms;
        }
    </style>
</head>

<body class="text-gray-900 antialiased bg-slate-50">
    <div class="min-h-screen flex flex-col">
        <!-- Navbar -->
        <nav class="bg-white/80 backdrop-blur-md fixed w-full z-50 border-b border-gray-100 transition-all duration-300"
            id="navbar">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="shrink-0 flex items-center gap-2">
                            <a href="/" class="flex items-center gap-2.5 group">
                                <div
                                    class="w-9 h-9 rounded-xl bg-gradient-to-br from-blue-600 to-cyan-500 flex items-center justify-center text-white font-bold shadow-lg shadow-blue-600/20 transition-transform group-hover:scale-110 group-hover:rotate-3">
                                    S
                                </div>
                                <span class="font-extrabold text-xl text-slate-800 tracking-tight">SMK 6
                                    Balikpapan</span>
                            </a>
                        </div>
                    </div>
                    <div class="flex items-center gap-5">
                        <a href="{{ route('track') }}"
                            class="text-sm font-medium text-slate-600 hover:text-blue-600 transition-colors">Lacak
                            Laporan</a>
                        <a href="#cara-kerja"
                            class="text-sm font-medium text-slate-600 hover:text-blue-600 transition-colors hidden sm:block">Cara
                            Kerja</a>
                        <a href="{{ route('login') }}"
                            class="px-5 py-2 rounded-xl bg-gradient-to-r from-blue-600 to-blue-500 text-white text-sm font-semibold shadow-lg shadow-blue-600/20 hover:shadow-blue-600/30 hover:from-blue-700 hover:to-blue-600 transition-all duration-300 transform hover:-translate-y-0.5">Masuk</a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="flex-grow pt-16">
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="bg-slate-900 text-slate-400 py-12 border-t border-slate-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <div class="flex items-center gap-2.5">
                        <div
                            class="w-8 h-8 rounded-lg bg-gradient-to-br from-blue-600 to-cyan-500 flex items-center justify-center text-white font-bold text-sm">
                            S</div>
                        <span class="font-bold text-lg text-white">SMK 6 Balikpapan</span>
                    </div>
                    <p class="text-sm text-center md:text-right">© {{ date('Y') }} SMK 6 Balikpapan - Sistem Informasi
                        Aspirasi &
                        Pengaduan. Created for UKK Project.</p>
                </div>
            </div>
        </footer>
    </div>

    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function () {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 20) {
                navbar.classList.add('shadow-md');
            } else {
                navbar.classList.remove('shadow-md');
            }
        });
    </script>
</body>

</html>