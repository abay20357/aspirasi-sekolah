<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // Menampilkan daftar semua kategori
    public function index()
    {
        // Ambil kategori beserta jumlah aspirasi di dalamnya
        $categories = Category::withCount('aspirations')->get();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    // Menyimpan kategori baru
    public function store(Request $request)
    {
        // Validasi nama kategori harus unik
        $request->validate([
            'name' => 'required|string|max:100|unique:categories',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $data = $request->only(['name', 'description']);

        // Upload gambar jika ada
        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('categories', 'public');
        }

        Category::create($data);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    // Memperbarui data kategori
    public function update(Request $request, Category $category)
    {
        // Validasi nama unik, kecuali untuk kategori ini sendiri
        $request->validate([
            'name' => 'required|string|max:100|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $data = $request->only(['name', 'description']);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($category->image_path) {
                Storage::disk('public')->delete($category->image_path);
            }
            $data['image_path'] = $request->file('image')->store('categories', 'public');
        }

        // Handle image removal
        if ($request->has('remove_image') && $request->remove_image) {
            if ($category->image_path) {
                Storage::disk('public')->delete($category->image_path);
            }
            $data['image_path'] = null;
        }

        $category->update($data);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    // Menghapus kategori
    public function destroy(Category $category)
    {
        // Cek apakah ada aspirasi yang menggunakan kategori ini
        if ($category->aspirations()->count() > 0) {
            return back()->with('error', 'Kategori tidak dapat dihapus karena sedang digunakan oleh aspirasi.');
        }

        // Hapus gambar dari penyimpanan jika ada
        if ($category->image_path) {
            Storage::disk('public')->delete($category->image_path);
        }

        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
