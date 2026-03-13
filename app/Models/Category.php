<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Kolom yang boleh diisi (Nama Kategori, Deskripsi, Gambar Ikon)
    protected $fillable = [
        'name',
        'description',
        'image_path',
    ];

    // Relasi: Satu Kategori bisa memiliki banyak Aspirasi
    public function aspirations()
    {
        return $this->hasMany(Aspiration::class);
    }
}
