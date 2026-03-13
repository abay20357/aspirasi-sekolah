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
        // Membuat tabel 'categories' untuk jenis-jenis fasilitas sekolah
        Schema::create('categories', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('name', 100); // Nama kategori (misal: Lab Komputer, Kantin)
            $table->text('description')->nullable(); // Deskripsi kategori (Opsional)
            $table->timestamps(); // Waktu pembuatan dan update
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
