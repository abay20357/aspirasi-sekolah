@extends('layouts.app')

@section('title', 'Manajemen Aspirasi')

@section('content')
    <div class="space-y-6">
        <div class="animate-fade-in-up">
            <h1 class="text-2xl font-bold text-slate-800">Manajemen Aspirasi</h1>
            <p class="text-slate-500 mt-1">Kelola dan tindaklanjuti laporan dari siswa.</p>
        </div>

        <!-- Filter Section -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 animate-fade-in-up delay-100">
            <form method="GET" action="{{ route('admin.aspirations.index') }}">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label for="status" class="block text-sm font-medium text-slate-600 mb-1.5">Status</label>
                        <select name="status" id="status"
                            class="w-full px-4 py-2.5 rounded-xl border-2 border-slate-200 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all text-sm">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                            <option value="processed" {{ request('status') == 'processed' ? 'selected' : '' }}>Diproses
                            </option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai
                            </option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-slate-600 mb-1.5">Kategori</label>
                        <select name="category_id" id="category_id"
                            class="w-full px-4 py-2.5 rounded-xl border-2 border-slate-200 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all text-sm">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="date_from" class="block text-sm font-medium text-slate-600 mb-1.5">Dari Tanggal</label>
                        <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}"
                            class="w-full px-4 py-2.5 rounded-xl border-2 border-slate-200 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all text-sm">
                    </div>
                    <div class="flex items-end">
                        <button type="submit"
                            class="w-full px-5 py-2.5 bg-gradient-to-r from-blue-600 to-blue-500 text-white rounded-xl border-2 border-transparent font-medium shadow-lg shadow-blue-600/20 hover:shadow-blue-600/30 hover:from-blue-700 hover:to-blue-600 transition-all duration-300 text-sm flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z">
                                </path>
                            </svg>
                            Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden animate-fade-in-up delay-200">
            @if($aspirations->count() > 0)
                <div class="divide-y divide-slate-100">
                    @foreach($aspirations as $aspiration)
                        <a href="{{ route('admin.aspirations.show', $aspiration->id) }}"
                            class="flex items-center gap-4 px-6 py-4 hover:bg-slate-50/80 transition-all duration-200 group">
                            <!-- ID -->
                            <span class="text-xs font-mono text-slate-400 w-8 flex-shrink-0">#{{ $aspiration->id }}</span>

                            <!-- User Avatar -->
                            <div
                                class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-cyan-400 flex items-center justify-center text-white font-bold text-xs flex-shrink-0">
                                {{ strtoupper(substr($aspiration->user->name, 0, 1)) }}
                            </div>

                            <!-- Content -->
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2">
                                    <span
                                        class="text-sm font-semibold text-slate-800 group-hover:text-blue-600 transition-colors">{{ $aspiration->user->name }}</span>
                                    <span
                                        class="text-xs text-slate-400 hidden sm:inline">{{ $aspiration->user->class ?? $aspiration->user->nis }}</span>
                                </div>
                                <div class="flex items-center gap-2 mt-0.5">
                                    <p class="text-sm text-slate-500 truncate">{{ $aspiration->title }}</p>
                                    <span class="text-xs text-slate-400 hidden md:inline">• {{ $aspiration->category->name }}</span>
                                </div>
                            </div>

                            <!-- Date -->
                            <span
                                class="text-xs text-slate-400 hidden md:block flex-shrink-0">{{ $aspiration->created_at->format('d M Y') }}</span>

                            <!-- Status -->
                            <div class="flex-shrink-0">
                                @if($aspiration->status == 'pending')
                                    <span
                                        class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-amber-50 text-amber-600 text-xs font-semibold border border-amber-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Menunggu
                                    </span>
                                @elseif($aspiration->status == 'processed')
                                    <span
                                        class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-purple-50 text-purple-600 text-xs font-semibold border border-purple-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-purple-500 animate-pulse"></span> Diproses
                                    </span>
                                @elseif($aspiration->status == 'completed')
                                    <span
                                        class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-green-50 text-green-600 text-xs font-semibold border border-green-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Selesai
                                    </span>
                                @elseif($aspiration->status == 'rejected')
                                    <span
                                        class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-red-50 text-red-600 text-xs font-semibold border border-red-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Ditolak
                                    </span>
                                @endif
                            </div>

                            <!-- Arrow -->
                            <svg class="w-4 h-4 text-slate-300 group-hover:text-blue-500 group-hover:translate-x-0.5 transition-all flex-shrink-0"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    @endforeach
                </div>
                <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
                    {{ $aspirations->links() }}
                </div>
            @else
                <div class="p-12 text-center text-slate-400">
                    <svg class="w-16 h-16 mx-auto mb-4 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                        </path>
                    </svg>
                    <h3 class="text-base font-semibold text-slate-700 mb-1">Tidak ada data aspirasi</h3>
                    <p class="text-sm text-slate-400">Coba ubah filter untuk melihat data lainnya.</p>
                </div>
            @endif
        </div>
    </div>
@endsection