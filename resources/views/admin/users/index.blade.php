@extends('layouts.app')

@section('title', 'Manajemen Pengguna')

@section('content')
    <div class="space-y-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 animate-fade-in-up">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Manajemen Pengguna</h1>
                <p class="text-slate-500 mt-1">Kelola semua akun admin dan siswa.</p>
            </div>
            <a href="{{ route('admin.users.create') }}"
                class="group px-5 py-2.5 bg-gradient-to-r from-blue-600 to-blue-500 text-white rounded-xl font-medium shadow-lg shadow-blue-600/20 hover:shadow-blue-600/30 hover:from-blue-700 hover:to-blue-600 transition-all duration-300 flex items-center gap-2 transform hover:-translate-y-0.5">
                <svg class="w-5 h-5 transition-transform group-hover:rotate-90 duration-300" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Pengguna
            </a>
        </div>

        <!-- Filter -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 animate-fade-in-up delay-100">
            <form method="GET" action="{{ route('admin.users.index') }}">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="search" class="block text-sm font-medium text-slate-600 mb-1.5">Pencarian</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="text" name="search" id="search" value="{{ request('search') }}"
                                placeholder="Cari nama, username, NIS..."
                                class="w-full pl-10 pr-4 py-2.5 rounded-xl border-2 border-slate-200 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all text-sm">
                        </div>
                    </div>
                    <div>
                        <label for="role" class="block text-sm font-medium text-slate-600 mb-1.5">Role</label>
                        <select name="role" id="role"
                            class="w-full px-4 py-2.5 rounded-xl border-2 border-slate-200 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all text-sm">
                            <option value="">Semua Role</option>
                            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="student" {{ request('role') == 'student' ? 'selected' : '' }}>Siswa</option>
                        </select>
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

        <!-- Users List -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden animate-fade-in-up delay-200">
            @forelse($users as $user)
                <div
                    class="flex items-center gap-4 px-6 py-4 border-b border-slate-100 last:border-b-0 hover:bg-slate-50/80 transition-all duration-200 group">
                    <!-- Avatar -->
                    <div
                        class="w-10 h-10 rounded-full flex items-center justify-center text-white font-bold text-sm flex-shrink-0
                                                                                                                        {{ $user->role == 'admin' ? 'bg-gradient-to-br from-purple-500 to-purple-600' : 'bg-gradient-to-br from-blue-500 to-cyan-400' }}">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>

                    <!-- Content -->
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2">
                            <h3 class="text-sm font-semibold text-slate-800">{{ $user->name }}</h3>
                            <span
                                class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold uppercase tracking-wider
                                                                                                                                {{ $user->role == 'admin' ? 'bg-purple-50 text-purple-600 border border-purple-100' : 'bg-blue-50 text-blue-600 border border-blue-100' }}">
                                {{ $user->role }}
                            </span>
                        </div>
                        <p class="text-xs text-slate-400 mt-0.5">
                            {{ $user->email }}
                            @if($user->role == 'student')
                                <span class="text-slate-300 mx-1">•</span> NIS: {{ $user->nis }} <span
                                    class="text-slate-300 mx-1">•</span> {{ $user->class_name ?? '-' }}
                            @endif
                        </p>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center gap-2 flex-shrink-0">
                        <a href="{{ route('admin.users.edit', $user->id) }}"
                            class="p-2 rounded-lg text-slate-400 hover:text-blue-600 hover:bg-blue-50 transition-colors"
                            title="Edit">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                </path>
                            </svg>
                        </a>
                        @if(auth()->id() !== $user->id)
                            <button type="button"
                                class="p-2 rounded-lg text-red-600 bg-red-50 hover:bg-red-100 border border-red-200 transition-colors cursor-pointer relative z-10 shadow-sm"
                                onclick="openDeleteModal('{{ route('admin.users.destroy', $user->id) }}', 'Hapus Pengguna', 'Apakah Anda yakin ingin menghapus pengguna ini? Data yang dihapus tidak dapat dikembalikan.')"
                                title="Hapus">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                    </path>
                                </svg>
                            </button>
                        @endif
                    </div>
                </div>
            @empty
                <div class="p-12 text-center text-slate-400">
                    <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-base font-semibold text-slate-700 mb-1">Tidak ada pengguna</h3>
                    <p class="text-sm text-slate-400">Belum ada pengguna yang sesuai filter.</p>
                </div>
            @endforelse
            @if($users->count() > 0)
                <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection