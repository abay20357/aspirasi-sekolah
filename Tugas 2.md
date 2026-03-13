# Tugas 2: Dokumentasi Fungsi dan Prosedur Sistem
## Aplikasi Aspirasi Sekolah

Dokumen ini berisi dokumentasi lengkap mengenai **5 fungsi/prosedur utama** dalam aplikasi Aspirasi Sekolah. Setiap fungsi dijelaskan secara rinci mulai dari deskripsi, parameter, nilai kembalian (*return value*), hingga penjelasan alur logika kode.

---

### 1. Autentikasi Siswa & Admin (`login`)

*   **Nama Fungsi:** `store`
*   **Lokasi File:** `app/Http/Controllers/Auth/AuthenticatedSessionController.php`
*   **Deskripsi:** Menangani proses login pengguna (autentikasi). Fungsi ini memvalidasi kredensial yang dikirim, membuat session baru jika valid, dan mengarahkan pengguna ke dashboard.

#### Kode & DocBlock
```php
    /**
     * Menangani permintaan autentikasi masuk (Login).
     *
     * Fungsi ini bertugas untuk:
     * 1. Memvalidasi data input (NIS/Email dan Password) melalui LoginRequest.
     * 2. Melakukan proses autentikasi.
     * 3. Membuat ulang session ID untuk mencegah serangan Session Fixation.
     * 4. Mengarahkan pengguna ke halaman yang dituju (dashboard).
     *
     * @param  LoginRequest  $request  Data permintaan yang berisi kredensial login.
     * @return RedirectResponse        Mengembalikan respon redirect ke dashboard jika sukses.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // 1. Autentikasi user (cek username/password)
        $request->authenticate();

        // 2. Regenerasi session untuk keamanan
        $request->session()->regenerate();

        // 3. Redirect ke halaman dashboard
        return redirect()->intended(route('dashboard', absolute: false));
    }
```

#### Penjelasan Logika
1.  **Validasi:** Menggunakan `LoginRequest` untuk memastikan input tidak kosong dan formatnya benar.
2.  **Authenticate:** Metode `$request->authenticate()` mencoba mencocokkan kredensial dengan data di database. Jika gagal, akan melempar *exception* dan kembali ke halaman login dengan pesan error.
3.  **Regenerasi Session:** Jika login berhasil, ID session diubah (`regenerate()`) untuk mencegah pencurian session lama.
4.  **Redirect:** Pengguna diarahkan ke halaman yang mereka coba akses sebelumnya, atau default ke dashboard.

---

### 2. Kirim Aspirasi Baru (`store`)

*   **Nama Fungsi:** `store`
*   **Lokasi File:** `app/Http/Controllers/Student/AspirationController.php`
*   **Deskripsi:** Menyimpan data aspirasi baru yang dikirim oleh siswa, termasuk mengunggah foto bukti jika ada.

#### Kode & DocBlock
```php
    /**
     * Menyimpan data aspirasi baru ke database.
     *
     * Proses yang dilakukan:
     * 1. Validasi input (judul, kategori, deskripsi, lokasi, gambar).
     * 2. Upload file gambar ke penyimpanan 'storage/app/public/aspirations' jika ada.
     * 3. Menyimpan data aspirasi ke tabel 'aspirations' terhubung dengan user yang login.
     * 4. Mengatur status awal menjadi 'pending'.
     *
     * @param  Request  $request  Data input dari form aspirasi siswa.
     * @return RedirectResponse   Redirect ke halaman daftar aspirasi dengan pesan sukses.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048', // Maksimal 2MB
        ]);

        // 2. Handle Upload Gambar
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('aspirations', 'public');
        }

        // 3. Simpan ke Database
        Auth::user()->aspirations()->create([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'image_path' => $imagePath,
            'status' => 'pending', // Status awal
        ]);

        // 4. Redirect dengan Pesan
        return redirect()->route('student.aspirations.index')
            ->with('success', 'Aspirasi berhasil dikirim dan akan segera diproses.');
    }
```

#### Penjelasan Logika
1.  **Validasi:** Memastikan judul, kategori, dan deskripsi terisi. Gambar bersifat opsional namun dibatasi maksimal 2MB.
2.  **Upload Gambar:** Jika siswa mengunggah foto, file disimpan ke folder `public/aspirations` dan path-nya disimpan dalam variabel `$imagePath`.
3.  **Penyimpanan Data:** Fungsi `create` digunakan pada relasi `aspirations()` milik `Auth::user()`. Ini otomatis mengisi kolom `user_id` dengan ID siswa yang sedang login. Status diset manual ke `pending`.

---

### 3. Filter & Tampil Daftar Aspirasi Admin (`index`)

*   **Nama Fungsi:** `index`
*   **Lokasi File:** `app/Http/Controllers/Admin/AspirationController.php`
*   **Deskripsi:** Menampilkan daftar semua aspirasi masuk di halaman admin dengan fitur pencarian dan filter (berdasarkan status, kategori, tanggal).

