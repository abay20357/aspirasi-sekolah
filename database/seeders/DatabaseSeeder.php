<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin
        User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@school.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create Default Student
        User::create([
            'nis' => '12345678',
            'name' => 'Siswa Contoh',
            'username' => 'siswa',
            'email' => 'siswa@school.com',
            'password' => Hash::make('password'),
            'role' => 'student',
            'class_name' => 'X RPL 1',
        ]);

        // Create Categories
        $categories = [
            'Ruang Kelas',
            'Laboratorium',
            'Toilet',
            'Perpustakaan',
            'Lapangan',
            'Lainnya',
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
                'description' => 'Fasilitas ' . $category,
            ]);
        }
    }
}
