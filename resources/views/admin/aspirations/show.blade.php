@extends('layouts.app')

@section('title', 'Detail Aspirasi #' . $aspiration->id)

@section('content')
    <div class="max-w-7xl mx-auto">
        <!-- Back link -->
        <div class="mb-6 animate-fade-in-up">
            <a href="{{ route('admin.aspirations.index') }}"
                class="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-blue-600 transition-colors group">
                <svg class="w-4 h-4 transition-transform group-hover:-translate-x-0.5" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Daftar
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Detail Info -->
            <div class="lg:col-span-2 space-y-6">
                <div
                    class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden animate-fade-in-up delay-100">
                    <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-bold text-slate-800">{{ $aspiration->title }}</h3>
                            <p class="text-sm text-slate-500 mt-0.5 flex items-center gap-2">
                                Dikirim oleh <span class="font-medium text-slate-700">{{ $aspiration->user->name }}</span>
                                <span class="text-slate-300">•</span>
                                {{ $aspiration->created_at->diffForHumans() }}
                            </p>
                        </div>
                        @if($aspiration->status == 'pending')
                            <span
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-amber-50 text-amber-600 text-xs font-semibold border border-amber-100">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Menunggu
                            </span>
                        @elseif($aspiration->status == 'processing')
                            <span
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-purple-50 text-purple-600 text-xs font-semibold border border-purple-100">
                                <span class="w-1.5 h-1.5 rounded-full bg-purple-500 animate-pulse"></span> Diproses
                            </span>
                        @elseif($aspiration->status == 'completed')
                            <span
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-green-50 text-green-600 text-xs font-semibold border border-green-100">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Selesai
                            </span>
                        @elseif($aspiration->status == 'rejected')
                            <span
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-red-50 text-red-600 text-xs font-semibold border border-red-100">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Ditolak
                            </span>
                        @endif
                    </div>
                    <div class="p-6 space-y-5">
                        <!-- Info Grid -->
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <div class="p-4 bg-slate-50 rounded-xl">
                                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Kategori</p>
                                <p class="text-sm font-semibold text-slate-800">{{ $aspiration->category->name }}</p>
                            </div>
                            <div class="p-4 bg-slate-50 rounded-xl">
                                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Lokasi</p>
                                <p class="text-sm font-semibold text-slate-800">
                                    {{ $aspiration->location ?? 'Tidak ditentukan' }}</p>
                            </div>
                            <div class="p-4 bg-slate-50 rounded-xl">
                                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Tanggal</p>
                                <p class="text-sm font-semibold text-slate-800">
                                    {{ $aspiration->created_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>

                        <!-- Description -->
                        <div>
                            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Deskripsi</p>
                            <p
                                class="text-sm text-slate-700 leading-relaxed whitespace-pre-line bg-slate-50 p-4 rounded-xl">
                                {{ $aspiration->description }}</p>
                        </div>

                        <!-- Image -->
                        @if($aspiration->image_path)
                            <div>
                                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Bukti Foto</p>
                                <div class="relative group rounded-xl overflow-hidden border border-slate-200">
                                    <img src="{{ asset('storage/' . $aspiration->image_path) }}" alt="Bukti"
                                        class="w-full max-h-80 object-cover transition-transform duration-300 group-hover:scale-105">
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- History Timeline -->
                @if($aspiration->progress->count() > 0)
                    <div
                        class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden animate-fade-in-up delay-200">
                        <div class="px-6 py-5 border-b border-slate-100">
                            <h3 class="font-bold text-slate-800 flex items-center gap-2">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                                Riwayat Proses
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-0">
                                @foreach($aspiration->progress as $progress)
                                    <div class="relative pl-8 pb-8 {{ $loop->last ? '' : 'border-l-2 border-slate-200' }} ml-3">
                                        <div
                                            class="absolute -left-[9px] top-0 w-[18px] h-[18px] rounded-full border-2 border-white shadow-sm
                                                {{ $progress->status == 'completed' ? 'bg-green-500' : ($progress->status == 'processed' ? 'bg-blue-500' : ($progress->status == 'rejected' ? 'bg-red-500' : 'bg-slate-300')) }}">
                                        </div>
                                        <div>
                                            <div class="flex items-center justify-between gap-2 mb-1">
                                                <span
                                                    class="text-sm font-semibold text-slate-800">{{ ucfirst($progress->status) }}</span>
                                                <time
                                                    class="text-xs text-slate-400">{{ $progress->created_at->format('d M Y, H:i') }}</time>
                                            </div>
                                            <p class="text-xs text-slate-500">Oleh <span
                                                    class="font-medium text-slate-700">{{ $progress->admin->name }}</span></p>
                                            @if($progress->notes)
                                                <div class="mt-2 p-3 bg-slate-50 rounded-lg text-sm text-slate-600">
                                                    {{ $progress->notes }}</div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Action Form -->
            <div class="lg:col-span-1 animate-fade-in-up delay-200">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 sticky top-6 overflow-hidden"
                    x-data="{ isSubmitting: false }">
                    <div class="px-6 py-5 border-b border-slate-100 bg-gradient-to-r from-blue-600 to-blue-500">
                        <h3 class="text-base font-bold text-white flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                </path>
                            </svg>
                            Tindak Lanjut
                        </h3>
                    </div>
                    <div class="p-6">
                        <form action="{{ route('admin.aspirations.update', $aspiration->id) }}" method="POST"
                            @submit="isSubmitting = true">
                            @csrf
                            @method('PUT')

                            <div class="space-y-5">
                                <div>
                                    <label for="status" class="block text-sm font-semibold text-slate-700 mb-1.5">Update
                                        Status</label>
                                    <select id="status" name="status"
                                        class="w-full px-4 py-2.5 rounded-xl border-2 border-slate-200 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all text-sm">
                                        <option value="pending" {{ $aspiration->status == 'pending' ? 'selected' : '' }}>⏳
                                            Menunggu</option>
                                        <option value="processed" {{ $aspiration->status == 'processed' ? 'selected' : '' }}>
                                            🔄 Diproses</option>
                                        <option value="completed" {{ $aspiration->status == 'completed' ? 'selected' : '' }}>✅
                                            Selesai</option>
                                        <option value="rejected" {{ $aspiration->status == 'rejected' ? 'selected' : '' }}>❌
                                            Ditolak</option>
                                    </select>
                                </div>

                                <div>
                                    <label for="notes" class="block text-sm font-semibold text-slate-700 mb-1.5">Catatan
                                        Internal</label>
                                    <textarea id="notes" name="notes" rows="3"
                                        class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all text-sm resize-none placeholder:text-slate-400"
                                        placeholder="Catatan untuk riwayat progres..."></textarea>
                                </div>

                                <div>
                                    <label for="feedback"
                                        class="block text-sm font-semibold text-slate-700 mb-1.5">Tanggapan ke Siswa</label>
                                    <textarea id="feedback" name="feedback" rows="3"
                                        class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all text-sm resize-none placeholder:text-slate-400"
                                        placeholder="Pesan yang akan muncul di dashboard siswa...">{{ $aspiration->feedback }}</textarea>
                                </div>

                                <button type="submit"
                                    class="w-full px-5 py-3 bg-gradient-to-r from-blue-600 to-blue-500 text-white rounded-xl font-medium shadow-lg shadow-blue-600/20 hover:shadow-blue-600/30 hover:from-blue-700 hover:to-blue-600 transition-all duration-300 text-sm flex items-center justify-center gap-2"
                                    :class="isSubmitting ? 'opacity-75 pointer-events-none' : ''">
                                    <svg x-show="!isSubmitting" class="w-4 h-4" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <svg x-show="isSubmitting" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                            stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                                    </svg>
                                    <span x-text="isSubmitting ? 'Menyimpan...' : 'Simpan Perubahan'"></span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection