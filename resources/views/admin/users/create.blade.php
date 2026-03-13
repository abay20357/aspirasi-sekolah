@extends('layouts.app')

@section('title', 'Tambah Pengguna')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="mb-6 animate-fade-in-up">
            <a href="{{ route('admin.users.index') }}"
                class="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-blue-600 transition-colors mb-4 group">
                <svg class="w-4 h-4 transition-transform group-hover:-translate-x-0.5" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali
            </a>
            <h1 class="text-2xl font-bold text-slate-800">Tambah Pengguna</h1>
            <p class="text-slate-500 mt-1">Buat akun admin atau siswa baru.</p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden animate-fade-in-up delay-100"
            x-data="{ role: '{{ old('role', 'student') }}', isSubmitting: false }">
            <div class="p-6 md:p-8">
                <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-5"
                    @submit="isSubmitting = true">
                    @csrf

                    <!-- Role Selection (First) -->
                    <div>
                        <label for="role" class="block text-sm font-semibold text-slate-700 mb-1.5">Role</label>
                        <select name="role" id="role" x-model="role"
                            class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all">
                            <option value="student">Siswa</option>
                            <option value="admin">Admin</option>
                        </select>
                        @error('role')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Admin Fields: Username + Password -->
                    <div x-show="role === 'admin'" x-transition class="space-y-5">
                        <div>
                            <label for="username" class="block text-sm font-semibold text-slate-700 mb-1.5">Username</label>
                            <input type="text" name="username" id="username" value="{{ old('username') }}"
                                class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all placeholder:text-slate-400"
                                placeholder="username" x-bind:required="role === 'admin'">
                            @error('username')
                                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Student Fields: Nama Lengkap, NIS, Kelas -->
                    <div x-show="role === 'student'" x-transition class="space-y-5">
                        <div>
                            <label for="name" class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Lengkap</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all placeholder:text-slate-400"
                                placeholder="Nama lengkap siswa" x-bind:required="role === 'student'">
                            @error('name')
                                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label for="nis" class="block text-sm font-semibold text-slate-700 mb-1.5">NIS</label>
                                <input type="text" name="nis" id="nis" value="{{ old('nis') }}"
                                    class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all placeholder:text-slate-400"
                                    placeholder="Nomor Induk Siswa">
                                @error('nis')
                                    <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="class_name"
                                    class="block text-sm font-semibold text-slate-700 mb-1.5">Kelas</label>
                                <input type="text" name="class_name" id="class_name" value="{{ old('class_name') }}"
                                    class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all placeholder:text-slate-400"
                                    placeholder="Contoh: XII RPL 1">
                                @error('class_name')
                                    <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Password (Shared) -->
                    <div>
                        <label for="password" class="block text-sm font-semibold text-slate-700 mb-1.5">Password</label>
                        <input type="password" name="password" id="password" required
                            class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all placeholder:text-slate-400"
                            placeholder="••••••••">
                        @error('password')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-4 border-t border-slate-100 flex justify-end gap-3">
                        <a href="{{ route('admin.users.index') }}"
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