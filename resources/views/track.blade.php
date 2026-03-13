<x-landing-layout>
    <div class="py-20 bg-slate-50 min-h-[60vh] flex flex-col items-center justify-center">
        <div class="max-w-3xl w-full px-4 text-center">
            <h1 class="text-3xl font-bold text-slate-800 mb-2">Cek Status Laporan</h1>
            <p class="text-slate-500 mb-8">Masukkan ID Tiket untuk melihat perkembangan laporan Anda.</p>

            <form action="{{ route('track') }}" method="GET" class="max-w-md mx-auto mb-12">
                <div class="flex gap-2 p-2 bg-white rounded-2xl shadow-lg shadow-slate-200/50 border border-slate-100">
                    <input type="text" name="id" value="{{ $keyword }}" placeholder="Masukkan Nomor ID (Contoh: 5)"
                        class="flex-1 px-4 py-3 rounded-xl border-none focus:outline-none focus:ring-0 text-slate-700 placeholder-slate-400 bg-transparent"
                        required>
                    <button type="submit"
                        class="px-6 py-3 rounded-xl bg-blue-600 text-white font-medium hover:bg-blue-700 transition shadow-lg shadow-blue-600/20">
                        Lacak
                    </button>
                </div>
            </form>

            @if($keyword)
                @if($aspiration)
                    <div
                        class="bg-white rounded-2xl shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden text-left mx-auto max-w-2xl transform transition-all duration-500 animate-[fadeIn_0.5s_ease-out]">
                        <!-- Status Header -->
                        <div class="px-8 py-6 border-b border-slate-50 bg-slate-50/50 flex justify-between items-center">
                            <div>
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Nomor Tiket</span>
                                <div class="text-2xl font-black text-slate-800">#{{ $aspiration->id }}</div>
                            </div>
                            <div class="text-right">
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Status Terkini</span>
                                <div class="mt-1">
                                    @if($aspiration->status == 'pending')
                                        <span
                                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-50 text-amber-600 text-sm font-bold border border-amber-100">
                                            <span class="w-2 h-2 rounded-full bg-amber-500"></span> Pending
                                        </span>
                                    @elseif($aspiration->status == 'processed' || $aspiration->status == 'processing')
                                        <span
                                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-purple-50 text-purple-600 text-sm font-bold border border-purple-100">
                                            <span class="w-2 h-2 rounded-full bg-purple-500 animate-pulse"></span> Diproses
                                        </span>
                                    @elseif($aspiration->status == 'done' || $aspiration->status == 'completed')
                                        <span
                                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-green-50 text-green-600 text-sm font-bold border border-green-100">
                                            <span class="w-2 h-2 rounded-full bg-green-500"></span> Selesai
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-8 space-y-6">
                            <div>
                                <h3 class="text-lg font-bold text-slate-800 mb-2">{{ $aspiration->title }}</h3>
                                <p class="text-slate-600 leading-relaxed">{{ $aspiration->description }}</p>
                            </div>

                            <div class="grid grid-cols-2 gap-4 text-sm">
                                <div class="p-4 rounded-xl bg-slate-50 border border-slate-100">
                                    <div class="text-slate-400 mb-1">Kategori</div>
                                    <div class="font-medium text-slate-700">{{ $aspiration->category->name }}</div>
                                </div>
                                <div class="p-4 rounded-xl bg-slate-50 border border-slate-100">
                                    <div class="text-slate-400 mb-1">Lokasi</div>
                                    <div class="font-medium text-slate-700">{{ $aspiration->location ?? '-' }}</div>
                                </div>
                            </div>

                            @if($aspiration->image_path)
                                <div>
                                    <div class="text-sm text-slate-400 mb-2">Lampiran Foto</div>
                                    <div class="rounded-xl overflow-hidden border border-slate-100">
                                        <img src="{{ asset('storage/' . $aspiration->image_path) }}" alt="Bukti Laporan"
                                            class="w-full object-cover max-h-64 hover:scale-105 transition duration-500">
                                    </div>
                                </div>
                            @endif

                            <div class="pt-6 border-t border-slate-100">
                                <p class="text-xs text-center text-slate-400">
                                    Laporan dibuat pada {{ $aspiration->created_at->format('d F Y, H:i') }} WIB
                                </p>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="max-w-md mx-auto p-8 bg-white rounded-2xl shadow-lg border border-slate-100 text-center">
                        <div
                            class="w-16 h-16 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-800 mb-2">Laporan Tidak Ditemukan</h3>
                        <p class="text-slate-500">Nomor ID <strong>#{{ $keyword }}</strong> tidak ditemukan dalam sistem kami.
                            Mohon periksa kembali.</p>
                    </div>
                @endif
            @endif
        </div>
    </div>
</x-landing-layout>