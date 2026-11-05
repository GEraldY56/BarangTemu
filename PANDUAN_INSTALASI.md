# 📚 Panduan Instalasi & Penggunaan BarangTemu

Sistem Informasi Barang Hilang & Ditemukan untuk Sekolah

## 🚀 Instalasi

### 1. Clone atau Setup Project
```bash
cd c:\Projects\BarangTemu
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Setup Environment
```bash
copy .env.example .env
php artisan key:generate
```

### 4. Setup Database
Database menggunakan SQLite (sudah termasuk dalam project).

Jalankan migration dan seeder:
```bash
php artisan migrate:fresh --seed
```

### 5. Create Storage Link
```bash
php artisan storage:link
```

### 6. Compile Assets (Opsional)
```bash
npm run dev
```

### 7. Jalankan Server
```bash
php artisan serve
```

Buka browser dan akses: `http://localhost:8000`

---

## 👥 Akun Default

### Admin
- **Email:** admin@barangtemu.com
- **Password:** password
- **Role:** Admin
- **Akses:** Full dashboard admin, kelola semua laporan, update status

### User Siswa (5 akun tersedia)

1. **Rian Pratama**
   - Email: rian@student.com
   - Password: password
   - Kelas: XI MIPA 2

2. **Bima Arya**
   - Email: bima@student.com
   - Password: password
   - Kelas: XII IPS 1

3. **Nadia Zahra**
   - Email: nadia@student.com
   - Password: password
   - Kelas: X-4

4. **Dinda Kirana**
   - Email: dinda@student.com
   - Password: password
   - Kelas: XI IPA 2

5. **Ilham Ramadhan**
   - Email: ilham@student.com
   - Password: password
   - Kelas: XII MIPA 1

---

## 📋 Fitur Aplikasi

### 🏠 Halaman Publik (Tanpa Login)
- **Beranda:** Lihat statistik dan laporan terbaru
- **Daftar Barang:** Browse semua barang dengan filter dan pencarian
- **Detail Barang:** Lihat informasi lengkap barang

### 👤 Fitur User (Siswa)
- **Register & Login:** Buat akun baru atau login
- **Laporkan Barang:** Buat laporan barang hilang atau temuan
- **Upload Foto:** Upload foto barang (opsional)
- **Edit Laporan:** Edit laporan milik sendiri
- **Hapus Laporan:** Hapus laporan milik sendiri
- **Kontak Pelapor:** Hubungi via WhatsApp

### 👨‍💼 Fitur Admin
- **Dashboard Admin:** Panel manajemen lengkap
- **Kelola Semua Laporan:** View, edit, delete semua laporan
- **Update Status:** Ubah status barang (Belum Ditemukan, Sudah Ditemukan, Sudah Dikembalikan)
- **Filter Cepat:** Filter berdasarkan status
- **Statistik Real-time:** Lihat jumlah total, ditemukan, dikembalikan, pending

---

## 🗂️ Struktur Database

### Tabel: users
- id (Primary Key)
- name
- email (Unique)
- password (Hashed)
- role (admin/user)
- class (Kelas siswa)
- email_verified_at
- remember_token
- created_at
- updated_at

### Tabel: reports
- id (Primary Key)
- user_id (Foreign Key → users)
- title (Nama barang)
- category (Kategori)
- type (Barang Hilang/Barang Temuan)
- location (Lokasi)
- report_date (Tanggal kejadian)
- report_time (Waktu kejadian - opsional)
- status (Belum Ditemukan/Sudah Ditemukan/Sudah Dikembalikan)
- description (Deskripsi detail)
- reporter_name (Nama pelapor)
- reporter_class (Kelas pelapor)
- reporter_contact (Nomor WhatsApp)
- image_path (Path foto - opsional)
- created_at
- updated_at

---

## 🎨 Kategori Barang

1. **Elektronik & Gadget** - HP, kalkulator, flashdisk, earphone
2. **Alat Tulis & Buku** - Buku, tempat pensil, penggaris
3. **Pakaian & Jaket** - Jaket almamater, seragam
4. **Identitas & Kartu** - Kartu pelajar, KTP, dompet
5. **Kunci & Aksesoris** - Kunci motor/rumah, gantungan
6. **Lainnya** - Botol minum, tas, dll

---

## 🔄 Status Barang

