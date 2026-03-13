<x-landing-layout>
    <!-- Bagian Hero -->
    <div class="relative overflow-hidden bg-gradient-to-b from-white to-slate-50">
        <div class="absolute inset-0 z-0">
            <div
                class="absolute top-0 left-1/2 -translate-x-1/2 w-[1000px] h-[600px] bg-blue-100/40 rounded-full blur-3xl opacity-60 pointer-events-none">
            </div>
            <div
                class="absolute top-20 right-0 w-[800px] h-[600px] bg-cyan-100/40 rounded-full blur-3xl opacity-60 pointer-events-none">
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 pt-24 pb-32">
            <div class="text-center max-w-3xl mx-auto">
                <div
                    class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-blue-50 border border-blue-100 text-blue-600 text-xs font-semibold uppercase tracking-wider mb-6 animate-fade-in-up">
                    <span class="w-2 h-2 rounded-full bg-blue-600 animate-pulse"></span>
                    Sistem Pengaduan Online
                </div>
                <h1
                    class="text-5xl md:text-6xl font-extrabold text-slate-900 tracking-tight mb-6 leading-tight animate-fade-in-up delay-100">
                    Suarakan Aspirasi Anda demi <span
                        class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-cyan-500">Sekolah Lebih
                        Baik</span>
                </h1>
                <p class="text-lg text-slate-600 mb-10 leading-relaxed max-w-2xl mx-auto animate-fade-in-up delay-200">
                    Platform resmi untuk menyampaikan laporan, kritik, dan saran terkait sarana & prasarana sekolah
                    secara transparan dan aman.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center animate-fade-in-up delay-300">
                    <a href="{{ route('login') }}"
                        class="group px-8 py-4 rounded-xl bg-gradient-to-r from-blue-600 to-blue-500 text-white font-semibold shadow-lg shadow-blue-600/20 hover:shadow-blue-600/30 hover:from-blue-700 hover:to-blue-600 transition-all duration-300 transform hover:-translate-y-1 flex items-center justify-center gap-2">
                        Laporkan Sekarang
                        <svg class="w-5 h-5 transition-transform group-hover:translate-x-0.5" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                    <a href="#cara-kerja"
                        class="px-8 py-4 rounded-xl bg-white text-slate-700 font-semibold border-2 border-slate-200 hover:bg-slate-50 hover:border-slate-300 transition-all duration-200">
                        Cara Kerja
                    </a>
                </div>
            </div>

            <!-- Pratinjau Statistik -->
            <div class="mt-20 grid grid-cols-1 md:grid-cols-3 gap-6 max-w-3xl mx-auto animate-fade-in-up delay-400">
                <div
                    class="text-center p-6 bg-white/80 backdrop-blur-sm rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1">
                    <div class="text-3xl font-extrabold text-blue-600 mb-1">100%</div>
                    <div class="text-sm text-slate-500 font-medium">Transparan</div>
                </div>
                <div
                    class="text-center p-6 bg-white/80 backdrop-blur-sm rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1">
                    <div class="text-3xl font-extrabold text-green-600 mb-1">24/7</div>
                    <div class="text-sm text-slate-500 font-medium">Akses Kapan Saja</div>
                </div>
                <div
                    class="text-center p-6 bg-white/80 backdrop-blur-sm rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1">
                    <div class="text-3xl font-extrabold text-purple-600 mb-1">🔒</div>
                    <div class="text-sm text-slate-500 font-medium">Aman & Rahasia</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bagian Cara Kerja -->
    <div id="cara-kerja" class="py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 scroll-animate">
                <span
                    class="inline-flex items-center px-3 py-1 rounded-full bg-blue-50 text-blue-600 text-xs font-semibold uppercase tracking-wider mb-3 border border-blue-100">Bagaimana
                    Cara Kerjanya?</span>
                <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-4">Proses yang <span
                        class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-cyan-500">Mudah &
                        Cepat</span></h2>
                <p class="text-slate-500 max-w-xl mx-auto">Hanya butuh beberapa langkah sederhana untuk menyampaikan
                    aspirasi Anda.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 relative">
                <!-- Garis Penghubung (Desktop) -->
                <div
                    class="hidden md:block absolute top-12 left-1/4 right-1/4 h-0.5 bg-gradient-to-r from-blue-200 via-purple-200 to-green-200">
                </div>

                <div class="scroll-animate text-center group">
                    <div
                        class="w-20 h-20 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center mx-auto mb-5 group-hover:scale-110 group-hover:shadow-lg group-hover:shadow-blue-100 transition-all duration-300 border border-blue-100 relative z-10">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-slate-900 mb-1.5">1. Tulis Laporan</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Deskripsikan masalah dengan jelas dan lampirkan
                        foto bukti.</p>
                </div>

                <div class="scroll-animate text-center group" style="animation-delay: 100ms">
                    <div
                        class="w-20 h-20 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center mx-auto mb-5 group-hover:scale-110 group-hover:shadow-lg group-hover:shadow-amber-100 transition-all duration-300 border border-amber-100 relative z-10">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-slate-900 mb-1.5">2. Verifikasi</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Admin menerima dan memverifikasi laporan Anda.</p>
                </div>

                <div class="scroll-animate text-center group" style="animation-delay: 200ms">
                    <div
                        class="w-20 h-20 rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center mx-auto mb-5 group-hover:scale-110 group-hover:shadow-lg group-hover:shadow-purple-100 transition-all duration-300 border border-purple-100 relative z-10">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-slate-900 mb-1.5">3. Tindak Lanjut</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Petugas menindaklanjuti dan memperbaiki masalah.
                    </p>
                </div>

                <div class="scroll-animate text-center group" style="animation-delay: 300ms">
                    <div
                        class="w-20 h-20 rounded-2xl bg-green-50 text-green-600 flex items-center justify-center mx-auto mb-5 group-hover:scale-110 group-hover:shadow-lg group-hover:shadow-green-100 transition-all duration-300 border border-green-100 relative z-10">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-slate-900 mb-1.5">4. Selesai</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Masalah teratasi dan laporan ditutup dengan
                        feedback.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bagian CTA Pelacakan -->
    <div class="py-24 bg-gradient-to-b from-slate-50 to-white relative overflow-hidden">
        <div class="absolute inset-0">
            <div
                class="absolute bottom-0 left-0 w-[600px] h-[400px] bg-blue-50/50 rounded-full blur-3xl pointer-events-none">
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid md:grid-cols-2 gap-16 items-center">
                <div class="scroll-animate">
                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full bg-green-50 text-green-600 text-xs font-semibold uppercase tracking-wider mb-4 border border-green-100">Tracking
                        Real-time</span>
                    <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-6 leading-tight">Pantau Laporan
                        Anda<br>Secara Real-time</h2>
                    <p class="text-slate-600 mb-8 leading-relaxed">
                        Masukkan ID Tiket yang Anda dapatkan saat melapor untuk melihat sejauh mana laporan Anda
                        diproses oleh pihak sekolah.
                    </p>

                    <a href="{{ route('track') }}"
                        class="group inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-slate-900 text-white font-medium shadow-lg shadow-slate-900/10 hover:bg-slate-800 transition-all duration-300 transform hover:-translate-y-0.5">
                        Lacak Laporan Saya
                        <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>

                    <p class="text-xs text-slate-400 mt-4 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                            </path>
                        </svg>
                        Privasi Anda terjaga. Data hanya dapat dilihat dengan ID Tiket.
                    </p>
                </div>

                <div class="scroll-animate grid grid-cols-2 gap-4">
                    <div class="space-y-4">
                        <div
                            class="p-6 bg-blue-50/50 rounded-2xl border border-blue-100 hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                            <div
                                class="w-10 h-10 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center mb-4">
                                📝</div>
                            <h3 class="font-bold text-slate-900 mb-1">Tulis</h3>
                            <p class="text-xs text-slate-500 leading-relaxed">Deskripsikan masalah dengan jelas.</p>
                        </div>
                        <div
                            class="p-6 bg-purple-50/50 rounded-2xl border border-purple-100 translate-x-4 hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                            <div
                                class="w-10 h-10 rounded-xl bg-purple-100 text-purple-600 flex items-center justify-center mb-4">
                                ✅</div>
                            <h3 class="font-bold text-slate-900 mb-1">Ditindaklanjuti</h3>
                            <p class="text-xs text-slate-500 leading-relaxed">Petugas memperbaiki masalah.</p>
                        </div>
                    </div>
                    <div class="space-y-4 mt-8">
                        <div
                            class="p-6 bg-amber-50/50 rounded-2xl border border-amber-100 hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                            <div
                                class="w-10 h-10 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center mb-4">
                                ⏳</div>
                            <h3 class="font-bold text-slate-900 mb-1">Diverifikasi</h3>
                            <p class="text-xs text-slate-500 leading-relaxed">Laporan diperiksa admin.</p>
                        </div>
                        <div
                            class="p-6 bg-green-50/50 rounded-2xl border border-green-100 translate-x-4 hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                            <div
                                class="w-10 h-10 rounded-xl bg-green-100 text-green-600 flex items-center justify-center mb-4">
                                🎉</div>
                            <h3 class="font-bold text-slate-900 mb-1">Selesai</h3>
                            <p class="text-xs text-slate-500 leading-relaxed">Masalah teratasi.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Pengamat animasi gulir
        document.addEventListener('DOMContentLoaded', function () {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-fade-in-up');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 });

            document.querySelectorAll('.scroll-animate').forEach(el => {
                el.style.opacity = '0';
                observer.observe(el);
            });
        });
    </script>
</x-landing-layout>