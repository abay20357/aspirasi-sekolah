@extends('layouts.app')

@section('title', 'Detail Aspirasi')

@section('content')
    <div class="max-w-3xl mx-auto">
        <!-- Header -->
        <div class="mb-6 animate-fade-in-up">
            <a href="{{ route('student.aspirations.index') }}"
                class="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-blue-600 transition-colors mb-4 group">
                <svg class="w-4 h-4 transition-transform group-hover:-translate-x-0.5" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Riwayat
            </a>
            <div class="flex items-start justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-slate-800">
                        <span class="text-slate-400 font-normal mr-2">#{{ $aspiration->id }}</span>
                        {{ $aspiration->title }}
                    </h2>
                    <p class="text-sm text-slate-400 mt-1">Dilaporkan {{ $aspiration->created_at->diffForHumans() }}</p>
                </div>
                <div>
                    @if($aspiration->status == 'pending')
                        <span
                            class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-amber-50 text-amber-600 text-sm font-semibold border border-amber-100">
                            <span class="w-2 h-2 rounded-full bg-amber-500"></span> Menunggu
                        </span>
                    @elseif($aspiration->status == 'processed')
                        <span
                            class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-purple-50 text-purple-600 text-sm font-semibold border border-purple-100">
                            <span class="w-2 h-2 rounded-full bg-purple-500 animate-pulse"></span> Diproses
                        </span>
                    @elseif($aspiration->status == 'completed')
                        <span
                            class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-green-50 text-green-600 text-sm font-semibold border border-green-100">
                            <span class="w-2 h-2 rounded-full bg-green-500"></span> Selesai
                        </span>
                    @elseif($aspiration->status == 'rejected')
                        <span
                            class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-red-50 text-red-600 text-sm font-semibold border border-red-100">
                            <span class="w-2 h-2 rounded-full bg-red-500"></span> Ditolak
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Detail Card -->
        <div
            class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden mb-6 animate-fade-in-up delay-100">
            <div class="p-6 md:p-8 space-y-6">
                <!-- Info Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="p-4 bg-slate-50 rounded-xl">
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Kategori</p>
                        <p class="text-sm font-semibold text-slate-800 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                            {{ $aspiration->category->name }}
                        </p>
                    </div>
                    <div class="p-4 bg-slate-50 rounded-xl">
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Lokasi</p>
                        <p class="text-sm font-semibold text-slate-800 flex items-center gap-2">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                            </svg>
                            {{ $aspiration->location ?? 'Tidak ditentukan' }}
                        </p>
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Deskripsi</p>
                    <p class="text-sm text-slate-700 leading-relaxed whitespace-pre-line">{{ $aspiration->description }}</p>
                </div>

                <!-- Image -->
                @if($aspiration->image_path)
                    <div>
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Bukti Foto</p>
                        <div class="relative group rounded-xl overflow-hidden border border-slate-200">
                            <img src="{{ asset('storage/' . $aspiration->image_path) }}" alt="Bukti Foto"
                                class="w-full max-h-80 object-cover transition-transform duration-300 group-hover:scale-105">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Admin Feedback -->
                @if($aspiration->feedback)
                    <div class="p-4 bg-blue-50 rounded-xl border border-blue-100">
                        <div class="flex items-center gap-2 mb-2">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
                                </path>
                            </svg>
                            <p class="text-sm font-semibold text-blue-800">Tanggapan Admin</p>
                        </div>
                        <p class="text-sm text-blue-700 leading-relaxed">{{ $aspiration->feedback }}</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Progress Timeline -->
        @if($aspiration->progress->count() > 0)
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden animate-fade-in-up delay-200">
                <div class="px-6 py-5 border-b border-slate-100">
                    <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        Riwayat Perkembangan
                    </h3>
                </div>
                <div class="p-6">
                    <div class="space-y-0">
                        @foreach($aspiration->progress as $progress)
                            <div class="relative pl-8 pb-8 {{ $loop->last ? '' : 'border-l-2 border-slate-200' }} ml-3">
                                <!-- Dot -->
                                <div class="absolute -left-[9px] top-0 w-[18px] h-[18px] rounded-full border-2 border-white
                                                    {{ $progress->status == 'completed' ? 'bg-green-500' : ($progress->status == 'processed' ? 'bg-blue-500' : ($progress->status == 'rejected' ? 'bg-red-500' : 'bg-slate-300')) }}
                                                    shadow-sm"></div>

                                <div class="pt-0">
                                    <div class="flex items-center justify-between gap-2 mb-1">
                                        <span class="text-sm font-semibold text-slate-800">
                                            @if($progress->status == 'pending') Menunggu
                                            @elseif($progress->status == 'processed') Sedang Diproses
                                            @elseif($progress->status == 'completed') Selesai
                                            @elseif($progress->status == 'rejected') Ditolak
                                            @endif
                                        </span>
                                        <time class="text-xs text-slate-400 flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            {{ $progress->created_at->format('d M Y, H:i') }}
                                        </time>
                                    </div>
                                    <p class="text-xs text-slate-500">Oleh <span
                                            class="font-medium text-slate-700">{{ $progress->admin->name }}</span></p>
                                    @if($progress->notes)
                                        <div class="mt-2 p-3 bg-slate-50 rounded-lg text-sm text-slate-600">
                                            {{ $progress->notes }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection