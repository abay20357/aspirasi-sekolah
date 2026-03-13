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
        // Membuat tabel 'users' untuk menyimpan data pengguna (Siswa & Admin)
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Primary Key (AI)
            $table->string('nis', 20)->unique()->nullable(); // Nomor Induk Siswa (Unik, boleh kosong untuk admin)
            $table->string('name'); // Nama Lengkap
            $table->string('username')->unique(); // Username untuk login (Unik)
            $table->string('email')->unique()->nullable(); // Email (Unik, opsional untuk siswa tertentu)
            $table->timestamp('email_verified_at')->nullable(); // Waktu verifikasi email
            $table->string('password'); // Password terenskripsi (Hash)
            $table->enum('role', ['admin', 'student'])->default('student'); // Peran pengguna: admin atau student
            $table->string('class_name', 50)->nullable(); // Nama Kelas (Opsional, hanya untuk siswa)
            $table->rememberToken(); // Token untuk fitur "Remember Me"
            $table->timestamps(); // Kolom created_at dan updated_at otomatis
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
