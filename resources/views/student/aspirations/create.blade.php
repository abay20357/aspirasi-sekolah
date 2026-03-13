@extends('layouts.app')

@section('title', 'Buat Laporan Baru')

@section('content')
    <div class="max-w-3xl mx-auto" x-data="aspirationForm()">
        <div class="mb-8 animate-fade-in-up">
            <a href="{{ route('student.dashboard') }}"
                class="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-blue-600 transition-colors mb-4 group">
                <svg class="w-4 h-4 transition-transform group-hover:-translate-x-0.5" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Dashboard
            </a>
            <h1 class="text-2xl font-bold text-slate-800">Buat Laporan Baru</h1>
            <p class="text-slate-500 mt-1">Sampaikan aspirasi atau pengaduan kamu dengan jelas dan detail.</p>
        </div>

        <!-- Step Indicator -->
        <div class="flex items-center gap-0 mb-8 animate-fade-in-up delay-100">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold transition-all duration-300"
                    :class="currentStep >= 1 ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/25' : 'bg-slate-200 text-slate-500'">
                    1</div>
                <span class="text-sm font-medium hidden sm:inline"
                    :class="currentStep >= 1 ? 'text-blue-600' : 'text-slate-400'">Kategori</span>
            </div>
            <div class="flex-1 h-0.5 mx-3 rounded transition-colors duration-300"
                :class="currentStep >= 2 ? 'bg-blue-600' : 'bg-slate-200'"></div>
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold transition-all duration-300"
                    :class="currentStep >= 2 ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/25' : 'bg-slate-200 text-slate-500'">
                    2</div>
                <span class="text-sm font-medium hidden sm:inline"
                    :class="currentStep >= 2 ? 'text-blue-600' : 'text-slate-400'">Detail</span>
            </div>
            <div class="flex-1 h-0.5 mx-3 rounded transition-colors duration-300"
                :class="currentStep >= 3 ? 'bg-blue-600' : 'bg-slate-200'"></div>
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold transition-all duration-300"
                    :class="currentStep >= 3 ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/25' : 'bg-slate-200 text-slate-500'">
                    3</div>
                <span class="text-sm font-medium hidden sm:inline"
                    :class="currentStep >= 3 ? 'text-blue-600' : 'text-slate-400'">Bukti</span>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden animate-fade-in-up delay-200">
            <form action="{{ route('student.aspirations.store') }}" method="POST" enctype="multipart/form-data"
                class="p-6 md:p-8 space-y-6" @submit="isSubmitting = true">
                @csrf

                <!-- Step 1: Category -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-3">
                        <span class="flex items-center gap-2">
                            <span
                                class="w-6 h-6 rounded-md bg-blue-50 text-blue-600 flex items-center justify-center text-xs font-bold">1</span>
                            Kategori Lokasi
                        </span>
                    </label>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                        @foreach($categories as $category)
                            <label class="cursor-pointer group">
                                <input type="radio" name="category_id" value="{{ $category->id }}" class="peer sr-only"
                                    @change="selectCategory({{ $category->id }}, '{{ $category->name }}', '{{ $category->image_path ? asset('storage/' . $category->image_path) : '' }}'); currentStep = Math.max(currentStep, 1)">
                                <div
                                    class="rounded-xl border-2 border-slate-200 hover:border-blue-300 hover:bg-blue-50/50 peer-checked:bg-blue-50 peer-checked:border-blue-500 transition-all duration-200 text-center group-active:scale-[0.97] overflow-hidden">
                                    @if($category->image_path)
                                        <div class="h-24 overflow-hidden">
                                            <img src="{{ asset('storage/' . $category->image_path) }}" alt="{{ $category->name }}"
                                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                        </div>
                                    @else
                                        <div class="h-24 bg-gradient-to-br from-slate-50 to-slate-100 flex items-center justify-center">
                                            <svg class="w-8 h-8 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                            </svg>
                                        </div>
                                    @endif
                                    <div class="p-3">
                                        <span class="block text-sm font-medium text-slate-700">{{ $category->name }}</span>
                                    </div>
                                </div>
                            </label>
                        @endforeach
                    </div>
                    @error('category_id')
                        <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01">
                                </path>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror

                    <!-- Selected Category Preview -->
                    <div x-show="selectedCategoryImage" x-transition class="mt-4 rounded-xl overflow-hidden border border-blue-100 bg-blue-50/30">
                        <div class="relative">
                            <img :src="selectedCategoryImage" :alt="selectedCategoryName" class="w-full h-48 object-cover">
                            <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-black/60 to-transparent p-4">
                                <p class="text-white text-sm font-semibold flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span x-text="selectedCategoryName"></span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 2: Details -->
                <div class="space-y-5">
                    <label class="block text-sm font-semibold text-slate-700 mb-1">
                        <span class="flex items-center gap-2">
                            <span
                                class="w-6 h-6 rounded-md bg-blue-50 text-blue-600 flex items-center justify-center text-xs font-bold">2</span>
                            Detail Laporan
                        </span>
                    </label>

                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-slate-600 mb-1.5">Judul Laporan</label>
                        <input type="text" name="title" id="title"
                            class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all duration-200 placeholder:text-slate-400"
                            placeholder="Contoh: AC di Lab Komputer 1 Rusak" @input="currentStep = Math.max(currentStep, 2)"
                            required>
                        @error('title')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-slate-600 mb-1.5">Deskripsi
                            Detail</label>
                        <textarea name="description" id="description" rows="4"
                            class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all duration-200 resize-none placeholder:text-slate-400"
                            placeholder="Jelaskan masalahnya secara rinci..." required></textarea>
                        @error('description')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Location -->
                    <div>
                        <label for="location" class="block text-sm font-medium text-slate-600 mb-1.5">Lokasi
                            (Opsional)</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <input type="text" name="location" id="location"
                                class="w-full pl-11 pr-4 py-3 rounded-xl border-2 border-slate-200 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all duration-200 placeholder:text-slate-400"
                                placeholder="Contoh: Gedung A, Lantai 2">
                        </div>
                    </div>
                </div>

                <!-- Step 3: Image Upload -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-3">
                        <span class="flex items-center gap-2">
                            <span
                                class="w-6 h-6 rounded-md bg-blue-50 text-blue-600 flex items-center justify-center text-xs font-bold">3</span>
                            Bukti Foto (Opsional)
                        </span>
                    </label>
                    <div class="relative" @dragover.prevent="isDragging = true" @dragleave.prevent="isDragging = false"
                        @drop.prevent="isDragging = false; handleDrop($event)">
                        <div class="border-2 border-dashed rounded-xl transition-all duration-200 p-6"
                            :class="isDragging ? 'border-blue-500 bg-blue-50' : (imagePreview ? 'border-green-300 bg-green-50/50' : 'border-slate-300 hover:border-slate-400 hover:bg-slate-50')">

                            <!-- Upload prompt -->
                            <div x-show="!imagePreview" class="text-center">
                                <div
                                    class="w-14 h-14 rounded-2xl bg-slate-100 flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-7 h-7 text-slate-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                                <label for="image" class="cursor-pointer">
                                    <span class="text-sm font-semibold text-blue-600 hover:text-blue-700">Pilih foto</span>
                                    <span class="text-sm text-slate-500"> atau seret ke sini</span>
                                    <input id="image" name="image" type="file" class="sr-only" accept="image/*"
                                        @change="handleFileSelect($event); currentStep = 3">
                                </label>
                                <p class="text-xs text-slate-400 mt-1.5">PNG, JPG, GIF maksimal 2MB</p>
                            </div>

                            <!-- Preview -->
                            <div x-show="imagePreview" class="relative" x-cloak>
                                <img :src="imagePreview" class="w-full h-48 object-cover rounded-lg">
                                <div
                                    class="absolute inset-0 bg-black/0 hover:bg-black/10 rounded-lg transition-colors flex items-center justify-center">
                                    <button type="button"
                                        @click="imagePreview = null; document.getElementById('image').value = ''"
                                        class="p-2 bg-red-500 text-white rounded-full shadow-lg hover:bg-red-600 transition-all transform hover:scale-110">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Anonymous Option -->
                <div class="flex items-start gap-3 p-4 bg-slate-50 rounded-xl border border-slate-100">
                    <div class="flex items-center h-5 mt-0.5">
                        <input id="is_anonymous" name="is_anonymous" type="checkbox"
                            class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-slate-300 rounded transition">
                    </div>
                    <div>
                        <label for="is_anonymous" class="text-sm font-semibold text-slate-700 cursor-pointer">Kirim sebagai
                            Anonim</label>
                        <p class="text-sm text-slate-500 mt-0.5">Identitas kamu akan disembunyikan dari publik (hanya
                            terlihat oleh Admin).</p>
                    </div>
                </div>

                <!-- Actions -->
                <div class="pt-4 border-t border-slate-100 flex justify-end gap-3">
                    <a href="{{ route('student.dashboard') }}"
                        class="px-6 py-2.5 rounded-xl border-2 border-slate-200 text-slate-600 font-medium hover:bg-slate-50 hover:border-slate-300 transition-all duration-200">Batal</a>
                    <button type="submit"
                        class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-blue-600 to-blue-500 text-white font-medium shadow-lg shadow-blue-600/20 hover:shadow-blue-600/30 hover:from-blue-700 hover:to-blue-600 transition-all duration-300 transform hover:-translate-y-0.5 flex items-center gap-2"
                        :class="isSubmitting ? 'opacity-75 pointer-events-none' : ''">
                        <svg x-show="!isSubmitting" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                        <svg x-show="isSubmitting" class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                            </circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z">
                            </path>
                        </svg>
                        <span x-text="isSubmitting ? 'Mengirim...' : 'Kirim Laporan'"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function aspirationForm() {
            return {
                currentStep: 0,
                imagePreview: null,
                isDragging: false,
                isSubmitting: false,
                selectedCategoryImage: null,
                selectedCategoryName: '',
                selectCategory(id, name, imageUrl) {
                    this.selectedCategoryName = name;
                    this.selectedCategoryImage = imageUrl || null;
                },
                handleFileSelect(event) {
                    const file = event.target.files[0];
                    if (file) this.imagePreview = URL.createObjectURL(file);
                },
                handleDrop(event) {
                    const file = event.dataTransfer.files[0];
                    if (file && file.type.startsWith('image/')) {
                        const input = document.getElementById('image');
                        input.files = event.dataTransfer.files;
                        this.imagePreview = URL.createObjectURL(file);
                        this.currentStep = 3;
                    }
                }
            }
        }
    </script>
@endsection