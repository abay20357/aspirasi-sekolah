@extends('layouts.app')

@section('title', 'Riwayat Laporan')

@section('content')
    <div class="space-y-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 animate-fade-in-up">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Riwayat Laporan</h1>
                <p class="text-slate-500 mt-1">Daftar semua aspirasi yang telah kamu kirimkan.</p>
            </div>
            <a href="{{ route('student.aspirations.create') }}"
                class="group px-5 py-2.5 bg-gradient-to-r from-blue-600 to-blue-500 text-white rounded-xl font-medium shadow-lg shadow-blue-600/20 hover:shadow-blue-600/30 hover:from-blue-700 hover:to-blue-600 transition-all duration-300 flex items-center gap-2 transform hover:-translate-y-0.5">
                <svg class="w-5 h-5 transition-transform group-hover:rotate-90 duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Buat Laporan Baru
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden animate-fade-in-up delay-100">
            @if($aspirations->count() > 0)
                <!-- Card-based list for better mobile experience -->
                <div class="divide-y divide-slate-100">
                    @foreach($aspirations as $index => $aspiration)
                        <a href="{{ route('student.aspirations.show', $aspiration->id) }}"
                            class="block p-5 hover:bg-slate-50/80 transition-all duration-200 group">
                            <div class="flex items-center gap-4">
                                <!-- Icon -->
                                <div class="w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0 text-lg
                                    {{ $aspiration->status == 'pending' ? 'bg-amber-50' : ($aspiration->status == 'completed' || $aspiration->status == 'done' ? 'bg-green-50' : 'bg-purple-50') }}">
                                    @if($aspiration->status == 'pending')
                                        ⏳
                                    @elseif($aspiration->status == 'completed' || $aspiration->status == 'done')
                                        ✅
                                    @elseif($aspiration->status == 'processing')
                                        🔄
                                    @else
                                        📝
                                    @endif
                                </div>

                                <!-- Content -->
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-start justify-between gap-3">
                                        <div class="min-w-0">
                                            <h3 class="font-semibold text-slate-800 line-clamp-1 group-hover:text-blue-600 transition-colors">
                                                {{ $aspiration->title }}</h3>
                                            <div class="flex flex-wrap items-center gap-x-3 gap-y-1 mt-1.5 text-xs text-slate-400">
                                                <span class="flex items-center gap-1">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                    {{ $aspiration->created_at->format('d M Y, H:i') }}
                                                </span>
                                                <span class="px-2 py-0.5 rounded-md bg-slate-100 text-slate-500 font-medium">
                                                    {{ $aspiration->category->name ?? 'Umum' }}
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Status Badge -->
                                        <div class="flex-shrink-0">
                                            @if($aspiration->status == 'pending')
                                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-amber-50 text-amber-600 text-xs font-semibold border border-amber-100">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Menunggu
                                                </span>
                                            @elseif($aspiration->status == 'processing')
                                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-purple-50 text-purple-600 text-xs font-semibold border border-purple-100">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-purple-500 animate-pulse"></span> Diproses
                                                </span>
                                            @elseif($aspiration->status == 'done' || $aspiration->status == 'completed')
                                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-green-50 text-green-600 text-xs font-semibold border border-green-100">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Selesai
                                                </span>
                                            @elseif($aspiration->status == 'rejected')
                                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-red-50 text-red-600 text-xs font-semibold border border-red-100">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Ditolak
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Arrow -->
                                <svg class="w-5 h-5 text-slate-300 group-hover:text-blue-500 transition-all group-hover:translate-x-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="p-12 text-center">
                    <div class="w-20 h-20 bg-slate-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-base font-semibold text-slate-700 mb-1">Belum ada laporan</h3>
                    <p class="text-sm text-slate-400 mb-6">Kamu belum pernah mengirimkan aspirasi atau pengaduan.</p>
                    <a href="{{ route('student.aspirations.create') }}"
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-blue-600 to-blue-500 text-white rounded-xl font-medium shadow-lg shadow-blue-600/20 hover:shadow-blue-600/30 transition-all duration-300 transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Buat Laporan Pertama
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection