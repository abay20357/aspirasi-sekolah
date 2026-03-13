@extends('layouts.app')

@section('title', 'Dashboard Siswa')

@section('content')
    <div class="space-y-8">
        <!-- Welcome Section -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 animate-fade-in-up">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">
                    @php
                        $hour = now()->format('H');
                        if ($hour < 12) $greeting = 'Selamat Pagi';
                        elseif ($hour < 15) $greeting = 'Selamat Siang';
                        elseif ($hour < 18) $greeting = 'Selamat Sore';
                        else $greeting = 'Selamat Malam';
                    @endphp
                    {{ $greeting }}, {{ auth()->user()->name }}! 👋
                </h1>
                <p class="text-slate-500 mt-1">Pantau dan kelola laporan aspirasi kamu dari sini.</p>
            </div>
            <a href="{{ route('student.aspirations.create') }}"
                class="group px-5 py-2.5 bg-gradient-to-r from-blue-600 to-blue-500 text-white rounded-xl font-medium shadow-lg shadow-blue-600/20 hover:shadow-blue-600/30 hover:from-blue-700 hover:to-blue-600 transition-all duration-300 flex items-center gap-2 transform hover:-translate-y-0.5">
                <svg class="w-5 h-5 transition-transform group-hover:rotate-90 duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Buat Laporan Baru
            </a>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total -->
            <div class="card-hover bg-white p-6 rounded-2xl shadow-sm border border-slate-100 relative overflow-hidden animate-fade-in-up delay-100">
                <div class="absolute -right-4 -top-4 w-24 h-24 rounded-full bg-blue-50 opacity-60"></div>
                <div class="absolute -right-1 -top-1 w-16 h-16 rounded-full bg-blue-100 opacity-40"></div>
                <div class="relative z-10">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </div>
                    <p class="text-slate-500 text-sm font-medium">Total Laporan</p>
                    <h3 class="text-3xl font-bold text-slate-800 mt-1" x-data="{ count: 0, target: {{ $totalAspirations }} }"
                        x-init="let interval = setInterval(() => { if(count < target) count++; else clearInterval(interval); }, 50)"
                        x-text="count">0</h3>
                </div>
            </div>

            <!-- Pending -->
            <div class="card-hover bg-white p-6 rounded-2xl shadow-sm border border-slate-100 relative overflow-hidden animate-fade-in-up delay-200">
                <div class="absolute -right-4 -top-4 w-24 h-24 rounded-full bg-amber-50 opacity-60"></div>
                <div class="absolute -right-1 -top-1 w-16 h-16 rounded-full bg-amber-100 opacity-40"></div>
                <div class="relative z-10">
                    <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-500 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <p class="text-slate-500 text-sm font-medium">Menunggu</p>
                    <h3 class="text-3xl font-bold text-slate-800 mt-1" x-data="{ count: 0, target: {{ $pendingAspirations }} }"
                        x-init="let interval = setInterval(() => { if(count < target) count++; else clearInterval(interval); }, 50)"
                        x-text="count">0</h3>
                </div>
            </div>

            <!-- Process -->
            <div class="card-hover bg-white p-6 rounded-2xl shadow-sm border border-slate-100 relative overflow-hidden animate-fade-in-up delay-300">
                <div class="absolute -right-4 -top-4 w-24 h-24 rounded-full bg-purple-50 opacity-60"></div>
                <div class="absolute -right-1 -top-1 w-16 h-16 rounded-full bg-purple-100 opacity-40"></div>
                <div class="relative z-10">
                    <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z">
                            </path>
                        </svg>
                    </div>
                    <p class="text-slate-500 text-sm font-medium">Diproses</p>
                    <h3 class="text-3xl font-bold text-slate-800 mt-1" x-data="{ count: 0, target: {{ $processAspirations }} }"
                        x-init="let interval = setInterval(() => { if(count < target) count++; else clearInterval(interval); }, 50)"
                        x-text="count">0</h3>
                </div>
            </div>

            <!-- Completed -->
            <div class="card-hover bg-white p-6 rounded-2xl shadow-sm border border-slate-100 relative overflow-hidden animate-fade-in-up delay-400">
                <div class="absolute -right-4 -top-4 w-24 h-24 rounded-full bg-green-50 opacity-60"></div>
                <div class="absolute -right-1 -top-1 w-16 h-16 rounded-full bg-green-100 opacity-40"></div>
                <div class="relative z-10">
                    <div class="w-12 h-12 rounded-xl bg-green-50 text-green-600 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <p class="text-slate-500 text-sm font-medium">Selesai</p>
                    <h3 class="text-3xl font-bold text-slate-800 mt-1" x-data="{ count: 0, target: {{ $completedAspirations }} }"
                        x-init="let interval = setInterval(() => { if(count < target) count++; else clearInterval(interval); }, 50)"
                        x-text="count">0</h3>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden animate-fade-in-up delay-300">
            <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center">
                <div>
                    <h2 class="text-lg font-bold text-slate-800">Aspirasi Terbaru</h2>
                    <p class="text-sm text-slate-400 mt-0.5">Pantau status laporan terakhir kamu</p>
                </div>
                <a href="{{ route('student.aspirations.index') }}"
                    class="text-sm font-medium text-blue-600 hover:text-blue-700 flex items-center gap-1 group transition-colors">
                    Lihat Semua
                    <svg class="w-4 h-4 transition-transform group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
            <div class="divide-y divide-slate-100">
                @forelse($recentAspirations as $index => $aspiration)
                    <a href="{{ route('student.aspirations.show', $aspiration->id) }}"
                        class="block p-5 hover:bg-slate-50/80 transition-all duration-200 group">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex gap-4 flex-1 min-w-0">
                                <div class="w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0 text-lg
                                    {{ $aspiration->status == 'pending' ? 'bg-amber-50' : ($aspiration->status == 'completed' || $aspiration->status == 'done' ? 'bg-green-50' : 'bg-purple-50') }}">
                                    @if($aspiration->status == 'pending')
                                        ⏳
                                    @elseif($aspiration->status == 'completed' || $aspiration->status == 'done')
                                        ✅
                                    @else
                                        🔄
                                    @endif
                                </div>
                                <div class="min-w-0 flex-1">
                                    <h3 class="font-semibold text-slate-800 line-clamp-1 group-hover:text-blue-600 transition-colors">
                                        {{ $aspiration->title ?? 'Laporan #' . $aspiration->id }}</h3>
                                    <p class="text-sm text-slate-500 mt-1 line-clamp-1">
                                        {{ Str::limit($aspiration->description, 60) }}</p>
                                    <div class="flex items-center gap-3 mt-2 text-xs text-slate-400">
                                        <span class="flex items-center gap-1">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            {{ $aspiration->created_at->diffForHumans() }}
                                        </span>
                                        <span class="px-2 py-0.5 rounded-md bg-slate-100 text-slate-500 font-medium">
                                            {{ $aspiration->category->name ?? 'Umum' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
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
                                @endif
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="p-12 text-center">
                        <div class="w-20 h-20 bg-slate-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-base font-semibold text-slate-700 mb-1">Belum ada aspirasi</h3>
                        <p class="text-sm text-slate-400 mb-6">Mulai sampaikan pendapatmu untuk sekolah yang lebih baik!</p>
                        <a href="{{ route('student.aspirations.create') }}"
                            class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-blue-600 to-blue-500 text-white rounded-xl font-medium shadow-lg shadow-blue-600/20 hover:shadow-blue-600/30 transition-all duration-300 transform hover:-translate-y-0.5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Buat Laporan Pertama
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection