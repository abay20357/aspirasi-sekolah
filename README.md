# Aplikasi Pengaduan Sarana Sekolah (UKK RPL 2025/2026)

Aplikasi web untuk menampung aspirasi/pengaduan siswa terkait sarana dan prasarana sekolah.

## Teknologi
- **Backend**: Laravel 11
- **Database**: MySQL
- **CSS Framework**: Tailwind CSS v4
- **Auth**: Custom Authentication (Multi-role: Admin & Student)

## Fitur

### Siswa
- Login dengan NIS & Password
- Dashboard ringkasan aspirasi
- Kirim aspirasi baru (Judul, Kategori, Foto, Lokasi)
- Lihat riwayat aspirasi & detail progres
- Notifikasi status (Menunggu, Diproses, Selesai, Ditolak)

### Admin
- Login dengan Username & Password
- Dashboard statistik & grafik aspirasi
- Manajemen Aspirasi (Filter, Update Status, Beri Feedback)
- Manajemen Kategori Sarana
- Manajemen User (Siswa & Admin)
- Laporan Aspirasi (Filter & Cetak)

## Instalasi

1. **Clone Repository** (atau extract folder)
2. **Install Dependencies**
   ```bash
   composer install
   npm install
   ```
3. **Environment Setup**
   - Copy `.env.example` ke `.env`
   - Atur database di `.env`:
     ```env
     DB_DATABASE=aspirasi_sekolah
     ```
4. **Generate Key**
   ```bash
   php artisan key:generate
   ```
5. **Migrate & Seed**
   ```bash
   php artisan migrate --seed
   ```
   *Jika `migrate` error, pastikan database sudah ada.*

6. **Jalankan Aplikasi**
   - Jalankan Vite (untuk CSS):
     ```bash
     npm run dev
     ```
   - Jalankan Server Laravel:
     ```bash
     php artisan serve
     ```

## Akun Default

### Admin
- **Username**: `admin`
- **Password**: `password`

### Siswa
- **NIS**: `12345678`
- **Password**: `password`

## Struktur Direktori Penting
- `app/Http/Controllers/AuthController.php` - Logika Login/Logout
- `app/Http/Controllers/Student/*` - Controller Siswa
- `app/Http/Controllers/Admin/*` - Controller Admin
- `resources/views/student/*` - View Siswa
- `resources/views/admin/*` - View Admin
- `database/migrations/*` - Skema Database

