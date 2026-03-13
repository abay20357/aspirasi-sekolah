<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Aspiration;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AspirationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // Menampilkan daftar aspirasi milik siswa yang sedang login
    public function index()
    {
        // Ambil aspirasi hanya milik user yang login, urutkan dari terbaru
        $aspirations = Auth::user()->aspirations()->latest()->get();
        return view('student.aspirations.index', compact('aspirations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // Menampilkan form untuk membuat aspirasi baru
    public function create()
    {
        $categories = Category::all(); // Ambil semua kategori untuk dropdown
        return view('student.aspirations.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    // Menyimpan aspirasi baru ke database
    public function store(Request $request)
    {
        // Validasi input: judul, kategori, dan gambar (opsional)
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048', // 2MB Max
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('aspirations', 'public');
        }

        // Simpan data aspirasi terhubung dengan user yang login
        Auth::user()->aspirations()->create([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'image_path' => $imagePath,
            'status' => 'pending', // Status awal selalu pending
        ]);

        return redirect()->route('student.aspirations.index')->with('success', 'Aspirasi berhasil dikirim dan akan segera diproses.');
    }

    /**
     * Display the specified resource.
     */
    // Menampilkan detail aspirasi tertentu
    public function show(string $id)
    {
        // Pastikan siswa hanya bisa melihat aspirasi miliknya sendiri
        $aspiration = Auth::user()->aspirations()->with(['category', 'progress.admin'])->findOrFail($id);
        return view('student.aspirations.show', compact('aspiration'));
    }
}
