@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="mb-6 animate-fade-in-up">
            <a href="{{ route('admin.categories.index') }}"
                class="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-blue-600 transition-colors mb-4 group">
                <svg class="w-4 h-4 transition-transform group-hover:-translate-x-0.5" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali
            </a>
            <h1 class="text-2xl font-bold text-slate-800">Tambah Kategori Lokasi</h1>
            <p class="text-slate-500 mt-1">Tambahkan lokasi baru beserta gambarnya.</p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden animate-fade-in-up delay-100"
            x-data="{
                    isSubmitting: false,
                    imagePreview: null,
                    handleFileSelect(event) {
                        const file = event.target.files[0];
                        if (file) {
                            const reader = new FileReader();
                            reader.onload = (e) => this.imagePreview = e.target.result;
                            reader.readAsDataURL(file);
                        }
                    },
                    removeImage() {
                        this.imagePreview = null;
                        this.$refs.imageInput.value = '';
                    }
                }">
            <div class="p-6 md:p-8">
                <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-5" @submit="isSubmitting = true">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Lokasi</label>
                        <input type="text" name="name" id="name" required value="{{ old('name') }}"
                            class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all placeholder:text-slate-400"
                            placeholder="Contoh: Toilet Lantai 2, Lab Komputer">
                        @error('name')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-semibold text-slate-700 mb-1.5">Deskripsi <span
                                class="text-xs text-slate-400 font-normal">(opsional)</span></label>
                        <textarea name="description" id="description" rows="3"
                            class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all resize-none placeholder:text-slate-400"
                            placeholder="Jelaskan lokasi ini...">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Image Upload -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Foto Lokasi <span
                                class="text-xs text-slate-400 font-normal">(opsional)</span></label>

                        <!-- Preview -->
                        <div x-show="imagePreview" class="mb-3 relative group">
                            <img :src="imagePreview" class="w-full h-48 object-cover rounded-xl border-2 border-slate-200">
                            <button type="button" @click="removeImage()"
                                class="absolute top-2 right-2 w-8 h-8 bg-red-500 text-white rounded-lg flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity shadow-lg hover:bg-red-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>

                        <!-- Upload Area -->
                        <div x-show="!imagePreview"
                            class="border-2 border-dashed border-slate-200 rounded-xl p-6 text-center hover:border-blue-400 hover:bg-blue-50/30 transition-all cursor-pointer"
                            @click="$refs.imageInput.click()">
                            <svg class="w-10 h-10 mx-auto text-slate-300 mb-3" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            <p class="text-sm text-slate-500 font-medium">Klik untuk upload foto lokasi</p>
                            <p class="text-xs text-slate-400 mt-1">JPG, PNG, GIF, WebP • Maksimal 2MB</p>
                        </div>

                        <input type="file" name="image" x-ref="imageInput" accept="image/*" class="hidden"
                            @change="handleFileSelect($event)">
                        @error('image')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-4 border-t border-slate-100 flex justify-end gap-3">
                        <a href="{{ route('admin.categories.index') }}"
                            class="px-6 py-2.5 rounded-xl border-2 border-slate-200 text-slate-600 font-medium hover:bg-slate-50 hover:border-slate-300 transition-all duration-200">Batal</a>
                        <button type="submit"
                            class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-blue-600 to-blue-500 text-white font-medium shadow-lg shadow-blue-600/20 hover:shadow-blue-600/30 hover:from-blue-700 hover:to-blue-600 transition-all duration-300 transform hover:-translate-y-0.5 flex items-center gap-2"
                            :class="isSubmitting ? 'opacity-75 pointer-events-none' : ''">
                            <svg x-show="!isSubmitting" class="w-4 h-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                            <svg x-show="isSubmitting" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                                </circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                            </svg>
                            <span x-text="isSubmitting ? 'Menyimpan...' : 'Simpan'"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection