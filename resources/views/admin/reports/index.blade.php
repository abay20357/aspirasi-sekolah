@extends('layouts.app')

@section('title', 'Laporan Aspirasi')

@section('content')
    <div class="space-y-6">
        <div
            class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 animate-fade-in-up no-print">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Laporan Aspirasi</h1>
                <p class="text-slate-500 mt-1">Ringkasan data aspirasi untuk keperluan laporan.</p>
            </div>
            <button onclick="window.print()"
                class="group px-5 py-2.5 bg-slate-800 text-white rounded-xl font-medium shadow-lg shadow-slate-800/20 hover:bg-slate-700 transition-all duration-300 flex items-center gap-2 transform hover:-translate-y-0.5">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z">
                    </path>
                </svg>
                Cetak Laporan
            </button>
        </div>

        <!-- Filter -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 animate-fade-in-up delay-100 no-print">
            <form method="GET" action="{{ route('admin.reports.index') }}">
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
                    <div>
                        <label for="date_to" class="block text-sm font-medium text-slate-600 mb-1.5">Sampai Tanggal</label>
                        <input type="date" name="date_to" id="date_to" value="{{ request('date_to') }}"
                            class="w-full px-4 py-2.5 rounded-xl border-2 border-slate-200 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all text-sm">
                    </div>
                </div>
                <div class="mt-4 flex justify-end gap-2">
                    <a href="{{ route('admin.reports.index') }}"
                        class="px-5 py-2.5 rounded-xl border-2 border-slate-200 text-slate-600 font-medium hover:bg-slate-50 hover:border-slate-300 transition-all duration-200 text-sm">Reset</a>
                    <button type="submit"
                        class="px-5 py-2.5 bg-gradient-to-r from-blue-600 to-blue-500 text-white rounded-xl border-2 border-transparent font-medium shadow-lg shadow-blue-600/20 hover:shadow-blue-600/30 transition-all duration-300 text-sm flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z">
                            </path>
                        </svg>
                        Terapkan Filter
                    </button>
                </div>
            </form>
        </div>

        <!-- Print Header -->
        <div class="hidden print-block mb-8 text-center">
            <h1 class="text-2xl font-bold">Laporan Pengaduan Sarana Sekolah</h1>
            <p class="text-gray-600">SMK Rekayasa Perangkat Lunak</p>
            <p class="text-sm text-gray-500 mt-2">
                Periode:
                {{ request('date_from') ? \Carbon\Carbon::parse(request('date_from'))->format('d M Y') : 'Awal' }}
                s/d
                {{ request('date_to') ? \Carbon\Carbon::parse(request('date_to'))->format('d M Y') : 'Sekarang' }}
            </p>
        </div>

        <!-- Report Table -->
        <div
            class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden animate-fade-in-up delay-200 print-shadow-none">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200">
                            <th class="px-5 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                No</th>
                            <th class="px-5 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Tanggal</th>
                            <th class="px-5 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Pelapor</th>
                            <th class="px-5 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Kategori</th>
                            <th class="px-5 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Judul</th>
                            <th class="px-5 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($aspirations as $index => $aspiration)
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <td class="px-5 py-4 text-sm text-slate-400 font-mono">{{ $index + 1 }}</td>
                                <td class="px-5 py-4 text-sm text-slate-600">{{ $aspiration->created_at->format('d/m/Y') }}</td>
                                <td class="px-5 py-4 text-sm font-medium text-slate-800">{{ $aspiration->user->name }}</td>
                                <td class="px-5 py-4 text-sm text-slate-600">{{ $aspiration->category->name }}</td>
                                <td class="px-5 py-4 text-sm text-slate-800">{{ Str::limit($aspiration->title, 50) }}</td>
                                <td class="px-5 py-4">
                                    @if($aspiration->status == 'pending')
                                        <span
                                            class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-amber-50 text-amber-600 text-xs font-semibold border border-amber-100">Menunggu</span>
                                    @elseif($aspiration->status == 'processed')
                                        <span
                                            class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-purple-50 text-purple-600 text-xs font-semibold border border-purple-100">Diproses</span>
                                    @elseif($aspiration->status == 'completed')
                                        <span
                                            class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-green-50 text-green-600 text-xs font-semibold border border-green-100">Selesai</span>
                                    @elseif($aspiration->status == 'rejected')
                                        <span
                                            class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-red-50 text-red-600 text-xs font-semibold border border-red-100">Ditolak</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-5 py-12 text-center text-slate-400 text-sm">Tidak ada data yang sesuai
                                    filter.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Print Footer -->
        <div class="hidden print-block mt-8 text-right px-6">
            <p class="text-sm text-gray-600">Dicetak pada: {{ now()->format('d M Y H:i') }}</p>
            <br><br><br>
            <p class="text-sm font-bold text-gray-900">Administrator</p>
        </div>
    </div>

    <style>
        @media print {
            .no-print {
                display: none !important;
            }

            .print-block {
                display: block !important;
            }

            .print-shadow-none {
                box-shadow: none !important;
            }

            body {
                background-color: white !important;
            }

            .max-w-6xl {
                max-width: 100% !important;
            }
        }
    </style>
@endsection