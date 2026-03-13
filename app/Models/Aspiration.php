<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aspiration extends Model
{
    use HasFactory;

    // Kolom-kolom yang boleh diisi secara massal (Mass Assignment)
    protected $fillable = [
        'user_id',      // ID Siswa pengirim
        'category_id',  // ID Kategori fasilitas
        'title',        // Judul laporan
        'description',  // Detail isi laporan
        'location',     // Lokasi kejadian/fasilitas
        'image_path',   // Path foto bukti (jika ada)
        'status',       // Status laporan (pending, processed, completed, rejected)
        'feedback',     // Tanggapan dari admin
    ];

    // Relasi: Aspirasi dimiliki oleh satu User (Siswa)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Aspirasi termasuk dalam satu Kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi: Aspirasi memiliki banyak riwayat progres (One to Many)
    public function progress()
    {
        return $this->hasMany(AspirationProgress::class);
    }
}