#### Kode & DocBlock
```php
    /**
     * Menampilkan daftar aspirasi dengan fitur filter.
     *
     * Logika program:
     * 1. Mengambil query dasar aspirasi beserta relasi user dan kategori.
     * 2. Menerapkan filter status jika dipilih.
     * 3. Menerapkan filter kategori jika dipilih.
     * 4. Menerapkan filter rentang tanggal (dari - sampai).
     * 5. Melakukan pagination (10 data per halaman).
     *
     * @param  Request  $request  Berisi parameter filter (status, category_id, date_from, date_to).
     * @return View               Mengembalikan view admin/aspirations/index dengan data.
     */
    public function index(Request $request)
    {
        // 1. Eager Loading Relasi
        $query = Aspiration::with(['user', 'category'])->latest();

        // 2. Filter Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // 3. Filter Kategori
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // 4. Filter Tanggal
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // 5. Eksekusi Query & Pagination
        $aspirations = $query->paginate(10)->withQueryString();
        $categories = Category::all(); // Untuk dropdown filter

        return view('admin.aspirations.index', compact('aspirations', 'categories'));
    }
```

#### Penjelasan Logika
1.  **Query Builder:** Memulai query ke model `Aspiration`. Menggunakan `with` untuk *Eager Loading* (mengambil data user dan kategori sekaligus agar efisien).
2.  **Conditional Where:** Mengecek setiap parameter (status, kategori, tanggal). Jika ada input (`filled`), maka tambahkan kondisi `where` ke query.
3.  **Pagination:** `paginate(10)` membatasi data hanya 10 per halaman. `withQueryString()` memastikan parameter filter tetap ada saat pindah halaman (misal: dari hal 1 ke 2).

---

### 4. Update Status Laporan (`update`)

*   **Nama Fungsi:** `update`
*   **Lokasi File:** `app/Http/Controllers/Admin/AspirationController.php`
*   **Deskripsi:** Mengubah status aspirasi (misal: dari Pending -> Processed -> Completed) dan menyimpan riwayat progres penanganan serta feedback untuk siswa.

#### Kode & DocBlock
```php
    /**
     * Memperbarui status aspirasi dan mencatat riwayat progres.
     *
     * Alur kerja:
     * 1. Mencari data aspirasi berdasarkan ID.
     * 2. Validasi status baru dan feedback.
     * 3. Membuat record baru di tabel 'aspiration_progress' untuk riwayat (tracking).
     * 4. Mengupdate status utama pada tabel 'aspirations'.
     *
     * @param  Request  $request  Data status baru, feedback, dan catatan internal.
     * @param  string   $id       ID aspirasi yang akan diupdate.
     * @return RedirectResponse   Kembali ke halaman detail dengan pesan sukses.
     */
    public function update(Request $request, string $id)
    {
        $aspiration = Aspiration::findOrFail($id);

        // 1. Validasi
        $request->validate([
            'status' => 'required|in:pending,processed,completed,rejected',
            'feedback' => 'nullable|string',
            'notes' => 'nullable|string', // Catatan internal admin
        ]);

        // 2. Catat Riwayat Progres
        $aspiration->progress()->create([
            'admin_id' => auth()->id(),
            'status' => $request->status,
            'progress_percentage' => $request->status == 'completed' ? 100 : ($request->status == 'processed' ? 50 : 0),
            'notes' => $request->notes ?? 'Status updated via detailed view.',
        ]);

        // 3. Update Status Utama & Feedback
        $aspiration->update([
            'status' => $request->status,
            'feedback' => $request->feedback,
        ]);

        return redirect()->route('admin.aspirations.show', $id)
            ->with('success', 'Status aspirasi berhasil diperbarui.');
    }
```

#### Penjelasan Logika
1.  **Logika Bisnis:** Tidak hanya mengubah satu kolom status, fungsi ini juga membuat "Log History" melalui relasi `progress()`. Ini penting agar siswa tahu kapan status berubah dan siapa admin yang mengubahnya.
2.  **Persentase:** Logika sederhana menentukan persentase: Selesai = 100%, Proses = 50%, Lainnya = 0%.
3.  **Feedback:** Admin dapat memberikan pesan balasan yang akan tampil di dashboard siswa.

---

### 5. Tambah Kategori dengan Gambar (`store`)

*   **Nama Fungsi:** `store`
*   **Lokasi File:** `app/Http/Controllers/Admin/CategoryController.php`
*   **Deskripsi:** Menambahkan kategori fasilitas baru (misal: "Lab Komputer") beserta ikon/gambar representatif.

#### Kode & DocBlock
```php
    /**
     * Menyimpan kategori baru ke database.
     *
     * Proses:
     * 1. Validasi nama kategori (harus unik) dan gambar (opsional).
     * 2. Upload gambar kategori jika ada.
     * 3. Simpan nama, deskripsi, dan path gambar ke database.
     *
     * @param  Request  $request  Input nama, deskripsi, dan file gambar.
     * @return RedirectResponse   Redirect ke index kategori.
     */
    public function store(Request $request)
    {
        // 1. Validasi Unik
        $request->validate([
            'name' => 'required|string|max:100|unique:categories',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $data = $request->only(['name', 'description']);

        // 2. Upload Gambar Kategori
        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('categories', 'public');
        }

        // 3. Simpan
        Category::create($data);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }
```

#### Penjelasan Logika
1.  **Unique Validation:** `unique:categories` memastikan tidak ada dua kategori dengan nama yang sama.
2.  **Mass Assignment:** Mengumpulkan data input ke array `$data` lalu menggunakan `Category::create($data)` untuk penyimpanan yang ringkas.
3.  **File Handling:** Mirip dengan fungsi aspirasi, namun disimpan di folder `categories` untuk kerapian struktur file.

---
**Catatan:** Dokumentasi ini disusun berdasarkan source code aktual pada tanggal pembuatan dokumen.
