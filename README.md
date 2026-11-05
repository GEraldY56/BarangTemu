# BarangTemu

> Sistem Informasi Pelaporan Barang Hilang dan Temuan untuk SMK Negeri 20 Jakarta

[![Laravel](https://img.shields.io/badge/Laravel-11-red)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.x-blue)](https://php.net)
[![License](https://img.shields.io/badge/License-Educational-green)](LICENSE)

## Deskripsi Project

**BarangTemu** adalah aplikasi web berbasis Laravel untuk membantu siswa dan staff sekolah melaporkan barang hilang atau barang yang ditemukan di lingkungan sekolah. Sistem ini memfasilitasi komunikasi antara pihak yang kehilangan barang dengan pihak yang menemukan, serta memudahkan pengelolaan laporan oleh administrator.

### Fitur Utama

- **Pelaporan Barang** - Siswa dapat melaporkan barang hilang atau barang temuan
- **Daftar Katalog** - Menampilkan semua laporan barang dalam sistem
- **Detail Laporan** - Informasi lengkap tentang setiap laporan termasuk kontak pelapor
- **Manajemen Status** - Admin dapat mengubah status laporan (Belum Ditemukan, Sudah Ditemukan, Sudah Dikembalikan)
- **Role-Based Access** - Pembagian akses antara User dan Admin
- **Upload Foto** - Mendukung unggah foto barang untuk identifikasi
- **Responsive Design** - Tampilan optimal di desktop dan mobile

### Pengembang

- **Nama:** Alvaro Geraldy
- **Kelas:** XII RPL
- **Sekolah:** SMK Negeri 20 Jakarta
- **Tahun:** 2024

---

## Daftar Isi

- [Teknologi yang Digunakan](#teknologi-yang-digunakan)
- [Persyaratan Sistem](#persyaratan-sistem)
- [Instalasi](#instalasi)
- [Konfigurasi](#konfigurasi)
- [Menjalankan Aplikasi](#menjalankan-aplikasi)
- [Struktur Database](#struktur-database)
- [Struktur Folder](#struktur-folder)
- [Panduan Penggunaan](#panduan-penggunaan)
- [Role dan Hak Akses](#role-dan-hak-akses)
- [Testing](#testing)
- [Troubleshooting](#troubleshooting)
- [Pengembangan Selanjutnya](#pengembangan-selanjutnya)
- [Lisensi](#lisensi)

---

## Teknologi yang Digunakan

### Backend
- **Laravel 11** - PHP Framework
- **MySQL** - Relational Database Management System
- **PHP 8.x** - Server-side scripting language

### Frontend
- **Blade Template Engine** - Laravel's templating engine
- **Tailwind CSS 3** - Utility-first CSS framework
- **JavaScript (Vanilla)** - Client-side interactivity
- **Material Symbols** - Icon library

### Design System
- **Material Design 3** - Google's design system
- **Plus Jakarta Sans** - Typography font family

### Tools & Environment
- **Composer** - PHP dependency manager
- **NPM/Vite** - Frontend build tools
- **XAMPP** - Local development environment (Apache + MySQL)

---

## Persyaratan Sistem

Sebelum instalasi, pastikan sistem Anda memiliki:

- **PHP** >= 8.1
- **Composer** >= 2.x
- **MySQL** >= 5.7 atau MariaDB >= 10.3
- **Node.js & NPM** >= 16.x (untuk asset compilation)
- **XAMPP** atau alternatif lain (Apache + MySQL)
- **Git** (untuk clone repository)

### PHP Extensions yang Diperlukan

- OpenSSL
- PDO
- Mbstring
- Tokenizer
- XML
- Ctype
- JSON
- BCMath
- Fileinfo

---

## Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/username/barangtemu.git
cd barangtemu
```

### 2. Install Dependencies

**Install PHP Dependencies:**
```bash
composer install
```

**Install Node Dependencies (jika ada):**
```bash
npm install
```

### 3. Setup Environment File

Copy file `.env.example` menjadi `.env`:

```bash
cp .env.example .env
```

**Windows (Command Prompt):**
```cmd
copy .env.example .env
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Buat Database

1. Buka phpMyAdmin: `http://localhost/phpmyadmin`
2. Buat database baru dengan nama `barangtemu`
3. Collation: `utf8mb4_unicode_ci`

### 6. Konfigurasi Database

Edit file `.env` dan sesuaikan dengan konfigurasi database Anda:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=barangtemu
DB_USERNAME=root
DB_PASSWORD=
```

### 7. Run Migration

```bash
php artisan migrate
```

### 8. Create Storage Link

```bash
php artisan storage:link
```

### 9. Build Assets (Opsional)

Jika menggunakan Vite atau asset compilation:

```bash
npm run build
```

---

## Konfigurasi

### File `.env`

File `.env` berisi konfigurasi sensitif aplikasi. **JANGAN** upload file ini ke repository publik.

**Konfigurasi Penting:**

```env
APP_NAME=BarangTemu
APP_ENV=local
APP_KEY=base64:xxxxxxxxxxxxx  # Generate dengan php artisan key:generate
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=barangtemu
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=database
QUEUE_CONNECTION=sync
```

### File `.env.example`

File `.env.example` adalah template untuk `.env` yang aman untuk dibagikan. File ini sudah disediakan di repository dan berisi placeholder nilai konfigurasi.

**Peringatan Keamanan:**

⚠️ **JANGAN PERNAH** commit ke Git:
- File `.env` dengan data sebenarnya
- `APP_KEY` yang aktif
- Password database
- API keys atau tokens
- Data pribadi apapun

---

## Menjalankan Aplikasi

### 1. Start MySQL via XAMPP

1. Buka **XAMPP Control Panel**
2. Klik **Start** pada **Apache** (untuk phpMyAdmin)
3. Klik **Start** pada **MySQL**
4. Pastikan keduanya berwarna hijau/running

### 2. Start Laravel Development Server

Buka terminal/command prompt di folder project:

```bash
php artisan serve
```

Server akan berjalan di: `http://127.0.0.1:8000`

**Catatan:** Jangan tutup terminal/command prompt saat server berjalan.

### 3. Akses Aplikasi

Buka browser dan akses:
```
http://127.0.0.1:8000
```

### 4. Register Akun Pertama

1. Klik tombol **Register** di halaman utama
2. Isi form registrasi:
   - Nama Lengkap
   - Email
   - Password (minimal 8 karakter)
   - Kelas (opsional)
3. Klik **Daftar**

**Default Role:** Akun yang baru dibuat otomatis memiliki role `user`

### 5. Promosi ke Role Admin

**Via phpMyAdmin:**
1. Buka `http://localhost/phpmyadmin`
2. Pilih database `barangtemu`
3. Klik tabel `users`
4. Edit user yang ingin dijadikan admin
5. Ubah kolom `role` dari `user` menjadi `admin`
6. Simpan perubahan

**Via SQL Query:**
```sql
UPDATE users SET role = 'admin' WHERE email = 'email@example.com';
```

⚠️ **Catatan Keamanan:**
Dalam implementasi production, promosi role admin sebaiknya dilakukan melalui fitur khusus yang dilindungi authentication dan authorization yang ketat.

---

## Struktur Database

### Tabel `users`

Menyimpan informasi akun pengguna sistem.

| Column | Type | Nullable | Key | Description |
|--------|------|----------|-----|-------------|
| id | BIGINT UNSIGNED | NO | PRI | Primary key, auto increment |
| name | VARCHAR(255) | NO | | Nama lengkap pengguna |
| email | VARCHAR(255) | NO | UNI | Email pengguna (unique) |
| email_verified_at | TIMESTAMP | YES | | Waktu verifikasi email |
| password | VARCHAR(255) | NO | | Password (hashed dengan bcrypt) |
| role | VARCHAR(50) | NO | | Role pengguna: 'admin' atau 'user' |
| class | VARCHAR(100) | YES | | Kelas siswa (nullable) |
| remember_token | VARCHAR(100) | YES | | Token untuk remember me |
| created_at | TIMESTAMP | YES | | Waktu pembuatan akun |
| updated_at | TIMESTAMP | YES | | Waktu update terakhir |

**Indexes:**
- PRIMARY KEY: `id`
- UNIQUE KEY: `email`

---

### Tabel `reports`

Menyimpan laporan barang hilang dan temuan.

| Column | Type | Nullable | Key | Description |
|--------|------|----------|-----|-------------|
| id | BIGINT UNSIGNED | NO | PRI | Primary key, auto increment |
| user_id | BIGINT UNSIGNED | NO | MUL | Foreign key ke tabel users |
| title | VARCHAR(255) | NO | | Nama/judul barang |
| category | VARCHAR(255) | NO | | Kategori barang |
| type | ENUM | NO | | 'Barang Hilang' atau 'Barang Temuan' |
| location | VARCHAR(255) | NO | | Lokasi kejadian |
| report_date | DATE | NO | | Tanggal kejadian |
| report_time | TIME | YES | | Waktu kejadian (nullable) |
| status | ENUM | NO | | Status: 'Belum Ditemukan', 'Sudah Ditemukan', 'Sudah Dikembalikan' |
| description | TEXT | NO | | Deskripsi detail barang |
| reporter_name | VARCHAR(255) | NO | | Nama pelapor |
| reporter_class | VARCHAR(255) | NO | | Kelas pelapor |
| reporter_contact | VARCHAR(255) | NO | | Kontak pelapor (WhatsApp) |
| image_path | VARCHAR(255) | YES | | Path file foto (nullable) |
| created_at | TIMESTAMP | YES | | Waktu laporan dibuat |
| updated_at | TIMESTAMP | YES | | Waktu update terakhir |

**Indexes:**
- PRIMARY KEY: `id`
- FOREIGN KEY: `user_id` REFERENCES `users(id)` ON DELETE CASCADE

**Enum Values:**
- `type`: 'Barang Hilang', 'Barang Temuan'
- `status`: 'Belum Ditemukan', 'Sudah Ditemukan', 'Sudah Dikembalikan'

---

### Relasi Database

```
users (1) ----< (many) reports
```

- Satu user dapat membuat banyak laporan (One to Many)
- Setiap laporan harus dimiliki oleh satu user (Belongs To)
- Jika user dihapus, semua laporannya juga ikut terhapus (CASCADE)

---

## Struktur Folder

```
barangtemu/
│
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/
│   │   │   │   ├── LoginController.php      # Handle login
│   │   │   │   └── RegisterController.php   # Handle register
│   │   │   ├── Admin/
│   │   │   │   └── AdminController.php      # Admin dashboard & management
│   │   │   ├── HomeController.php           # Home & catalog pages
│   │   │   └── ReportController.php         # CRUD laporan
│   │   └── Middleware/
│   │       └── RoleMiddleware.php           # Middleware role-based access
│   └── Models/
│       ├── User.php                         # User model
│       └── Report.php                       # Report model
│
├── database/
│   ├── migrations/
│   │   ├── *_create_users_table.php
│   │   ├── *_create_reports_table.php
│   │   ├── *_create_cache_table.php
│   │   └── *_create_sessions_table.php
│   └── seeders/
│       └── DatabaseSeeder.php               # (Disabled - tidak digunakan)
│
├── public/
│   ├── images/
│   │   └── logosmkn20.png                   # Logo sekolah
│   ├── storage/                             # Symlink ke storage/app/public
│   └── index.php                            # Entry point
│
├── resources/
│   ├── views/
│   │   ├── auth/
│   │   │   ├── login.blade.php              # Halaman login
│   │   │   └── register.blade.php           # Halaman register
│   │   ├── admin/
│   │   │   └── dashboard.blade.php          # Dashboard admin
│   │   ├── reports/
│   │   │   ├── create.blade.php             # Form buat laporan
│   │   │   ├── edit.blade.php               # Form edit laporan
│   │   │   └── show.blade.php               # Detail laporan
│   │   ├── layouts/
│   │   │   └── app.blade.php                # Layout template
│   │   ├── home.blade.php                   # Halaman beranda
│   │   └── catalog.blade.php                # Halaman daftar barang
│   ├── css/
│   └── js/
│
├── routes/
│   ├── web.php                              # Web routes
│   └── console.php                          # Console routes
│
├── storage/
│   ├── app/
│   │   ├── public/
│   │   │   └── reports/                     # Uploaded images
│   │   └── private/
│   ├── framework/
│   └── logs/
│
├── .env.example                             # Template environment config
├── .gitignore                               # Git ignore rules
├── artisan                                  # Artisan CLI
├── composer.json                            # PHP dependencies
├── package.json                             # Node dependencies
└── README.md                                # Dokumentasi ini
```

---

## Panduan Penggunaan

### Untuk User (Siswa)

#### 1. Melaporkan Barang Hilang

1. Login ke sistem
2. Klik tombol **"Laporkan Barang Sekarang"** di halaman utama
3. Pilih **"Barang Hilang"**
4. Isi formulir:
   - Nama barang
   - Kategori (Elektronik & Gadget, Alat Tulis & Buku, dll)
   - Lokasi terakhir dilihat
   - Tanggal dan waktu (opsional)
   - Deskripsi detail (warna, ciri khas, merk, dll)
   - Kontak WhatsApp
   - Upload foto (opsional)
5. Klik **"Kirim Laporan"**
6. Laporan akan muncul di Daftar Barang

#### 2. Melaporkan Barang Temuan

1. Login ke sistem
2. Klik tombol **"Laporkan Barang Sekarang"**
3. Pilih **"Barang Temuan"**
4. Isi formulir dengan detail barang yang ditemukan
5. Upload foto barang (sangat direkomendasikan)
6. Klik **"Kirim Laporan"**

#### 3. Mencari Barang di Katalog

1. Klik menu **"Daftar Barang"**
2. Browse semua laporan yang tersedia
3. Gunakan filter jika tersedia
4. Klik laporan untuk melihat detail lengkap
5. Hubungi pelapor via WhatsApp jika cocok

#### 4. Mengelola Laporan Sendiri

**Edit Laporan:**
- Buka detail laporan milik Anda
- Klik tombol **"Edit Laporan"**
- Ubah informasi yang diperlukan
- Simpan perubahan

**Hapus Laporan:**
- Buka detail laporan milik Anda
- Klik tombol **"Hapus Laporan"**
- Konfirmasi penghapusan

⚠️ **Catatan:** User hanya bisa edit/hapus laporan milik sendiri.

---

### Untuk Admin

#### 1. Mengakses Dashboard Admin

1. Login dengan akun admin
2. Klik menu **"Dashboard Admin"** di navigasi
3. Dashboard menampilkan:
   - Statistik total laporan
   - Jumlah barang yang sudah/belum ditemukan
   - Jumlah barang yang sudah dikembalikan
   - Daftar semua laporan

#### 2. Mengelola Status Laporan

1. Di dashboard admin, temukan laporan yang ingin dikelola
2. Klik dropdown status
3. Pilih status baru:
   - **Belum Ditemukan** - Barang masih hilang
   - **Sudah Ditemukan** - Barang ada di ruang sarpras
   - **Sudah Dikembalikan** - Barang sudah diserahkan ke pemilik
4. Status akan langsung tersimpan

#### 3. Menghapus Laporan

Admin dapat menghapus laporan apapun (termasuk milik user lain):
- Untuk moderasi konten yang tidak sesuai
- Untuk membersihkan laporan duplikat
- Untuk menghapus laporan spam

⚠️ **Catatan:** Penghapusan bersifat permanen dan tidak dapat dikembalikan.

---

## Role dan Hak Akses

### User (Pengguna Biasa)

**Dapat:**
- ✅ Membuat laporan barang hilang/temuan
- ✅ Melihat semua laporan di katalog
- ✅ Melihat detail setiap laporan
- ✅ Edit laporan milik sendiri
- ✅ Hapus laporan milik sendiri

**Tidak Dapat:**
- ❌ Mengakses dashboard admin
- ❌ Mengubah status laporan
- ❌ Edit/hapus laporan user lain

---

### Admin

**Dapat:**
- ✅ Semua hak akses user
- ✅ Mengakses dashboard admin
- ✅ Melihat statistik lengkap
- ✅ Mengubah status semua laporan
- ✅ Menghapus laporan apapun
- ✅ Moderasi konten

**Tanggung Jawab:**
- Update status laporan secara berkala
- Moderasi laporan yang tidak sesuai
- Koordinasi penyerahan barang ke pemilik

---

## Testing

### Manual Testing Checklist

#### Fitur Authentication
- [ ] Register akun baru
- [ ] Login dengan email & password
- [ ] Logout dari sistem
- [ ] Validasi form register (email format, password minimal 8 karakter)
- [ ] Validasi form login (field required)

#### Fitur Laporan (User)
- [ ] Buat laporan barang hilang
- [ ] Buat laporan barang temuan
- [ ] Upload foto pada laporan
- [ ] Edit laporan milik sendiri
- [ ] Hapus laporan milik sendiri
- [ ] Tidak bisa edit/hapus laporan user lain

#### Fitur Katalog
- [ ] Tampil daftar semua laporan
- [ ] Klik laporan untuk lihat detail
- [ ] Tampil informasi lengkap (foto, deskripsi, kontak)
- [ ] Tombol WhatsApp berfungsi

#### Fitur Admin
- [ ] Akses dashboard admin (dengan akun admin)
- [ ] Lihat statistik laporan
- [ ] Update status laporan
- [ ] Hapus laporan apapun
- [ ] User biasa tidak bisa akses dashboard admin

#### Fitur Upload
- [ ] Upload foto JPG/PNG
- [ ] Validasi ukuran maksimal 5MB
- [ ] Foto tersimpan di storage
- [ ] Foto tampil di halaman detail

#### Responsiveness
- [ ] Tampilan desktop (1920x1080)
- [ ] Tampilan tablet (768x1024)
- [ ] Tampilan mobile (375x667)

---

## Troubleshooting

### Server Laravel Tidak Bisa Start

**Error:** `Address already in use`

**Solusi:**
```bash
php artisan serve --port=8001
```
Lalu akses `http://127.0.0.1:8001`

---

### Database Connection Failed

**Error:** `SQLSTATE[HY000] [1045] Access denied`

**Penyebab:** Kredensial database salah

**Solusi:**
1. Cek file `.env` bagian database
2. Pastikan MySQL running di XAMPP
3. Verifikasi username dan password MySQL
4. Test koneksi di phpMyAdmin

---

### 404 Not Found Setelah Submit Form

**Penyebab:** Cache route

**Solusi:**
```bash
php artisan route:clear
php artisan config:clear
php artisan view:clear
```

---

### Upload Foto Gagal

**Error:** `The file "image" was not uploaded`

**Penyebab:** Storage link belum dibuat

**Solusi:**
```bash
php artisan storage:link
```

Pastikan folder `storage/app/public/reports` writable.

---

### Tampilan Tidak Ada Style

**Penyebab:** Asset belum di-build atau link CDN error

**Solusi:**
1. Cek koneksi internet (untuk Tailwind CDN)
2. Atau build asset lokal:
```bash
npm run build
```

---

### Session Not Working

**Penyebab:** Session driver tidak sesuai

**Solusi:**
Pastikan di `.env`:
```env
SESSION_DRIVER=database
```

Lalu jalankan migration untuk tabel sessions:
```bash
php artisan migrate
```

---

## Pengembangan Selanjutnya

Fitur-fitur yang direncanakan untuk versi mendatang:

### Fitur yang Sedang Dikembangkan

- [ ] **Email Notification** - Notifikasi email saat ada laporan baru atau update status
- [ ] **Export Data** - Export laporan ke Excel/PDF
- [ ] **Filter & Search** - Filter by kategori, status, tanggal
- [ ] **Dashboard Statistics** - Grafik statistik laporan bulanan
- [ ] **User Profile** - Halaman profil user dengan riwayat laporan
- [ ] **Forgot Password** - Fitur reset password via email
- [ ] **Real-time Notification** - Notifikasi real-time menggunakan WebSocket
- [ ] **Multi-language** - Support bahasa Indonesia dan Inggris
- [ ] **Dark Mode** - Theme gelap untuk kenyamanan mata
- [ ] **API Endpoint** - REST API untuk integrasi dengan aplikasi mobile

### Improvement yang Direncanakan

- [ ] Implementasi automated testing (PHPUnit)
- [ ] Code coverage report
- [ ] CI/CD pipeline dengan GitHub Actions
- [ ] Docker containerization
- [ ] Optimize database query dengan indexing
- [ ] Implement caching strategy (Redis)
- [ ] Add rate limiting untuk API
- [ ] Security audit dan penetration testing

---

## Lisensi

Project ini dibuat untuk keperluan **Ujian Sekolah Kompetensi (USK)** kelas XII RPL SMK Negeri 20 Jakarta tahun 2024.

**Pengembang:** Alvaro Geraldy - XII RPL

### Penggunaan

Project ini bersifat **educational** dan dapat digunakan sebagai:
- Referensi belajar Laravel
- Basis project serupa
- Portfolio pengembang

### Kredit

- **UI/UX Design:** Material Design 3
- **Framework:** Laravel 11
- **CSS Framework:** Tailwind CSS 3
- **Font:** Plus Jakarta Sans by Google Fonts
- **Icons:** Material Symbols by Google

---

## Pengembang

- **Nama:** Alvaro Geraldy
- **Email:** Tersedia melalui profil sekolah
- **Kelas:** XII RPL
- **Sekolah:** SMK Negeri 20 Jakarta

Untuk pertanyaan teknis atau bug report, silakan buat issue di repository GitHub atau hubungi pengembang.

---

**© 2024 BarangTemu - SMK Negeri 20 Jakarta**

*Membantu menemukan kembali barang berharga di lingkungan sekolah* 🎒✨
2. Klik **Start** pada **Apache**
3. Klik **Start** pada **MySQL**
4. Pastikan keduanya berwarna **HIJAU**

### 2. Start Laravel Server

Buka **Command Prompt** atau **PowerShell**, lalu jalankan:

```bash
cd C:\Projects\BarangTemu
php artisan serve
```

**JANGAN TUTUP** jendela Command Prompt ini! Server harus tetap berjalan.

Anda akan melihat:
```
INFO  Server running on [http://127.0.0.1:8000]
```

### 3. Buka Website di Browser

```
http://127.0.0.1:8000
```

**Website siap digunakan!** 🎉

---

## 👤 CARA MEMBUAT AKUN

### Register Akun Baru

1. Buka website: `http://127.0.0.1:8000`
2. Klik tombol **"Register"** di pojok kanan atas
3. Isi formulir:
   - **Nama Lengkap:** Nama lengkap Anda
   - **Email:** Email valid (contoh: `nama@example.com`)
   - **Password:** Minimal 8 karakter
   - **Konfirmasi Password:** Ketik ulang password
   - **Kelas:** (Opsional) Kelas Anda, contoh: XII RPL 1
4. Klik **"Daftar"**
5. Akun berhasil dibuat! Anda akan otomatis login.

**Default Role:** `user` (pengguna biasa)

---

## 🔑 UBAH ROLE KE ADMIN

Jika Anda ingin menjadi admin, ubah role setelah register:

```

### Cara 1: Via phpMyAdmin

1. Buka: `http://localhost/phpmyadmin`
2. Pilih database: `barangtemu`
3. Klik tabel: `users`
4. Cari akun Anda
5. Edit kolom `role` menjadi `admin`
6. Klik **Go**

### Cara 2: Via SQL Query

Di phpMyAdmin, jalankan query:
```sql
UPDATE users SET role = 'admin' WHERE email = 'alvaro@example.com';
```

Setelah ubah role, **logout** lalu **login** kembali untuk melihat perubahan.

---

## 📋 FITUR WEBSITE

### 🔵 Fitur User (Pengguna Biasa)

1. **Membuat Laporan Barang**
   - Klik "Laporkan Barang Sekarang"
   - Pilih jenis: Barang Hilang atau Barang Temuan
   - Isi detail barang
   - Upload foto (opsional)
   - Submit

2. **Melihat Daftar Laporan**
   - Menu "Daftar Barang"
   - Lihat semua laporan dari seluruh user
   - Filter berdasarkan status/kategori

3. **Melihat Detail Laporan**
   - Klik salah satu laporan
   - Lihat informasi lengkap
   - Kontak pelapor via WhatsApp

4. **Edit Laporan Sendiri**
   - Buka laporan milik Anda
   - Klik "Edit Laporan"
   - Ubah informasi
   - Submit

5. **Hapus Laporan Sendiri**
   - Buka laporan milik Anda
   - Klik "Hapus Laporan"
   - Konfirmasi

❌ **User TIDAK BISA:**
- Edit/hapus laporan orang lain
- Mengakses dashboard admin
- Ubah status laporan

---

### 🔴 Fitur Admin

Semua fitur user **PLUS:**

1. **Dashboard Admin**
   - Menu "Dashboard Admin"
   - Statistik laporan
   - Kelola semua laporan

2. **Update Status Laporan**
   - Ubah status laporan apapun:
     - Belum Ditemukan
     - Sudah Ditemukan
     - Sudah Dikembalikan

3. **Hapus Laporan Apapun**
   - Hapus laporan dari user manapun
   - Untuk moderasi konten

4. **Export Data** (Coming soon)
   - Export laporan ke Excel/PDF

---

## 🗄️ STRUKTUR DATABASE

### Database: `barangtemu`

- **Host:** `127.0.0.1`
- **Port:** `3306`
- **Username:** `root`
- **Password:** (kosong)

### Tabel Utama:

#### 1. `users` - Akun Pengguna

| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint | ID unik user |
| name | varchar(255) | Nama lengkap |
| email | varchar(255) | Email (unique) |
| password | varchar(255) | Password (hashed) |
| role | varchar(50) | admin / user |
| class | varchar(100) | Kelas siswa (nullable) |
| created_at | timestamp | Waktu register |
| updated_at | timestamp | Waktu update |

#### 2. `reports` - Laporan Barang

| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint | ID unik laporan |
| user_id | bigint | ID user pelapor (FK) |
| title | varchar(255) | Nama barang |
| category | varchar(255) | Kategori barang |
| type | enum | Barang Hilang / Barang Temuan |
| location | varchar(255) | Lokasi kejadian |
| report_date | date | Tanggal kejadian |
| report_time | time | Waktu kejadian (nullable) |
| status | enum | Status barang |
| description | text | Deskripsi detail |
| reporter_name | varchar(255) | Nama pelapor |
| reporter_class | varchar(255) | Kelas pelapor |
| reporter_contact | varchar(255) | Kontak pelapor |
| image_path | varchar(255) | Path foto (nullable) |
| created_at | timestamp | Waktu laporan dibuat |
| updated_at | timestamp | Waktu laporan diupdate |

**Relasi:**
- `reports.user_id` → `users.id` (belongsTo)
- Satu user bisa punya banyak laporan (hasMany)

---

## 🎨 TEKNOLOGI YANG DIGUNAKAN

### Backend:
- **Laravel 11** - PHP Framework
- **MySQL** - Database
- **PHP 8.x** - Programming Language

### Frontend:
- **Blade Templates** - Templating Engine
- **Tailwind CSS 3** - CSS Framework
- **Material Design 3** - Design System
- **Material Symbols** - Icon Set
- **JavaScript (Vanilla)** - Interactivity

### Design:
- **Stitch** - UI/UX Design
- **Plus Jakarta Sans** - Font Typography

---

## 📂 STRUKTUR PROJECT

```
BarangTemu/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/
│   │   │   │   ├── LoginController.php
│   │   │   │   └── RegisterController.php
│   │   │   ├── Admin/
│   │   │   │   └── AdminController.php
│   │   │   ├── HomeController.php
│   │   │   └── ReportController.php
│   │   └── Middleware/
│   │       └── RoleMiddleware.php
│   └── Models/
│       ├── User.php
│       └── Report.php
├── database/
│   ├── migrations/
│   │   ├── *_create_users_table.php
│   │   └── *_create_reports_table.php
│   └── seeders/
│       └── DatabaseSeeder.php (disabled)
├── public/
│   ├── images/
│   │   └── logosmkn20.png
│   └── storage/ (symlink)
├── resources/
│   └── views/
│       ├── auth/
│       │   ├── login.blade.php
│       │   └── register.blade.php
│       ├── admin/
│       │   └── dashboard.blade.php
│       ├── reports/
│       │   ├── create.blade.php
│       │   ├── edit.blade.php
│       │   └── show.blade.php
│       ├── layouts/
│       │   └── app.blade.php
│       ├── home.blade.php
│       └── catalog.blade.php
├── routes/
│   └── web.php
├── .env (configuration)
├── change_role.php (helper script)
└── README.md (this file)
```

---

## 🔧 TROUBLESHOOTING

### Website Tidak Bisa Diakses

**Penyebab:**
- Server Laravel tidak jalan
- Port 8000 sudah dipakai

**Solusi:**
1. Pastikan sudah jalankan `php artisan serve`
2. Cek jendela Command Prompt masih terbuka
3. Lihat ada tulisan "Server running on..."
4. Jika port 8000 dipakai, gunakan port lain:
   ```bash
   php artisan serve --port=8001
   ```
   Lalu akses: `http://127.0.0.1:8001`

---

### Form Tidak Bisa Submit

**Penyebab:**
- Cache browser
- JavaScript error

**Solusi:**
1. Hard refresh browser: **Ctrl + Shift + R**
2. Clear cache browser: **Ctrl + Shift + Delete**
3. Cek console browser (F12) untuk error
4. Coba browser lain (Chrome/Edge/Firefox)

---

### Login Gagal

**Penyebab:**
- Email/password salah
- User belum register
- Database tidak terkoneksi

**Solusi:**
1. Cek email dan password (case-sensitive)
2. Pastikan sudah register
3. Cek di phpMyAdmin apakah user ada:
   ```sql
   SELECT * FROM users WHERE email = 'your@email.com';
   ```
4. Pastikan XAMPP MySQL running

---

### Route 404 / Not Found

**Penyebab:**
- Cache route
- Server tidak reload

**Solusi:**
Clear semua cache:
```bash
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear
```

Lalu restart server:
```bash
# Stop server: Ctrl + C
php artisan serve
```

---

### Upload Foto Gagal

**Penyebab:**
- Storage link belum dibuat
- Ukuran file terlalu besar
- Format file tidak didukung

**Solusi:**
1. Buat storage link:
   ```bash
   php artisan storage:link
   ```
2. Maksimal ukuran foto: **5MB**
3. Format yang didukung: **JPG, PNG, JPEG**
4. Cek folder `storage/app/public/reports` ada dan writable

---

### Radio Button Tidak Interaktif

**Penyebab:**
- JavaScript belum load
- Cache browser

**Solusi:**
1. Hard refresh: **Ctrl + Shift + R**
2. Clear cache browser
3. Pastikan tidak ada JavaScript error di console (F12)

---

### Input Waktu Tidak Bisa Diklik

**Penyebab:**
- Browser tidak support `type="time"`
- Browser lama

**Solusi:**
1. Gunakan browser modern (Chrome/Edge/Firefox terbaru)
2. Klik di **icon jam**, bukan di placeholder
3. Atau ketik manual format **HH:MM** (contoh: 14:30)

---

## 🧹 MAINTENANCE

### Clear Cache (Jika Ada Masalah)

Jalankan semua perintah ini:
```bash
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear
php artisan optimize:clear
```

---

### Backup Database

Via phpMyAdmin:
1. Buka `http://localhost/phpmyadmin`
2. Pilih database `barangtemu`
3. Tab **Export**
4. Klik **Go**
5. File `.sql` akan terdownload

Via Command Line:
```bash
mysqldump -u root barangtemu > backup_barangtemu.sql
```

---

### Reset Database (HATI-HATI!)

⚠️ **WARNING:** Akan menghapus SEMUA data!

```bash
php artisan migrate:fresh
```

Jangan gunakan kecuali Anda benar-benar ingin reset dari awal!

---

## 📝 CATATAN PENTING

### ⚠️ Yang HARUS Diingat:

1. **Server Laravel harus jalan** setiap kali buka website
   ```bash
   php artisan serve
   ```

2. **Akses via Laravel server**, bukan XAMPP:
   - ✅ Benar: `http://127.0.0.1:8000`
   - ❌ Salah: `http://localhost/BarangTemu`

3. **XAMPP hanya untuk database**, bukan web server

4. **Seeder sudah dinonaktifkan** - gunakan Register manual

5. **Jangan jalankan `migrate:fresh`** - akan hapus semua data!

---

### ✅ Tips Penggunaan:

1. **Register dengan email yang valid** - untuk recovery jika lupa password (future)

2. **Gunakan password yang kuat** - minimal 8 karakter

3. **Upload foto barang** - memudahkan identifikasi

4. **Tulis deskripsi detail** - ciri khas, warna, merk, dll

5. **Cantumkan nomor WhatsApp aktif** - agar mudah dihubungi

---

## 🎯 WORKFLOW PENGGUNAAN

### Untuk Siswa yang Kehilangan Barang:

1. **Register** → Login
2. Klik **"Laporkan Barang Sekarang"**
3. Pilih: **Barang Hilang**
4. Isi detail barang yang hilang
5. Upload foto (jika ada)
6. Submit
7. Tunggu notifikasi jika ada yang menemukan
8. Cek **"Daftar Barang"** secara berkala

---

### Untuk Siswa yang Menemukan Barang:

1. **Register** → Login
2. Klik **"Laporkan Barang Sekarang"**
3. Pilih: **Barang Temuan**
4. Isi detail barang yang ditemukan
5. Upload foto barang
6. Submit
7. Pemilik akan menghubungi via WhatsApp
8. Serahkan ke Ruang Sarpras jika tidak ada yang klaim

---

### Untuk Admin/Petugas Sarpras:

1. **Register** → Ubah role ke `admin` → Login
2. Akses **"Dashboard Admin"**
3. Lihat semua laporan masuk
4. Update status barang:
   - **Belum Ditemukan** → barang masih hilang
   - **Sudah Ditemukan** → barang sudah ada di sarpras
   - **Sudah Dikembalikan** → sudah diserahkan ke pemilik
5. Hapus laporan spam/tidak valid
6. Monitor statistik laporan

---

## 📞 SUPPORT

### Jika Ada Masalah Teknis:

1. Cek bagian **Troubleshooting** di atas
2. Clear cache Laravel & browser
3. Restart server Laravel
4. Cek console browser untuk error (F12)

### Database Issue:

1. Cek XAMPP MySQL running
2. Cek file `.env` konfigurasi benar:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=barangtemu
   DB_USERNAME=root
   DB_PASSWORD=
   ```
3. Test koneksi di phpMyAdmin

---

## 📄 LICENSE

Project ini dibuat untuk keperluan UKK/USK kelas XII RPL SMK Negeri 20 Jakarta.

---

## 🎉 SELAMAT MENGGUNAKAN BARANGTEMU!

Website siap digunakan. Jika ada pertanyaan, lihat bagian Troubleshooting atau hubungi pengembang.

**Semoga membantu menemukan barang-barang yang hilang di sekolah!** 🎒✨
