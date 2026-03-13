@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="space-y-8">
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 animate-fade-in-up">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">
                    @php
                        $hour = now()->format('H');
                        if ($hour < 12)
                            $greeting = 'Selamat Pagi';
                        elseif ($hour < 15)
                            $greeting = 'Selamat Siang';
                        elseif ($hour < 18)
                            $greeting = 'Selamat Sore';
                        else
                            $greeting = 'Selamat Malam';
                    @endphp
                    {{ $greeting }}, Admin! 👋
                </h1>
                <p class="text-slate-500 mt-1">Kelola aspirasi dan pantau statistik sistem.</p>
            </div>
            <div class="flex items-center gap-3">
                <span
                    class="px-4 py-2 bg-white border border-slate-200 rounded-xl text-sm font-medium text-slate-600 shadow-sm flex items-center gap-2">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
                </span>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Pending -->
            <div
                class="card-hover bg-white p-6 rounded-2xl shadow-sm border border-slate-100 relative overflow-hidden animate-fade-in-up delay-100 h-full">
                <div class="absolute -right-4 -top-4 w-24 h-24 rounded-full bg-amber-50 opacity-60"></div>
                <div class="relative z-10">
                    <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-500 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <p class="text-slate-500 text-sm font-medium">Perlu Tindakan</p>
                    <h3 class="text-3xl font-bold text-slate-800 mt-1"
                        x-data="{ count: 0, target: {{ $pendingAspirations }} }"
                        x-init="let interval = setInterval(() => { if(count < target) count++; else clearInterval(interval); }, 40)"
                        x-text="count">0</h3>
                    <p class="text-xs text-amber-600 mt-2 font-medium">Laporan Menunggu</p>
                </div>
            </div>

            <!-- Processed -->
            <div
                class="card-hover bg-white p-6 rounded-2xl shadow-sm border border-slate-100 relative overflow-hidden animate-fade-in-up delay-200 h-full">
                <div class="absolute -right-4 -top-4 w-24 h-24 rounded-full bg-purple-50 opacity-60"></div>
                <div class="relative z-10">
                    <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z">
                            </path>
                        </svg>
                    </div>
                    <p class="text-slate-500 text-sm font-medium">Sedang Diproses</p>
                    <h3 class="text-3xl font-bold text-slate-800 mt-1"
                        x-data="{ count: 0, target: {{ $processAspirations }} }"
                        x-init="let interval = setInterval(() => { if(count < target) count++; else clearInterval(interval); }, 40)"
                        x-text="count">0</h3>
                    <p class="text-xs text-purple-600 mt-2 font-medium">Dalam Pengerjaan</p>
                </div>
            </div>

            <!-- Completed -->
            <div
                class="card-hover bg-white p-6 rounded-2xl shadow-sm border border-slate-100 relative overflow-hidden animate-fade-in-up delay-300 h-full">
                <div class="absolute -right-4 -top-4 w-24 h-24 rounded-full bg-green-50 opacity-60"></div>
                <div class="relative z-10">
                    <div class="w-12 h-12 rounded-xl bg-green-50 text-green-600 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <p class="text-slate-500 text-sm font-medium">Selesai</p>
                    <h3 class="text-3xl font-bold text-slate-800 mt-1"
                        x-data="{ count: 0, target: {{ $completedAspirations }} }"
                        x-init="let interval = setInterval(() => { if(count < target) count++; else clearInterval(interval); }, 40)"
                        x-text="count">0</h3>
                    <p class="text-xs text-green-600 mt-2 font-medium">Masalah Teratasi</p>
                </div>
            </div>

            <!-- Students -->
            <div
                class="card-hover bg-white p-6 rounded-2xl shadow-sm border border-slate-100 relative overflow-hidden animate-fade-in-up delay-400 h-full">
                <div class="absolute -right-4 -top-4 w-24 h-24 rounded-full bg-blue-50 opacity-60"></div>
                <div class="relative z-10">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                    </div>
                    <p class="text-slate-500 text-sm font-medium">Total Siswa</p>
                    <h3 class="text-3xl font-bold text-slate-800 mt-1" x-data="{ count: 0, target: {{ $totalStudents }} }"
                        x-init="let interval = setInterval(() => { if(count < target) count++; else clearInterval(interval); }, 40)"
                        x-text="count">0</h3>
                    <p class="text-xs text-blue-600 mt-2 font-medium">Pengguna Aktif</p>
                </div>
            </div>
        </div>

        <!-- Charts & Tables -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 animate-fade-in-up delay-300">
            <!-- Chart -->
            <div class="lg:col-span-1 bg-white p-6 rounded-2xl shadow-sm border border-slate-100 h-full">
                <h3 class="font-bold text-slate-800 mb-5 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                        </path>
                    </svg>
                    Statistik Kategori
                </h3>
                <div class="space-y-4">
                    @php $colors = ['blue', 'purple', 'amber', 'green', 'red', 'cyan']; @endphp
                    @foreach($chartLabels as $index => $label)
                        @php
                            $percentage = $totalAspirations > 0 ? ($chartData[$index] / $totalAspirations) * 100 : 0;
                            $color = $colors[$index % count($colors)];
                        @endphp
                        <div x-data="{ width: 0 }"
                            x-init="setTimeout(() => width = {{ $percentage }}, {{ 200 + ($index * 150) }})">
                            <div class="flex justify-between text-sm mb-1.5">
                                <span class="text-slate-600 font-medium">{{ $label }}</span>
                                <span class="font-bold text-slate-800">{{ $chartData[$index] }}</span>
                            </div>
                            <div class="w-full bg-slate-100 rounded-full h-2.5">
                                <div class="bg-{{ $color }}-500 h-2.5 rounded-full transition-all duration-1000 ease-out"
                                    :style="'width: ' + width + '%'"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Recent Aspirations Table -->
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden h-full">
                <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center">
                    <h3 class="font-bold text-slate-800 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                            </path>
                        </svg>
                        Laporan Masuk Terbaru
                    </h3>
                    <a href="{{ route('admin.aspirations.index') }}"
                        class="text-sm font-medium text-blue-600 hover:text-blue-700 flex items-center gap-1 group transition-colors">
                        Kelola Semua
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-0.5" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
                <div class="divide-y divide-slate-100">
                    @forelse($recentAspirations as $aspiration)
                        <a href="{{ route('admin.aspirations.show', $aspiration->id) }}"
                            class="flex items-center gap-4 px-6 py-4 hover:bg-slate-50/80 transition-all duration-200 group">
                            <div
                                class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-cyan-400 flex items-center justify-center text-white font-bold text-xs flex-shrink-0">
                                {{ strtoupper(substr($aspiration->user->name, 0, 1)) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2">
                                    <span
                                        class="text-sm font-semibold text-slate-800 group-hover:text-blue-600 transition-colors">{{ $aspiration->user->name }}</span>
                                    <span class="text-xs text-slate-400">{{ $aspiration->user->class_name ?? 'Siswa' }}</span>
                                </div>
                                <p class="text-sm text-slate-500 truncate">{{ $aspiration->title }}</p>
                            </div>
                            <div class="flex-shrink-0">
                                @if($aspiration->status == 'pending')
                                    <span
                                        class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-amber-50 text-amber-600 text-xs font-semibold border border-amber-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Pending
                                    </span>
                                @elseif($aspiration->status == 'processed')
                                    <span
                                        class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-purple-50 text-purple-600 text-xs font-semibold border border-purple-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-purple-500 animate-pulse"></span> Diproses
                                    </span>
                                @elseif($aspiration->status == 'done' || $aspiration->status == 'completed')
                                    <span
                                        class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-green-50 text-green-600 text-xs font-semibold border border-green-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Selesai
                                    </span>
                                @endif
                            </div>
                            <svg class="w-4 h-4 text-slate-300 group-hover:text-blue-500 group-hover:translate-x-0.5 transition-all flex-shrink-0"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    @empty
                        <div class="px-6 py-12 text-center text-slate-400">
                            <svg class="w-12 h-12 mx-auto mb-3 text-slate-200" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                </path>
                            </svg>
                            <p class="text-sm font-medium">Belum ada laporan masuk.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection