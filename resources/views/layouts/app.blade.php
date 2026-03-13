<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SMK 6 Balikpapan') }} - @yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Page load animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(16px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(100%);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideOutRight {
            from {
                opacity: 1;
                transform: translateX(0);
            }

            to {
                opacity: 0;
                transform: translateX(100%);
            }
        }

        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes shimmer {
            0% {
                background-position: -200% 0;
            }

            100% {
                background-position: 200% 0;
            }
        }

        @keyframes countUp {
            from {
                opacity: 0;
                transform: translateY(8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.5s ease-out forwards;
        }

        .animate-scale-in {
            animation: scaleIn 0.3s ease-out forwards;
        }

        .animate-slide-in-right {
            animation: slideInRight 0.4s ease-out forwards;
        }

        .animate-slide-out-right {
            animation: slideOutRight 0.3s ease-in forwards;
        }

        .animate-count-up {
            animation: countUp 0.6s ease-out forwards;
        }

        /* Stagger delays */
        .delay-100 {
            animation-delay: 0.1s;
            opacity: 0;
        }

        .delay-200 {
            animation-delay: 0.2s;
            opacity: 0;
        }

        .delay-300 {
            animation-delay: 0.3s;
            opacity: 0;
        }

        .delay-400 {
            animation-delay: 0.4s;
            opacity: 0;
        }

        .delay-500 {
            animation-delay: 0.5s;
            opacity: 0;
        }

        /* Card hover effect */
        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 40px -8px rgba(0, 0, 0, 0.12);
        }

        /* Button loading state */
        .btn-loading {
            position: relative;
            pointer-events: none;
            color: transparent !important;
        }

        .btn-loading::after {
            content: '';
            position: absolute;
            width: 16px;
            height: 16px;
            top: 50%;
            left: 50%;
            margin: -8px 0 0 -8px;
            border: 2px solid transparent;
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin 0.6s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Sidebar nav link active indicator */
        .nav-active {
            position: relative;
        }

        .nav-active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 60%;
            background: linear-gradient(to bottom, #3b82f6, #06b6d4);
            border-radius: 0 4px 4px 0;
        }

        /* Smooth scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Toast progress bar */
        @keyframes toastProgress {
            from {
                width: 100%;
            }

            to {
                width: 0%;
            }
        }

        [x-cloak] {
            display: none !important;
        }

        .hidden {
            display: none !important;
        }
    </style>
</head>

<body class="h-full font-sans antialiased text-slate-600 bg-slate-50"
    x-data="{ sidebarOpen: false, isLogoutModalOpen: false }">
    <div class="h-screen overflow-hidden flex bg-slate-50 text-slate-900 font-sans">

        <!-- Mobile Sidebar Overlay -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false"
            class="fixed inset-0 z-40 bg-slate-900/50 backdrop-blur-sm lg:hidden"
            x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>

        <!-- Sidebar -->
        <div :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-50 w-72 bg-[#0a192f] text-white transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0 shadow-2xl flex flex-col">

            <!-- Sidebar Header -->
            <div class="flex h-20 items-center justify-center border-b border-white/5 px-6">
                <a href="/" class="flex items-center gap-3 group">
                    <div
                        class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-cyan-400 flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-blue-500/25 group-hover:shadow-blue-500/40 group-hover:scale-105 transition-all duration-300">
                        S</div>
                    <span class="font-bold text-2xl tracking-tight">SMK 6 Balikpapan</span>
                </a>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 overflow-y-auto py-6 px-4 space-y-1">
                @if(auth()->user()->role === 'admin')
                    <div class="px-4 mb-3 text-[11px] font-semibold text-slate-400 uppercase tracking-[0.15em]">Menu Admin
                    </div>

                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-gradient-to-r from-blue-600 to-blue-500 text-white shadow-lg shadow-blue-600/25' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                            </path>
                        </svg>
                        Dashboard
                    </a>
                    <a href="{{ route('admin.aspirations.index') }}"
                        class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('admin.aspirations.*') ? 'bg-gradient-to-r from-blue-600 to-blue-500 text-white shadow-lg shadow-blue-600/25' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                            </path>
                        </svg>
                        Aspirasi Masuk
                    </a>
                    <a href="{{ route('admin.categories.index') }}"
                        class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('admin.categories.*') ? 'bg-gradient-to-r from-blue-600 to-blue-500 text-white shadow-lg shadow-blue-600/25' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                            </path>
                        </svg>
                        Kategori
                    </a>
                    <a href="{{ route('admin.reports.index') }}"
                        class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('admin.reports.*') ? 'bg-gradient-to-r from-blue-600 to-blue-500 text-white shadow-lg shadow-blue-600/25' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        Laporan
                    </a>
                    <a href="{{ route('admin.users.index') }}"
                        class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('admin.users.*') ? 'bg-gradient-to-r from-blue-600 to-blue-500 text-white shadow-lg shadow-blue-600/25' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                        Pengguna
                    </a>

                @else
                    <div class="px-4 mb-3 text-[11px] font-semibold text-slate-400 uppercase tracking-[0.15em]">Menu Siswa
                    </div>

                    <a href="{{ route('student.dashboard') }}"
                        class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('student.dashboard') ? 'bg-gradient-to-r from-blue-600 to-blue-500 text-white shadow-lg shadow-blue-600/25' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                            </path>
                        </svg>
                        Dashboard
                    </a>
                    <a href="{{ route('student.aspirations.create') }}"
                        class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('student.aspirations.create') ? 'bg-gradient-to-r from-blue-600 to-blue-500 text-white shadow-lg shadow-blue-600/25' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Buat Laporan Baru
                    </a>
                    <a href="{{ route('student.aspirations.index') }}"
                        class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('student.aspirations.index') || request()->routeIs('student.aspirations.show') ? 'bg-gradient-to-r from-blue-600 to-blue-500 text-white shadow-lg shadow-blue-600/25' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                            </path>
                        </svg>
                        Riwayat Laporan
                    </a>
                @endif
            </nav>

            <!-- User Profile (Bottom Sidebar) -->
            <div class="border-t border-white/5 p-4">
                <div class="flex items-center gap-3">
                    <div
                        class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-cyan-400 flex items-center justify-center text-white font-bold text-sm shadow-lg shadow-blue-500/20">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-white truncate">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-slate-400 truncate">{{ ucfirst(auth()->user()->role) }}</p>
                    </div>
                    <button type="button" @click="isLogoutModalOpen = true"
                        class="p-2 text-slate-400 hover:text-red-400 transition-colors duration-200 rounded-lg hover:bg-white/5"
                        title="Keluar">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Main Content Wrapper -->
        <div class="flex-1 flex flex-col min-w-0 bg-slate-50 lg:ml-0 transition-all duration-300">

            <!-- Mobile Header -->
            <div
                class="lg:hidden flex h-16 items-center justify-between bg-white/80 backdrop-blur-lg border-b border-slate-200/50 px-4 sticky top-0 z-30">
                <span class="font-bold text-lg text-slate-800">SMK 6 Balikpapan</span>
                <button @click="sidebarOpen = true"
                    class="p-2 -mr-2 text-slate-600 hover:text-blue-600 focus:outline-none transition-colors">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

            <!-- Toast Notification System -->
            <div x-data="toastSystem()" x-on:show-toast.window="addToast($event.detail)"
                class="fixed top-4 right-4 z-[100] flex flex-col gap-3 pointer-events-none" style="max-width: 380px;">

                @if(session('success'))
                    <div x-init="addToast({type: 'success', message: '{{ session('success') }}'})" class="hidden"></div>
                @endif
                @if(session('error'))
                    <div x-init="addToast({type: 'error', message: '{{ session('error') }}'})" class="hidden"></div>
                @endif

                <template x-for="toast in toasts" :key="toast.id">
                    <div x-show="toast.visible" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-x-8"
                        x-transition:enter-end="opacity-1 translate-x-0"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-1 translate-x-0"
                        x-transition:leave-end="opacity-0 translate-x-8"
                        class="pointer-events-auto bg-white rounded-2xl shadow-xl border p-4 flex items-start gap-3 min-w-[320px]"
                        :class="toast.type === 'success' ? 'border-green-100' : 'border-red-100'">
                        <div class="flex-shrink-0 w-8 h-8 rounded-full flex items-center justify-center"
                            :class="toast.type === 'success' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600'">
                            <svg x-show="toast.type === 'success'" class="w-4 h-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            <svg x-show="toast.type === 'error'" class="w-4 h-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold"
                                :class="toast.type === 'success' ? 'text-green-800' : 'text-red-800'"
                                x-text="toast.type === 'success' ? 'Berhasil!' : 'Terjadi Kesalahan'"></p>
                            <p class="text-sm text-slate-600 mt-0.5" x-text="toast.message"></p>
                            <!-- Progress bar -->
                            <div class="h-1 rounded-full mt-3 overflow-hidden"
                                :class="toast.type === 'success' ? 'bg-green-100' : 'bg-red-100'">
                                <div class="h-full rounded-full"
                                    :class="toast.type === 'success' ? 'bg-green-500' : 'bg-red-500'"
                                    style="animation: toastProgress 4s linear forwards"></div>
                            </div>
                        </div>
                        <button @click="removeToast(toast.id)"
                            class="text-slate-400 hover:text-slate-600 transition-colors flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </template>
            </div>

            <!-- Page Content -->
            <main class="flex-1 p-4 sm:p-6 lg:p-8 overflow-y-auto scroll-smooth">
                <div class="max-w-6xl mx-auto animate-fade-in-up">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <script>
        // Vanilla JS Delete Modal Logic
        window.openDeleteModal = function (url, title, message) {
            const modal = document.getElementById('deleteModal');
            const form = document.getElementById('modalForm');
            const titleEl = document.getElementById('modalTitle');
            const messageEl = document.getElementById('modalMessage');

            if (modal && form && titleEl && messageEl) {
                form.action = url;
                titleEl.textContent = title;
                messageEl.textContent = message;
                modal.classList.remove('hidden');
                modal.style.display = 'block'; // Force visibility
            } else {
                console.error('Modal elements not found');
            }
        }

        window.closeDeleteModal = function () {
            const modal = document.getElementById('deleteModal');
            if (modal) {
                modal.classList.add('hidden');
                modal.style.display = 'none'; // Force hidden
            }
        }

        // Close on click outside
        document.addEventListener('click', function (e) {
            const modal = document.getElementById('deleteModal');
            const modalPanel = document.getElementById('deleteModalPanel');
            if (modal && !modal.classList.contains('hidden') && e.target === modal) {
                closeDeleteModal();
            }
        });

        // Close on escape
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeDeleteModal();
            }
        });

        function toastSystem() {
            return {
                toasts: [],
                addToast(detail) {
                    const id = Date.now() + Math.random();
                    this.toasts.push({
                        id: id,
                        type: detail.type || 'success',
                        message: detail.message || '',
                        visible: true
                    });
                    setTimeout(() => this.removeToast(id), 4500);
                },
                removeToast(id) {
                    const toast = this.toasts.find(t => t.id === id);
                    if (toast) toast.visible = false;
                    setTimeout(() => {
                        this.toasts = this.toasts.filter(t => t.id !== id);
                    }, 300);
                }
            }
        }

        // Form loading state
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function (e) {
                if (e.defaultPrevented) return;
                const btn = form.querySelector('button[type="submit"]');
                if (btn && !btn.classList.contains('btn-loading')) {
                    btn.classList.add('btn-loading');
                }
            });
        });
    </script>
    <!-- Logout Confirmation Modal -->
    <div x-show="isLogoutModalOpen" x-cloak class="relative z-50" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div x-show="isLogoutModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity"></div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div x-show="isLogoutModalOpen" x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg"
                    @click.away="isLogoutModalOpen = false">
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div
                                class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                <h3 class="text-base font-semibold leading-6 text-slate-900" id="modal-title">Konfirmasi
                                    Keluar</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-slate-500">Apakah Anda yakin ingin keluar dari aplikasi? Anda
                                        harus login kembali untuk mengakses akun Anda.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-slate-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="inline-flex w-full justify-center rounded-xl bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-700 sm:ml-3 sm:w-auto transition-colors">Keluar</button>
                        </form>
                        <button type="button" @click="isLogoutModalOpen = false"
                            class="mt-3 inline-flex w-full justify-center rounded-xl bg-white px-3 py-2 text-sm font-semibold text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50 sm:mt-0 sm:w-auto transition-colors">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal (Vanilla JS) -->
    <div id="deleteModal" class="relative z-[100] hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity"></div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div id="deleteModalPanel"
                    class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div
                                class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                <h3 class="text-base font-semibold leading-6 text-slate-900" id="modalTitle">
                                    Konfirmasi Hapus</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-slate-500" id="modalMessage">Apakah Anda
                                        yakin ingin
                                        menghapus data ini?</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-slate-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <form id="modalForm" method="POST" action="">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="inline-flex w-full justify-center rounded-xl bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-700 sm:ml-3 sm:w-auto transition-colors">Hapus</button>
                        </form>
                        <button type="button" onclick="closeDeleteModal()"
                            class="mt-3 inline-flex w-full justify-center rounded-xl bg-white px-3 py-2 text-sm font-semibold text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50 sm:mt-0 sm:w-auto transition-colors">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>