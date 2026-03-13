<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Membuat tabel 'aspirations' untuk menyimpan laporan siswa
        Schema::create('aspirations', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Foreign Key ke tabel users (Siswa)
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade'); // Foreign Key ke tabel categories
            $table->string('title'); // Judul aspirasi
            $table->text('description'); // Deskripsi lengkap aspirasi
            $table->string('location')->nullable(); // Lokasi kejadian (Opsional)
            $table->string('image_path')->nullable(); // Path gambar bukti (Opsional)
            // Status aspirasi: pending (menunggu), processed (diproses), completed (selesai), rejected (ditolak)
            $table->enum('status', ['pending', 'processed', 'completed', 'rejected'])->default('pending');
            $table->text('feedback')->nullable(); // Tanggapan/Feedback dari admin (Opsional)
            $table->timestamps(); // Waktu pembuatan dan update
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aspirations');
    }
};
