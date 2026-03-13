@extends('layouts.guest')

@section('content')
    <div class="min-h-screen flex bg-slate-50 relative overflow-hidden"
        x-data="{ loginRole: 'student', showPassword: false }"
        x-init="$watch('loginRole', () => { document.getElementById('nis-feedback').innerHTML = ''; document.getElementById('identity').value = ''; })">
        <!-- Decoration Background -->
        <div class="absolute top-0 right-0 w-1/2 h-full bg-slate-50 z-0 lg:block hidden"></div>
        <div class="absolute top-0 left-0 w-full lg:w-1/2 h-full bg-[#0F172A] z-0">
            <!-- Abstract Shapes -->
            <div class="absolute top-0 left-0 w-full h-full overflow-hidden opacity-20 pointer-events-none">
                <div
                    class="absolute top-[-10%] left-[-10%] w-[500px] h-[500px] rounded-full bg-blue-600 blur-[80px] animate-[pulse_8s_ease-in-out_infinite]">
                </div>
                <div
                    class="absolute bottom-[-10%] right-[-10%] w-[500px] h-[500px] rounded-full bg-cyan-500 blur-[80px] animate-[pulse_10s_ease-in-out_infinite_reverse]">
                </div>
            </div>
            <!-- Grid Pattern -->
            <div
                class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiLz48L3N2Zz4=')] [mask-image:linear-gradient(to_bottom,white,transparent)]">
            </div>
        </div>

        <!-- Left Side: Illustration & Branding -->
        <div class="hidden lg:flex lg:w-1/2 relative z-10 flex-col justify-between p-12 text-white">
            <div>
                <a href="/" class="inline-flex items-center gap-3 group">
                    <div
                        class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-cyan-400 flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-blue-500/30">
                        S</div>
                    <span class="font-bold text-2xl tracking-tight">SMK 6 Balikpapan</span>
                </a>
            </div>

            <div class="max-w-md">
                <h1 class="text-4xl font-bold mb-6 leading-tight">Suarakan Aspirasi, <br><span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-300">Wujudkan
                        Perubahan.</span></h1>
                <p class="text-blue-100/80 text-lg mb-8 leading-relaxed">Platform pengaduan resmi sekolah yang aman,
                    transparan, dan terpercaya untuk mewujudkan lingkungan pendidikan yang lebih baik.</p>

                <div class="flex gap-4">
                    <div
                        class="px-4 py-3 bg-white/10 backdrop-blur-sm rounded-xl border border-white/10 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-green-500/20 flex items-center justify-center text-green-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="text-xs text-blue-200">Total Aduan</div>
                            <div class="font-bold">Selesai</div>
                        </div>
                    </div>
                    <div
                        class="px-4 py-3 bg-white/10 backdrop-blur-sm rounded-xl border border-white/10 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-blue-500/20 flex items-center justify-center text-blue-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <div class="text-xs text-blue-200">Keamanan</div>
                            <div class="font-bold">Terjamin</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-sm text-blue-200/60">
                &copy; {{ date('Y') }} SMK 6 Balikpapan - UKK Project V1.0
            </div>
        </div>

        <!-- Right Side: Login Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-6 relative z-10">
            <div class="w-full max-w-md">
                <div
                    class="bg-white rounded-[20px] shadow-[0_20px_50px_-12px_rgba(0,0,0,0.1)] border border-slate-100 p-8 md:p-10 relative overflow-hidden">

                    <!-- Mobile Logo (Visible only on small screens) -->
                    <div class="lg:hidden text-center mb-8">
                        <a href="/" class="inline-flex items-center gap-2">
                            <div
                                class="w-10 h-10 rounded-xl bg-[#0F172A] flex items-center justify-center text-white font-bold text-xl">
                                S</div>
                            <span class="font-bold text-2xl text-[#0F172A]">SMK 6 Balikpapan</span>
                        </a>
                    </div>

                    <div class="mb-8">
                        <h2 class="text-2xl font-bold text-slate-900">Selamat Datang 👋</h2>
                        <p class="text-slate-500 mt-2">Silahkan masuk untuk melanjutkan</p>
                    </div>

                    <!-- Role Toggle -->
                    <div class="bg-slate-100 p-1.5 rounded-xl flex relative mb-8">
                        <div class="absolute inset-y-1.5 w-[calc(50%-0.375rem)] bg-white rounded-lg shadow-sm transition-transform duration-300 ease-[cubic-bezier(0.4,0,0.2,1)]"
                            :style="loginRole === 'student' ? 'transform: translateX(0); left: 0.375rem' : 'transform: translateX(100%); left: 0'">
                        </div>

                        <button type="button" @click="loginRole = 'student'"
                            class="flex-1 relative z-20 py-2.5 text-sm font-semibold rounded-lg transition-colors duration-300 flex items-center justify-center gap-2"
                            :class="loginRole === 'student' ? 'text-slate-900' : 'text-slate-500 hover:text-slate-700'">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222">
                                </path>
                            </svg>
                            Siswa
                        </button>
                        <button type="button" @click="loginRole = 'admin'"
                            class="flex-1 relative z-20 py-2.5 text-sm font-semibold rounded-lg transition-colors duration-300 flex items-center justify-center gap-2"
                            :class="loginRole === 'admin' ? 'text-slate-900' : 'text-slate-500 hover:text-slate-700'">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                </path>
                            </svg>
                            Admin
                        </button>
                    </div>

                    <form action="{{ route('login') }}" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="role" :value="loginRole">

                        <!-- Dynamic Input Field -->
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <label x-text="loginRole === 'student' ? 'NIS (Nomor Induk Siswa)' : 'Username'"
                                    class="text-sm font-medium text-slate-700 block transition-all"></label>
                            </div>
                            <div class="relative">
                                <input type="text" name="identity" id="identity" required
                                    class="w-full pl-11 pr-4 py-3 bg-white border border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all shadow-sm"
                                    :placeholder="loginRole === 'student' ? 'Contoh: 12345678' : 'Masukkan username admin'">
                                <div
                                    class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 z-10">
                                    <svg x-show="loginRole === 'student'" class="w-5 h-5 transition-all duration-300"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0c0 .883-.393 1.627-1 1.944M10 6a3.002 3.002 0 013 0">
                                        </path>
                                    </svg>
                                    <svg x-show="loginRole === 'admin'" class="w-5 h-5 transition-all duration-300"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                            </div>
                            <!-- NIS Feedback -->
                            <div id="nis-feedback"></div>
                        </div>

                        <!-- Password Field -->
                        <div class="space-y-2">
                            <div class="flex justify-between items-center">
                                <label class="text-sm font-medium text-slate-700">Kata Sandi</label>
                                <a href="#" class="text-xs font-semibold text-blue-600 hover:text-blue-700">Lupa Sandi?</a>
                            </div>
                            <div class="relative">
                                <input :type="showPassword ? 'text' : 'password'" name="password" required
                                    class="w-full pl-11 pr-11 py-3 bg-white border border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all shadow-sm"
                                    placeholder="••••••••">
                                <div
                                    class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                        </path>
                                    </svg>
                                </div>
                                <button type="button" @click="showPassword = !showPassword"
                                    class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-slate-600 transition-colors focus:outline-none">
                                    <svg x-show="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                        </path>
                                    </svg>
                                    <svg x-show="showPassword" class="w-5 h-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" style="display: none;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Error Message -->
                        @if(session('error') || $errors->any())
                            <div
                                class="rounded-xl bg-red-50 text-red-600 p-4 border border-red-100 flex gap-3 items-start animate-[fadeIn_0.3s_ease-out]">
                                <svg class="h-5 w-5 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div class="text-sm">
                                    {{ session('error') ?? $errors->first() }}
                                </div>
                            </div>
                        @endif

                        <button type="submit"
                            class="w-full py-3.5 px-4 bg-[#0F172A] hover:bg-slate-800 text-white text-sm font-semibold rounded-xl shadow-lg shadow-slate-900/20 transition-all transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-900">
                            Masuk ke Sistem
                        </button>

                        <p class="text-center text-sm text-slate-500">
                            Belum punya akun? <span class="text-slate-900 font-medium cursor-help"
                                title="Hubungi admin sekolah untuk pendaftaran">Hubungi Admin</span>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const identityInput = document.getElementById('identity');
            const feedbackDiv = document.getElementById('nis-feedback');
            const roleInput = document.querySelector('input[name="role"]');
            let timeout = null;

            identityInput.addEventListener('keyup', function () {
                if (roleInput.value !== 'student') return;

                clearTimeout(timeout);
                const nis = this.value.trim();

                // Reset state
                feedbackDiv.innerHTML = '';
                identityInput.classList.remove('border-red-500', 'focus:border-red-500', 'focus:ring-red-500/20');
                identityInput.classList.remove('border-green-500', 'focus:border-green-500', 'focus:ring-green-500/20');

                if (nis.length < 3) return;

                timeout = setTimeout(() => {
                    feedbackDiv.innerHTML = '<span class="text-xs text-blue-500 animate-pulse">Memeriksa NIS...</span>';

                    fetch("{{ route('check-nis') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({ nis: nis })
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'found') {
                                feedbackDiv.innerHTML = `
                                            <div class="mt-2 bg-green-50 text-green-700 p-3 rounded-xl border border-green-100 flex gap-3 items-center animate-fade-in-up">
                                                <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center text-green-600 flex-shrink-0">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <div class="font-semibold text-sm">${data.name}</div>
                                                    <div class="text-xs text-green-600">${data.class_name}</div>
                                                </div>
                                            </div>
                                        `;
                                identityInput.classList.add('border-green-500', 'focus:border-green-500', 'focus:ring-green-500/20');
                            } else {
                                feedbackDiv.innerHTML = `
                                            <div class="mt-2 bg-red-50 text-red-600 p-3 rounded-xl border border-red-100 flex gap-2 items-center animate-fade-in-up">
                                                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <span class="text-sm font-medium">NIS tidak ditemukan</span>
                                            </div>
                                        `;
                                identityInput.classList.add('border-red-500', 'focus:border-red-500', 'focus:ring-red-500/20');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            feedbackDiv.innerHTML = '';
                        });
                }, 500);
            });
        });
    </script>
@endsection