1. **Belum Ditemukan** (Amber) - Barang masih hilang
2. **Sudah Ditemukan** (Green) - Barang sudah ditemukan, menunggu pemilik
3. **Sudah Dikembalikan** (Blue) - Barang sudah dikembalikan ke pemilik

---

## 📁 Struktur Folder Project

```
BarangTemu/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   │   └── AdminController.php
│   │   │   ├── Auth/
│   │   │   │   ├── LoginController.php
│   │   │   │   └── RegisterController.php
│   │   │   ├── HomeController.php
│   │   │   └── ReportController.php
│   │   └── Middleware/
│   │       └── RoleMiddleware.php
│   └── Models/
│       ├── User.php
│       └── Report.php
├── database/
│   ├── migrations/
│   │   ├── 2026_11_02_030108_create_reports_table.php
│   │   └── 2026_11_02_030330_add_role_to_users_table.php
│   └── seeders/
│       ├── DatabaseSeeder.php
│       ├── UserSeeder.php
│       └── ReportSeeder.php
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php
│       ├── admin/
│       │   └── dashboard.blade.php
│       ├── auth/
│       │   ├── login.blade.php
│       │   └── register.blade.php
│       ├── reports/
│       │   ├── show.blade.php
│       │   ├── create.blade.php
│       │   └── edit.blade.php
│       ├── home.blade.php
│       └── catalog.blade.php
├── routes/
│   └── web.php
└── storage/
    └── app/
        └── public/
            └── reports/ (Upload folder)
```

---

## 🛠️ Teknologi yang Digunakan

- **Backend:** Laravel 11.x
- **Database:** SQLite
- **Frontend:** Blade Templates
- **CSS Framework:** Tailwind CSS 3 (via CDN)
- **Icons:** Material Symbols Outlined
- **Fonts:** Plus Jakarta Sans (Google Fonts)
- **Design System:** Material Design 3

---

## 🎯 Cara Penggunaan

### Untuk Siswa:

1. **Register** dengan email, nama, dan kelas
2. **Login** dengan akun yang sudah dibuat
3. **Laporkan Barang:**
   - Klik "Laporkan Barang" di menu
   - Pilih jenis: Barang Hilang atau Barang Temuan
   - Isi form lengkap dengan detail barang
   - Upload foto (opsional tapi disarankan)
   - Klik "Kirim Laporan"
4. **Cari Barang:**
   - Buka "Daftar Barang"
   - Gunakan search dan filter
   - Klik "Lihat Detail" untuk info lengkap
   - Hubungi pelapor via WhatsApp jika cocok

### Untuk Admin:

1. **Login** sebagai admin
2. **Dashboard Admin:**
   - Lihat semua laporan dalam tabel
   - Filter berdasarkan status
   - Update status barang via dropdown
   - Hapus laporan jika diperlukan
3. **Kelola Laporan:**
   - Verifikasi laporan baru
   - Update status saat barang ditemukan/dikembalikan
   - Export data (fitur dalam pengembangan)

---

## 🔒 Keamanan

- Password di-hash menggunakan bcrypt
- Middleware authentication untuk routes yang memerlukan login
- Middleware role untuk memisahkan akses admin dan user
- CSRF protection pada semua form
- Validation pada semua input
- Authorization check pada edit/delete (hanya pemilik atau admin)

---

## 📝 Catatan Penting

1. **Upload Foto:** Maksimal 5MB, format JPG/PNG/JPEG
2. **Storage:** File disimpan di `storage/app/public/reports/`
3. **WhatsApp Link:** Otomatis generate dari nomor kontak
4. **Responsive:** Design responsif untuk mobile dan desktop
5. **Dark Mode:** Support untuk dark mode (via Tailwind)

---

## 🐛 Troubleshooting

### Error: Storage link not found
```bash
php artisan storage:link
```

### Error: Permission denied (storage)
```bash
chmod -R 775 storage bootstrap/cache
```

### Error: Database not found
```bash
touch database/database.sqlite
php artisan migrate:fresh --seed
```

### Error: Class not found
```bash
composer dump-autoload
```

---

## 📞 Support

Untuk bantuan lebih lanjut, hubungi:
- **Email:** sarpras@sman-teladan.sch.id
- **WhatsApp:** Pak Joko (Sarpras) - Ruang Piket Barat

---

## 📄 Lisensi

© 2024 BarangTemu Sekolah. Sistem Pelaporan Barang Hilang & Temuan.

---

**Selamat menggunakan BarangTemu! 🎉**
