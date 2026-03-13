# Tugas 3: Implementasi Pemodelan dalam Program

Bagian ini menjelaskan bagaimana **desain pemodelan data (ERD/Class Diagram)** diterjemahkan ke dalam kode program menggunakan konsep **MVC (Model-View-Controller)** dan **Eloquent ORM** di Laravel.

### A. Pemodelan Tabel ke Model (Eloquent ORM)

Dalam tahap perancangan, kita memiliki entitas `User`, `Aspiration`, dan `Category`. Berikut adalah implementasinya dalam kode:

1.  **Entitas User (`User.php`)**
    *   *Implementasi:* Merepresentasikan tabel `users`.
    *   *Kode:*
        ```php
        class User extends Authenticatable {
            // Relasi: Satu User bisa mengirim banyak Aspirasi
            public function aspirations() {
                return $this->hasMany(Aspiration::class);
            }
        }
        ```

2.  **Entitas Kategori (`Category.php`)**
    *   *Implementasi:* Merepresentasikan tabel `categories` (Fasilitas Sekolah).
    *   *Kode:*
        ```php
        class Category extends Model {
            protected $fillable = ['name', 'image_path'];
            
            // Relasi: Satu Kategori bisa memiliki banyak Aspirasi
            public function aspirations() {
                return $this->hasMany(Aspiration::class);
            }
        }
        ```

3.  **Entitas Aspirasi (`Aspiration.php`)**
    *   *Implementasi:* Merepresentasikan tabel `aspirations` (Laporan Siswa).
    *   *Kode:*
        ```php
        class Aspiration extends Model {
            // Relasi Balik: Aspirasi milik satu User
            public function user() {
                return $this->belongsTo(User::class);
            }
            
            // Relasi Balik: Aspirasi termasuk dalam satu Kategori
            public function category() {
                return $this->belongsTo(Category::class);
            }
        }
        ```

### B. Implementasi Relasi Antar Objek

Program menerapkan aturan bisnis melalui relasi antar model:

*   **One-to-Many (1:N):**
    *   *Konsep:* Satu siswa dapat mengirimkan banyak laporan aspirasi.
    *   *Implikasi Kode:* Saat siswa login, sistem dapat mengambil semua laporan miliknya dengan perintah `$user->aspirations()->get()`.

*   **Belongs-To (N:1):**
    *   *Konsep:* Setiap laporan aspirasi pasti memiliki satu pengirim (Siswa) dan satu jenis kategori (Fasilitas).
    *   *Implikasi Kode:* Pada halaman admin, kita bisa menampilkan nama pengirim laporan dengan mudah melalui `$aspiration->user->name` tanpa perlu query manual yang rumit.

### C. Penerapan Logika pada Controller

Pemodelan alur kerja (Flowchart) diimplementasikan dalam **Controller**:

*   **Validasi Input:** Sesuai flowchart, semua data diperiksa kelengkapannya sebelum disimpan menggunakan `$request->validate()`.
*   **Penyimpanan Data:** Perintah `Aspiration::create(...)` adalah implementasi dari blok "Simpan ke Database" pada diagram.
*   **Respon Balik:** Perintah `return redirect(...)` adalah implementasi dari alur "Tampilkan Pesan Sukses".

---

### D. Tools & Teknologi yang Digunakan

Berikut adalah daftar tools dan teknologi yang digunakan dalam pengembangan aplikasi ini, berdasarkan file konfigurasi (`composer.json` dan `package.json`):

#### 1. Backend & Server Side
*   **Laravel Framework (v12.0):** Kerangka kerja utama PHP yang digunakan untuk membangun struktur aplikasi Modern MVC.
*   **PHP (v8.2+):** Bahasa pemrograman server-side yang menjadi fondasi Laravel.
*   **Laragon:** Lingkungan pengembangan lokal (Local Development Environment) yang digunakan di Windows (Server WAMP/Nginx).
*   **Composer:** Manajer dependensi untuk PHP, digunakan untuk menginstal library Laravel.

