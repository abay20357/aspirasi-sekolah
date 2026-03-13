<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Rute Web
|--------------------------------------------------------------------------
|
| Di sini Anda dapat mendaftarkan rute web untuk aplikasi Anda. Rute-rute ini
| dimuat oleh RouteServiceProvider dan semuanya akan ditetapkan ke grup
| middleware "web". Buatlah sesuatu yang hebat!
|
*/

// Halaman Utama (Landing Page)
Route::get('/', function () {
    return view('welcome');
})->name('landing');

// Halaman Pelacakan Aspirasi (Tanpa Login)
Route::get('/track', function (\Illuminate\Http\Request $request) {
    $keyword = $request->query('id');
    $aspiration = null;
    if ($keyword) {
        // Hapus tanda # jika ada
        $keyword = str_replace('#', '', $keyword);
        // Cari aspirasi berdasarkan ID (tiket)
        $aspiration = \App\Models\Aspiration::with('category')->find($keyword);
    }
    return view('track', compact('aspiration', 'keyword'));
})->name('track');

// Rute Autentikasi
// Rute Autentikasi (Hanya untuk tamu/belum login)
Route::middleware('guest')->group(function () {
    // Tampilkan form login
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    // Proses login
    Route::post('/login', [AuthController::class, 'login']);
    // Cek apakah NIS siswa terdaftar (AJAX)
    Route::post('/check-nis', [AuthController::class, 'checkNis'])->name('check-nis');
});

// Proses Logout
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Pengalihan Dasbor Cerdas
Route::get('/dashboard', function () {
    /** @var \App\Models\User|null $user */
    $user = Auth::user();
    if ($user && $user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('student.dashboard');
})->middleware('auth')->name('dashboard');

// Rute Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    // Sumber Daya Rute untuk Admin
    // Aspirasi: hanya tampilkan, detail, dan update (tanggapan)
    Route::resource('aspirations', App\Http\Controllers\Admin\AspirationController::class)->only(['index', 'show', 'update']);
    // Kategori: CRUD lengkap
    Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class);
    // Pengguna: CRUD lengkap
    Route::resource('users', App\Http\Controllers\Admin\UserController::class);
    // Laporan: Halaman laporan/rekap
    Route::get('/reports', [App\Http\Controllers\Admin\ReportController::class, 'index'])->name('reports.index');
});

// Rute Siswa
Route::middleware(['auth', 'role:student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Student\DashboardController::class, 'index'])->name('dashboard');

    // Sumber Daya Rute untuk Siswa
    // Aspirasi: CRUD kecuali hapus, edit, dan update (siswa hanya bisa buat dan lihat)
    Route::resource('aspirations', App\Http\Controllers\Student\AspirationController::class)->except(['destroy', 'edit', 'update']);
});
