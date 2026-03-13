<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aspiration;
use App\Models\Category;
use Illuminate\Http\Request;

class AspirationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // Menampilkan daftar aspirasi dengan fitur filter
    public function index(Request $request)
    {
        // Query dasar: ambil aspirasi beserta data user dan kategori (Eager Loading)
        $query = Aspiration::with(['user', 'category'])->latest();

        // Filters
        // Filter berdasarkan Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan Kategori
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filter berdasarkan Rentang Tanggal
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Paginate hasil (10 per halaman) dan pertahankan query string saat pindah halaman
        $aspirations = $query->paginate(10)->withQueryString();
        $categories = Category::all(); // Data kategori untuk dropdown filter

        return view('admin.aspirations.index', compact('aspirations', 'categories'));
    }

    /**
     * Display the specified resource.
     */
    // Menampilkan detail aspirasi tertentu
    public function show(string $id)
    {
        // Ambil aspirasi beserta relasi user, kategori, dan riwayat progress (beserta admin yg memproses)
        $aspiration = Aspiration::with(['user', 'category', 'progress.admin'])->findOrFail($id);
        return view('admin.aspirations.show', compact('aspiration'));
    }

    /**
     * Update the specified resource in storage.
     */
    // Memperbarui status aspirasi dan menambahkan feedback
    public function update(Request $request, string $id)
    {
        $aspiration = Aspiration::findOrFail($id);

        // Validasi input status dan feedback
        $request->validate([
            'status' => 'required|in:pending,processed,completed,rejected',
            'feedback' => 'nullable|string',
            'notes' => 'nullable|string', // Internal progress notes
        ]);

        // Buat Catatan Riwayat Progres (Tracking)
        $aspiration->progress()->create([
            'admin_id' => auth()->id(),
            'status' => $request->status,
            'progress_percentage' => $request->status == 'completed' ? 100 : ($request->status == 'processed' ? 50 : 0),
            'notes' => $request->notes ?? 'Status updated via detailed view.',
        ]);

        // Update Status Utama di tabel aspirations
        $aspiration->update([
            'status' => $request->status,
            'feedback' => $request->feedback, // Update final feedback if provided
        ]);

        return redirect()->route('admin.aspirations.index')
            ->with('success', 'Status aspirasi berhasil diperbarui.');
    }
}
