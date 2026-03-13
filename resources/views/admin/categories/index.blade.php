@extends('layouts.app')

@section('title', 'Manajemen Kategori')

@section('content')
    <div class="space-y-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 animate-fade-in-up">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Manajemen Kategori</h1>
                <p class="text-slate-500 mt-1">Kelola kategori lokasi aspirasi yang tersedia.</p>
            </div>
            <a href="{{ route('admin.categories.create') }}"
                class="group px-5 py-2.5 bg-gradient-to-r from-blue-600 to-blue-500 text-white rounded-xl font-medium shadow-lg shadow-blue-600/20 hover:shadow-blue-600/30 hover:from-blue-700 hover:to-blue-600 transition-all duration-300 flex items-center gap-2 transform hover:-translate-y-0.5">
                <svg class="w-5 h-5 transition-transform group-hover:rotate-90 duration-300" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Lokasi
            </a>
        </div>

        @forelse($categories as $category)
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden hover:shadow-md transition-all duration-300 animate-fade-in-up"
                style="animation-delay: {{ $loop->index * 80 }}ms">
                <div class="flex flex-col sm:flex-row">
                    <!-- Image -->
                    @if($category->image_path)
                        <div class="sm:w-48 h-40 sm:h-auto flex-shrink-0">
                            <img src="{{ asset('storage/' . $category->image_path) }}" alt="{{ $category->name }}"
                                class="w-full h-full object-cover">
                        </div>
                    @else
                        <div
                            class="sm:w-48 h-40 sm:h-auto flex-shrink-0 bg-gradient-to-br from-slate-100 to-slate-50 flex items-center justify-center">
                            <svg class="w-12 h-12 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                    @endif

                    <!-- Content -->
                    <div class="flex-1 p-5 flex flex-col justify-between">
                        <div>
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <h3 class="text-lg font-bold text-slate-800">{{ $category->name }}</h3>
                                    @if($category->description)
                                        <p class="text-sm text-slate-500 mt-1 line-clamp-2">{{ $category->description }}</p>
                                    @endif
                                </div>
                                <span
                                    class="px-3 py-1 rounded-lg bg-blue-50 text-blue-600 text-xs font-bold flex-shrink-0 border border-blue-100">
                                    {{ $category->aspirations_count }} laporan
                                </span>
                            </div>
                        </div>

                        <div class="flex items-center gap-2 mt-4 pt-3 border-t border-slate-100">
                            <a href="{{ route('admin.categories.edit', $category->id) }}"
                                class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg text-sm font-medium text-blue-600 bg-blue-50 hover:bg-blue-100 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                    </path>
                                </svg>
                                Edit
                            </a>
                            <button type="button"
                                onclick="openDeleteModal('{{ route('admin.categories.destroy', $category->id) }}', 'Hapus Kategori', 'Apakah Anda yakin ingin menghapus kategori ini? Data yang dihapus tidak dapat dikembalikan.')"
                                class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg text-sm font-medium text-red-600 bg-red-50 hover:bg-red-100 transition-colors cursor-pointer relative z-10">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                    </path>
                                </svg>
                                Hapus
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-12 text-center animate-fade-in-up">
                <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                        </path>
                    </svg>
                </div>
                <h3 class="text-base font-semibold text-slate-700 mb-1">Belum ada kategori</h3>
                <p class="text-sm text-slate-400">Tambahkan kategori pertama untuk memulai.</p>
            </div>
        @endforelse
    </div>
@endsection