#### 2. Frontend & UI
*   **Tailwind CSS (v4.0):** Framework CSS *utility-first* untuk styling tampilan yang modern dan responsif.
*   **Vite (v7.0):** Build tool frontend yang sangat cepat untuk mengkompilasi aset CSS dan JavaScript (pengganti Webpack/Laravel Mix).
*   **Alpine.js (v3.4):** Framework JavaScript ringan untuk interaktivitas sederhana (seperti dropdown, modal) tanpa kompleksitas React/Vue.
*   **Blade Templates:** Mesin template bawaan Laravel untuk merender tampilan HTML dinamis.
*   **Axios:** Library HTTP Client untuk melakukan request AJAX ke server (misal: cek NIS siswa).

#### 3. Development & Testing Tools
*   **Laravel Breeze:** Starter kit untuk sistem autentikasi (Login, Register, Password Reset) yang sudah terintegrasi.
*   **Pest PHP:** Framework pengujian (Testing) yang elegan dan ringkas untuk memastikan kode berjalan benar.
*   **Laravel Pint:** Alat untuk merapikan format kode PHP secara otomatis (*Code Style Fixer*).
*   **PostCSS & Autoprefixer:** Tool untuk memproses CSS agar kompatibel dengan berbagai browser.

---

### E. Implementasi Array dalam Kode

Dalam pemrograman PHP dan Laravel, **Array** adalah struktur data yang sangat penting untuk menyimpan sekumpulan data. Berikut adalah contoh penggunaan array dalam kode program ini:

#### 1. Array pada Model (Properti `$fillable`)
Di file `app/Models/User.php`, array digunakan untuk mendaftar kolom mana saja yang boleh diisi secara massal (*Mass Assignment*).

```php
protected $fillable = [
    'nis',
    'name',
    'username',
    'email',
    'password',
    'role',
    'class_name',
];
```
*Penjelasan:* Ini adalah **Indexed Array** yang berisi nama-nama kolom tabel.

#### 2. Array untuk Validasi Input
Di `app/Http/Controllers/AuthController.php`, array digunakan untuk menentukan aturan validasi bagi setiap input form.

```php
$request->validate([
    'identity' => ['required', 'string'],
    'password' => ['required', 'string'],
    'role'     => ['required', 'in:student,admin'],
]);
```
*Penjelasan:* Ini adalah **Associative Array** di mana *key* adalah nama input ('identity') dan *value*-nya adalah array aturan validasi.

#### 3. Array untuk Mengirim Data ke View
Saat menampilkan halaman, kita sering mengirimkan banyak data sekaligus menggunakan fungsi `compact()` yang sebenarnya membuat sebuah array.

```php
// Mengirim variabel $aspiration dan $keyword ke view 'track'
return view('track', compact('aspiration', 'keyword'));

// Sama dengan:
// return view('track', ['aspiration' => $aspiration, 'keyword' => $keyword]);
```

#### 4. Array dalam Konfigurasi (`casts`)
Laravel menggunakan array untuk mendefinisikan tipe data otomatis (*Type Casting*).

```php
protected function casts(): array
{
    return [
        'email_verified_at' => 'datetime',
        'password' => 'hashed', // Password otomatis di-hash saat disimpan
    ];
}
```
*Penjelasan:* Array ini memetakan kolom database ke tipe data PHP yang sesuai.

| Bagian     | Fungsi                    |
| ---------- | ------------------------- |
| Controller | Logika & proses data      |
| web.php    | Mengatur URL              |
| Migration  | Membuat struktur tabel    |
| Model      | Menghubungkan ke database |

// Dalam aplikasi ini, saya menerapkan Struktur Data Relasional menggunakan Database MySQL //yang dikelola lewat Eloquent ORM di Laravel. Saya mendefinisikan relasi antar entitas (User, Aspiration, Category). Untuk akses terhadap struktur data, saya menggunakan query Eloquent seperti Aspiration::with(...) yang mengembalikan data dalam bentuk Collection (struktur data list object), kemudian data tersebut saya akses/iterasi menggunakan looping di halaman frontend untuk ditampilkan ke pengguna."* 
