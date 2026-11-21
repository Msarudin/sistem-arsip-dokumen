# Sistem Arsip Dokumen Digital

Aplikasi berbasis web untuk mengelola, mengelompokkan kategori, mencari, melihat pratinjau, dan mengunduh arsip dokumen penting (PDF, JPG, PNG) secara digital dan terstruktur. Dibangun menggunakan **CodeIgniter 4**, **Bootstrap**, serta terintegrasi dengan **Cloud Object Storage (S3-Compatible / Tigris)** untuk penyimpanan file dokumen.

**Dikembangkan oleh:** Muhamad Sarudin Efendi

---

## Fitur Utama

- **Autentikasi Pengguna:** Sistem login admin dengan proteksi _session_ dan konfirmasi keluar (_Sign out_).
- **Dashboard Ringkasan:** Menampilkan statistik jumlah kategori dan total dokumen arsip yang tersimpan.
- **Manajemen Kategori:** Tambah, ubah, dan hapus jenis kategori dokumen (seperti Surat Masuk, Surat Keluar, SK, Laporan, dll.).
- **Manajemen Arsip Digital:**
  - Unggah dokumen baru (format `.pdf`, `.jpg`, `.jpeg`, `.png`) lengkap dengan judul, kategori, dan deskripsi.
  - Penyimpanan dokumen terpisah di **Cloud Storage (S3 API)** menggunakan _Presigned URL_ untuk keamanan akses.
  - **Pratinjau (_Lihat File_)** langsung di tab browser baru dan **Unduh (_Download_)** otomatis dengan penamaan file sesuai judul arsip.
  - Pencarian arsip secara _real-time_ berdasarkan judul, deskripsi, maupun kategori.

---

## Teknologi yang Digunakan

- **Framework:** CodeIgniter 4 (PHP 8.2+)
- **Database:** MySQL / MariaDB
- **Frontend:** Bootstrap, jQuery, SweetAlert2
- **Cloud Storage:** AWS SDK for PHP (`aws/aws-sdk-php`) — S3 Compatible (Tigris Data)

---

## Panduan Instalasi & Konfigurasi

### 1. Clone Repository & Instal Dependensi

Buka terminal dan jalankan perintah berikut:

```bash
git clone https://github.com
cd sistem-arsip-dokumen
composer install
```

### 2. Impor Database (`arsip.sql`)

1. Buka **phpMyAdmin** (`http://localhost/phpmyadmin`).
2. Buat database baru dengan nama **`arsip`**.
3. Pilih database **`arsip`**, buka tab **Import**, lalu pilih file **`arsip.sql`** yang tersedia di direktori utama proyek ini dan klik **Import / Go**.

### 3. Konfigurasi File `.env`

Salin file `env` menjadi `.env`, lalu sesuaikan pengaturan aplikasi, database, dan kredensial S3 Cloud Storage Anda:

```env
CI_ENVIRONMENT = development

app.baseURL = 'http://localhost:8080/'

# Konfigurasi Database
database.default.hostname = localhost
database.default.database = arsip
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi

# Konfigurasi Cloud Storage (S3 Compatible)
S3_ENDPOINT   = "https://tigris.dev"
S3_ACCESS_KEY = "masukkan_access_key_id_anda"
S3_SECRET_KEY = "masukkan_secret_access_key_anda"
S3_BUCKET     = "nama-bucket-anda"
```

### 4. Jalankan Aplikasi

Jalankan server lokal CodeIgniter 4 melalui terminal:

```bash
php spark serve
```

Buka browser dan akses **`http://localhost:8080`**.

---

## Informasi Akun Login (Default)

Gunakan akun admin yang terdaftar pada tabel `users` di dalam database `arsip.sql` untuk masuk ke sistem:

- **Halaman Login:** `http://localhost:8080/login`
- **Email:** _(sesuaikan dengan email admin pada database `arsip.sql` Anda)_
- **Password:** _(sesuaikan dengan password admin pada database `arsip.sql` Anda)_

---

&copy; 2026 Muhamad Sarudin Efendi. All rights reserved.
