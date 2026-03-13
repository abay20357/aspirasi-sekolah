# Tugas: Aplikasi Aspirasi Sekolah

## Soal / Studi Kasus

Sekolah membutuhkan sebuah sistem informasi yang efektif untuk menampung aspirasi, keluhan, dan masukan dari siswa mengenai sarana dan prasarana sekolah. Sistem ini diharapkan dapat menjadi jembatan komunikasi antara siswa dengan pihak manajemen sekolah agar setiap permasalahan dapat ditangani dengan cepat dan transparan.

**Ketentuan Fitur:**

1.  **Autentikasi:**
    -   Siswa dapat login menggunakan NIS dan Password (atau Username).
    -   Admin memiliki akses khusus untuk mengelola seluruh sistem.

2.  **Halaman Utama (Landing Page):**
    -   Menampilkan informasi umum tentang aplikasi.
    -   Menampilkan visual/video profil sekolah.
    -   Informasi cara penggunaan aplikasi.

3.  **Aktor Siswa:**
    -   Dapat melihat daftar aspirasi yang pernah dikirim.
    -   Dapat mengirim aspirasi baru dengan melampirkan kategori, lokasi, keterangan, dan foto pendukung.
    -   Dapat memantau status aspirasi (Menunggu, Proses, Selesai).
    -   Dapat melihat masukan/feedback dari admin.

4.  **Aktor Admin:**
    -   Dashboard statistik aspirasi (jumlah laporan masuk, diproses, selesai).
    -   Manajemen data Aspirasi (Melihat detail, Memberikan tanggapan, Mengubah status laporan).
    -   Manajemen Kategori Aspirasi (untuk pengelompokan laporan).
    -   Manajemen Laporan (Cetak Laporan / Rekapitulasi).

5.  **Teknologi:**
    -   Framework: Laravel
    -   Database: MySQL

---

## Deskripsi Program

**Nama Aplikasi:** Aspirasi Sekolah
**Deskripsi Singkat:**
Aspirasi Sekolah adalah platform berbasis web yang dirancang untuk memfasilitasi komunikasi dua arah yang konstruktif antara siswa dan pihak sekolah terkait kondisi sarana dan prasarana. Aplikasi ini bertujuan untuk meningkatkan transparansi dan mempercepat proses penanganan masalah di lingkungan sekolah, serta mendorong partisipasi aktif siswa dalam menjaga fasilitas sekolah.

**Fitur Utama:**
-   **Pelaporan Aspirasi Mudah:** Siswa dapat melaporkan kerusakan (misal: AC rusak, meja patah) atau memberikan saran pengembangan dengan mudah, lengkap dengan fitur unggah foto sebagai bukti.
-   **Tracking Status Real-time:** Siswa dapat memantau setiap perkembangan laporan mereka, mulai dari status 'Pending' (baru masuk), 'Proses' (sedang ditangani), hingga 'Selesai'.
-   **Respon Cepat & Interaktif:** Admin dapat langsung memberikan tanggapan atau feedback terhadap aspirasi yang masuk, sehingga siswa merasa didengar.
-   **Manajemen Kategori:** Pengelompokan aspirasi berdasarkan kategori (misal: Kebersihan, Keamanan, Fasilitas Kelas, Fasilitas Olahraga) untuk memudahkan petugas terkait dalam filtrasi masalah.
-   **Laporan & Statistik:** Fitur komprehensif bagi admin untuk mencetak laporan berkala dan melihat statistik pengaduan sebagai bahan evaluasi manajemen sekolah.

**Stack Teknologi:**
-   **Backend:** Laravel (PHP)
-   **Frontend:** Blade Templates, Tailwind CSS / Custom CSS
-   **Database:** MySQL
