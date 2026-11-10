# 📋 PANDUAN JAWABAN PERTANYAAN PENGUJI USK
## Project: BarangTemu - Lost & Found System

**Pengembang:** Alvaro Geraldy  
**Kelas:** XII RPL  
**Sekolah:** SMK Negeri 20 Jakarta

---

## 1️⃣ PENGETAHUAN UMUM

### Q: Apa itu BarangTemu?
**Jawaban:**
BarangTemu adalah sistem informasi berbasis web untuk pelaporan barang hilang dan barang temuan di lingkungan SMK Negeri 20 Jakarta. Sistem ini memfasilitasi komunikasi antara siswa yang kehilangan barang dengan siswa yang menemukan barang, serta memudahkan admin/petugas sarpras dalam mengelola laporan.

### Q: Mengapa membuat project ini?
**Jawaban:**
- **Problem:** Banyak siswa kehilangan barang di sekolah tapi sulit mencari informasi barang temuan
- **Solution:** Sistem terpusat untuk melaporkan dan mencari barang hilang/temuan
- **Impact:** Meningkatkan kemungkinan barang kembali ke pemilik dan memudahkan koordinasi

### Q: Siapa pengguna sistem ini?
**Jawaban:**
1. **Siswa/User** - Melaporkan barang hilang atau temuan, melihat katalog laporan
2. **Admin/Petugas Sarpras** - Mengelola laporan, update status, moderasi konten

### Q: Fitur utama apa saja yang ada?
**Jawaban:**
1. **Authentication** - Register dan login dengan role-based access
2. **Pelaporan** - Membuat laporan barang hilang atau temuan dengan foto
3. **Katalog** - Melihat daftar semua laporan
4. **Detail** - Informasi lengkap setiap laporan termasuk kontak pelapor
5. **CRUD** - User bisa edit/hapus laporan sendiri
6. **Admin Dashboard** - Statistik dan manajemen status laporan
7. **Upload Foto** - Mendukung upload gambar untuk identifikasi

---

## 2️⃣ BAHASA PEMROGRAMAN WEB DAN FRAMEWORK

### Q: Teknologi apa yang digunakan dalam project ini?
**Jawaban:**

**Backend:**
- **Laravel 11** - PHP Framework untuk struktur MVC, routing, dan ORM
- **PHP 8.x** - Bahasa pemrograman server-side
- **MySQL** - Database relational untuk menyimpan data

**Frontend:**
- **Blade Template Engine** - Laravel's templating system
- **Tailwind CSS 3** - Utility-first CSS framework untuk styling
- **JavaScript (Vanilla)** - Client-side interactivity tanpa library tambahan
- **Material Symbols** - Icon set dari Google

### Q: Kenapa memilih Laravel?
**Jawaban:**
1. **MVC Pattern** - Struktur code yang terorganisir dan maintainable
2. **Eloquent ORM** - Manipulasi database yang mudah dan aman dari SQL injection
3. **Blade Engine** - Templating yang powerful dengan syntax yang clean
4. **Built-in Authentication** - Sistem auth yang secure out-of-the-box
5. **Middleware** - Untuk role-based access control yang mudah diimplementasi
6. **Migration** - Version control untuk database schema
7. **Routing** - Sistem routing yang ekspresif dan mudah dipahami
8. **Security** - CSRF protection, password hashing, dan security features lainnya

### Q: Jelaskan struktur MVC dalam project ini!
**Jawaban:**

**Model (M):**
- `User.php` - Representasi tabel users, handle authentication
- `Report.php` - Representasi tabel reports, handle CRUD logic
- Eloquent ORM untuk query database

**View (V):**
- `resources/views/` - Semua file Blade template
- `layouts/app.blade.php` - Master layout
- `reports/create.blade.php`, `edit.blade.php`, `show.blade.php` - View untuk laporan
- `auth/login.blade.php`, `register.blade.php` - View authentication

**Controller (C):**
- `ReportController.php` - Handle CRUD operations untuk laporan
- `AdminController.php` - Handle admin dashboard dan management
- `HomeController.php` - Handle halaman public (home, catalog, detail)
- `Auth/LoginController.php` - Handle login/logout
- `Auth/RegisterController.php` - Handle registrasi user

### Q: Apa itu Eloquent ORM? Berikan contoh penggunaannya!
**Jawaban:**
Eloquent ORM adalah Object-Relational Mapping dari Laravel yang memudahkan interaksi dengan database menggunakan syntax PHP tanpa menulis raw SQL.

**Contoh dalam project:**

```php
// CREATE - Membuat laporan baru
Report::create([
    'user_id' => auth()->id(),
    'title' => 'Dompet Hitam',
    'type' => 'Barang Hilang',
    'status' => 'Belum Ditemukan'
]);

// READ - Mengambil semua laporan
$reports = Report::all();

// READ dengan relasi
$report = Report::with('user')->find($id);

// UPDATE - Mengubah status
$report->update(['status' => 'Sudah Ditemukan']);

// DELETE - Menghapus laporan
$report->delete();
```

**Keuntungan:**
- Lebih aman dari SQL injection
- Code lebih readable
- Support relasi antar tabel (hasMany, belongsTo)
- Built-in soft deletes, timestamps

### Q: Jelaskan routing dalam Laravel!
**Jawaban:**
Routing adalah proses mapping URL ke Controller method tertentu.

**Contoh dari `routes/web.php`:**

```php
// Route dasar
Route::get('/', [HomeController::class, 'index'])->name('home');

// Route dengan parameter
Route::get('/reports/{id}', [HomeController::class, 'show'])
    ->name('reports.show')
    ->where('id', '[0-9]+'); // Constraint: hanya angka

// Route group dengan middleware
Route::middleware('auth')->group(function () {
    Route::post('/reports', [ReportController::class, 'store']);
    Route::get('/reports/{id}/edit', [ReportController::class, 'edit']);
});

// Route admin dengan prefix dan middleware
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index']);
    });
```

**Penjelasan:**
- `->name()` - Memberikan nama route untuk referensi di view
- `->middleware()` - Menambahkan middleware (auth, role check)
- `->where()` - Constraint untuk parameter (regex)
- `->prefix()` - Menambahkan prefix URL (admin/dashboard)

**Masalah yang pernah terjadi:**
Route `/reports/create` sempat 404 karena tertukar posisi dengan `/reports/{id}`. Laravel membaca route dari atas ke bawah, jadi route spesifik harus di atas route dynamic.

### Q: Apa itu Middleware dan bagaimana penggunaannya?
**Jawaban:**
Middleware adalah filter yang dijalankan sebelum request mencapai controller, digunakan untuk authentication, authorization, logging, dll.

**Middleware dalam project:**

1. **`auth` middleware** (Laravel built-in)
   - Memastikan user sudah login
   - Redirect ke login jika belum auth

2. **`guest` middleware** (Laravel built-in)
   - Mencegah user yang sudah login akses halaman login/register

3. **`role:admin` middleware** (Custom)
   - File: `app/Http/Middleware/RoleMiddleware.php`
   - Memastikan user memiliki role admin
   - Return 403 Forbidden jika bukan admin

**Contoh implementasi RoleMiddleware:**

```php
public function handle(Request $request, Closure $next, string $role)
{
    if (!auth()->check()) {
        return redirect()->route('login');
    }

    if (auth()->user()->role !== $role) {
        abort(403, 'Unauthorized action.');
    }

    return $next($request);
}
```

**Penggunaan:**
```php
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Hanya admin yang bisa akses routes di sini
});
```

### Q: Bagaimana validasi input di Laravel?
**Jawaban:**
Laravel menyediakan validasi yang powerful dan mudah digunakan.

**Contoh dari ReportController::store():**

```php
$validated = $request->validate([
    'report_type' => 'required|in:Barang Hilang,Barang Temuan',
    'title' => 'required|string|max:255',
    'category' => 'required|string|max:100',
    'location' => 'required|string|max:255',
    'report_date' => 'required|date',
    'report_time' => 'nullable|date_format:H:i',
    'description' => 'required|string',
    'reporter_name' => 'required|string|max:150',
    'reporter_class' => 'required|string|max:100',
    'reporter_contact' => 'required|string|max:50',
    'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5120', // 5MB
]);
```

**Rule yang digunakan:**
- `required` - Field wajib diisi
- `string` - Harus string
- `max:255` - Maksimal 255 karakter
- `in:value1,value2` - Harus salah satu dari value
- `date` - Harus format tanggal valid
- `date_format:H:i` - Harus sesuai format (14:30)
- `nullable` - Boleh kosong
- `image` - Harus file gambar
- `mimes:jpeg,png,jpg` - Format file yang diizinkan
- `max:5120` - Maksimal 5MB (dalam KB)

**Keuntungan:**
- Otomatis return error message jika gagal
- Mencegah invalid data masuk database
- Mencegah SQL injection, XSS

---

## 3️⃣ UI/UX

### Q: Jelaskan desain UI/UX project ini!
**Jawaban:**

**Design System:**
- **Material Design 3** - Design language dari Google untuk konsistensi
- **Color Scheme** - Primary: Blue (#1976D2), Surface: White (#F5F5F5)
- **Typography** - Plus Jakarta Sans untuk keterbacaan optimal
- **Icons** - Material Symbols untuk konsistensi visual

**UI Principles:**
1. **Simplicity** - Interface yang clean dan tidak overwhelming
2. **Consistency** - Warna, spacing, typography konsisten di semua halaman
3. **Hierarchy** - Informasi penting lebih menonjol (heading, CTA button)
4. **Feedback** - Success/error messages setelah action
5. **Responsive** - Tampilan optimal di desktop, tablet, mobile

### Q: Apa saja halaman utama dan fungsinya?
**Jawaban:**

1. **Homepage (`/`)**
   - Hero section dengan judul dan deskripsi
   - CTA button "Laporkan Barang Sekarang"
   - Navigasi ke Daftar Barang

2. **Register Page (`/register`)**
   - Form registrasi user baru
   - Field: nama, email, password, kelas
   - Validasi client-side dan server-side

3. **Login Page (`/login`)**
   - Form login dengan email dan password
   - Remember me checkbox
   - Link ke register

4. **Catalog Page (`/catalog`)**
   - Grid display semua laporan
   - Card dengan foto, judul, status, lokasi
   - Click card untuk detail

5. **Report Detail (`/reports/{id}`)**
   - Informasi lengkap laporan
   - Foto barang (jika ada)
   - Kontak pelapor dengan WhatsApp button
   - Edit/Delete button (jika milik sendiri)

6. **Create Report (`/reports/create`)**
   - Form membuat laporan baru
   - Radio button: Barang Hilang / Barang Temuan
   - Upload foto
   - Semua field dengan validasi

7. **Admin Dashboard (`/admin/dashboard`)**
   - Statistik cards (total laporan, status)
   - Tabel semua laporan
   - Dropdown update status
   - Delete button untuk setiap laporan

### Q: Bagaimana membuat tampilan responsive?
**Jawaban:**
Menggunakan **Tailwind CSS** dengan utility classes responsive.

**Contoh:**

```html
<!-- Grid yang responsive -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <!-- Cards -->
</div>
```

**Penjelasan:**
- `grid-cols-1` - Mobile: 1 kolom
- `md:grid-cols-2` - Tablet (768px+): 2 kolom
- `lg:grid-cols-3` - Desktop (1024px+): 3 kolom

**Breakpoints Tailwind:**
- `sm:` - 640px
- `md:` - 768px
- `lg:` - 1024px
- `xl:` - 1280px
- `2xl:` - 1536px

**Contoh lain:**
```html
<!-- Padding responsive -->
<div class="p-4 md:p-6 lg:p-8">

<!-- Text size responsive -->
<h1 class="text-2xl md:text-3xl lg:text-4xl">

<!-- Hidden on mobile, show on desktop -->
<div class="hidden md:block">
```

### Q: Jelaskan interaksi JavaScript dalam form!
**Jawaban:**

**Problem:**
Radio button "Barang Hilang" dan "Barang Temuan" tidak interaktif saat diklik area label.

**Solution:**
Menambahkan JavaScript event handler untuk sinkronisasi state.

**Code (`resources/views/reports/create.blade.php`):**

```javascript
document.addEventListener('DOMContentLoaded', function() {
    // Get all radio buttons
    const radioButtons = document.querySelectorAll('input[name="report_type"]');
    const radioContainers = document.querySelectorAll('.radio-option');

    // Function to update visual state
    function updateRadioState() {
        radioContainers.forEach(container => {
            const radio = container.querySelector('input[type="radio"]');
            if (radio.checked) {
                container.classList.add('border-blue-600', 'bg-blue-50');
                container.classList.remove('border-gray-300', 'bg-white');
            } else {
                container.classList.remove('border-blue-600', 'bg-blue-50');
                container.classList.add('border-gray-300', 'bg-white');
            }
        });
    }

    // Add click event to containers
    radioContainers.forEach(container => {
        container.addEventListener('click', function() {
            const radio = this.querySelector('input[type="radio"]');
            radio.checked = true;
            updateRadioState();
        });
    });

    // Initialize state
    updateRadioState();
});
```

**Penjelasan:**
1. Event listener saat DOM loaded
2. Ambil semua radio button dan container
3. Function untuk update class CSS (visual feedback)
4. Event click pada container langsung check radio button
5. Initialize state awal

**Result:**
User bisa klik di mana saja di area card untuk select option.

### Q: Bagaimana UX untuk upload foto?
**Jawaban:**

**Features:**
1. **Preview sebelum upload** - User bisa lihat foto yang dipilih
2. **Validasi format** - Hanya JPG, PNG, JPEG
3. **Validasi ukuran** - Maksimal 5MB
4. **Optional** - Foto tidak wajib (nullable)
5. **Clear feedback** - Error message jika file tidak sesuai

**Validasi Server-Side:**
```php
'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5120'
```

**Validasi Client-Side (JavaScript):**
```javascript
const fileInput = document.getElementById('image');
fileInput.addEventListener('change', function(e) {
    const file = e.target.files[0];
    
    // Check file size
    if (file.size > 5 * 1024 * 1024) {
        alert('Ukuran file maksimal 5MB');
        this.value = '';
        return;
    }
    
    // Check file type
    if (!['image/jpeg', 'image/png', 'image/jpg'].includes(file.type)) {
        alert('Format file harus JPG, PNG, atau JPEG');
        this.value = '';
        return;
    }
    
    // Show preview
    const reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById('preview').src = e.target.result;
    };
    reader.readAsDataURL(file);
});
```

**Storage:**
- File disimpan di `storage/app/public/reports/`
- Path di database: `reports/filename.jpg`
- Access via symlink: `public/storage/reports/filename.jpg`

---

## 4️⃣ CARA KERJA WEB

### Q: Jelaskan arsitektur sistem BarangTemu!
**Jawaban:**

```
[Browser] ←→ [Laravel Server] ←→ [MySQL Database]
               ↓
          [File Storage]
```

**Flow:**
1. **Client (Browser)** - User akses via browser
2. **Web Server** - Laravel development server (port 8000)
3. **Application** - Laravel framework handle request
4. **Database** - MySQL menyimpan data users dan reports
5. **Storage** - File system menyimpan foto upload

### Q: Jelaskan request-response cycle!
**Jawaban:**

**Contoh: User membuat laporan baru**

1. **User Action:**
   - User klik "Laporkan Barang Sekarang"
   - Browser request: `GET /reports/create`

2. **Routing:**
   - Laravel router match request ke route
   - Route: `Route::get('/reports/create', [ReportController::class, 'create'])`

3. **Middleware:**
   - Check middleware `auth` - apakah user sudah login?
   - Jika belum, redirect ke `/login`
   - Jika sudah, lanjut ke controller

4. **Controller:**
   - `ReportController@create()` dijalankan
   - Return view `reports.create`

5. **View:**
   - Blade engine compile template
   - Generate HTML dengan data yang diperlukan

6. **Response:**
   - Server kirim HTML ke browser
   - Browser render halaman form

7. **User Submit Form:**
   - User isi form dan submit
   - Browser request: `POST /reports` dengan data form

8. **Validasi:**
   - Laravel validasi input
   - Jika gagal: return error ke form
   - Jika sukses: lanjut simpan

9. **Database:**
   - Eloquent ORM create record baru
   - SQL: `INSERT INTO reports ...`

10. **File Upload:**
    - Laravel handle file upload
    - Simpan di `storage/app/public/reports/`
    - Simpan path di database

11. **Redirect:**
    - Controller return redirect ke `/catalog`
    - Dengan flash message: "Laporan berhasil dikirim"

12. **Display:**
    - Browser request `/catalog`
    - Laravel query semua reports dari database
    - Render view catalog dengan data
    - User lihat laporan baru di katalog

### Q: Apa itu session dan bagaimana kegunaannya?
**Jawaban:**
Session menyimpan data user selama mereka menggunakan aplikasi, data hilang saat logout atau browser ditutup.

**Kegunaan dalam project:**

1. **Authentication State:**
   ```php
   // Saat login
   auth()->login($user);
   
   // Cek apakah user login
   if (auth()->check()) {
       // User sudah login
   }
   
   // Get user yang login
   $user = auth()->user();
   ```

2. **Flash Messages:**
   ```php
   // Controller
   return redirect()->route('catalog')
       ->with('success', 'Laporan berhasil dikirim!');
   
   // Blade template
   @if(session('success'))
       <div class="alert-success">
           {{ session('success') }}
       </div>
   @endif
   ```

3. **CSRF Protection:**
   - Laravel generate CSRF token per session
   - Token disimpan di session dan form
   - Server validate token saat submit

**Session Configuration:**
```env
SESSION_DRIVER=database  # Simpan session di database
SESSION_LIFETIME=120     # 120 menit (2 jam)
```

**Tabel sessions:**
- Laravel otomatis manage session di tabel `sessions`
- Berisi: id, user_id, ip_address, user_agent, payload, last_activity

### Q: Bagaimana sistem authentication bekerja?
**Jawaban:**

**Flow Register:**

1. User isi form register
2. Submit ke `POST /register`
3. Laravel validasi input
4. Hash password dengan bcrypt
5. Create user baru di database:
   ```php
   User::create([
       'name' => $request->name,
       'email' => $request->email,
       'password' => bcrypt($request->password),
       'role' => 'user',
       'class' => $request->class,
   ]);
   ```
6. Otomatis login user
7. Redirect ke homepage

**Flow Login:**

1. User isi email dan password
2. Submit ke `POST /login`
3. Laravel attempt authentication:
   ```php
   $credentials = $request->only('email', 'password');
   
   if (auth()->attempt($credentials)) {
       // Login success
       return redirect()->intended('/');
   } else {
       // Login failed
       return back()->withErrors(['email' => 'Invalid credentials']);
   }
   ```
4. Laravel ambil user dari database by email
5. Hash password input dan compare dengan password di DB
6. Jika match:
   - Create session
   - Set user_id di session
   - Generate remember_token (jika remember me)
7. Redirect ke intended page

**Flow Logout:**

1. User klik logout
2. Submit ke `POST /logout`
3. Laravel destroy session:
   ```php
   auth()->logout();
   request()->session()->invalidate();
   request()->session()->regenerateToken();
   ```
4. Redirect ke homepage

**Security:**
- Password di-hash dengan bcrypt (tidak plain text)
- CSRF protection di setiap form
- Session regenerate saat login (prevent session fixation)
- Middleware protect routes yang butuh auth

### Q: Bagaimana role-based access control bekerja?
**Jawaban:**

**Database:**
Tabel `users` punya kolom `role` (enum: 'admin', 'user')

**Middleware:**
Custom middleware `RoleMiddleware` check role user:

```php
public function handle(Request $request, Closure $next, string $role)
{
    // Check if user logged in
    if (!auth()->check()) {
        return redirect()->route('login');
    }

    // Check if user has required role
    if (auth()->user()->role !== $role) {
        abort(403, 'Unauthorized action.');
    }

    return $next($request);
}
```

**Routes:**
```php
// User routes - hanya butuh login
Route::middleware('auth')->group(function () {
    Route::post('/reports', [ReportController::class, 'store']);
});

// Admin routes - butuh login DAN role admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index']);
});
```

**Controller:**
Additional check di controller untuk edit/delete:

```php
public function edit($id)
{
    $report = Report::findOrFail($id);

    // Only allow user to edit their own report
    if ($report->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
        abort(403, 'Unauthorized action.');
    }

    return view('reports.edit', compact('report'));
}
```

**Model Helper:**
```php
// User.php
public function isAdmin()
{
    return $this->role === 'admin';
}
```

**Blade Template:**
```php
@if(auth()->check() && auth()->user()->isAdmin())
    <a href="{{ route('admin.dashboard') }}">Dashboard Admin</a>
@endif
```

**Access Matrix:**

| Fitur | User | Admin |
|-------|------|-------|
| Create Report | ✅ | ✅ |
| View All Reports | ✅ | ✅ |
| Edit Own Report | ✅ | ✅ |
| Delete Own Report | ✅ | ✅ |
| Edit Any Report | ❌ | ✅ |
| Delete Any Report | ❌ | ✅ |
| Access Dashboard | ❌ | ✅ |
| Update Status | ❌ | ✅ |

### Q: Bagaimana file upload dihandle?
**Jawaban:**

**HTML Form:**
```html
<form method="POST" action="/reports" enctype="multipart/form-data">
    @csrf
    <input type="file" name="image" accept="image/*">
    <button type="submit">Upload</button>
</form>
```

**Catatan:** `enctype="multipart/form-data"` wajib untuk upload file!

**Controller:**
```php
public function store(Request $request)
{
    // Validate file
    $request->validate([
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5120'
    ]);

    // Handle upload
    $imagePath = null;
    if ($request->hasFile('image')) {
        // Store file and get path
        $imagePath = $request->file('image')->store('reports', 'public');
        // Result: reports/randomhash.jpg
    }

    // Save to database
    Report::create([
        // ... other fields
        'image_path' => $imagePath,
    ]);
}
```

**Storage:**
- File disimpan di: `storage/app/public/reports/`
- Laravel generate nama file random (prevent conflict)
- Path di DB: `reports/abc123.jpg`

**Symlink:**
Untuk akses file dari public folder:
```bash
php artisan storage:link
```

Ini create symlink:
```
public/storage → storage/app/public
```

**Display Image:**
```html
@if($report->image_path)
    <img src="{{ asset('storage/' . $report->image_path) }}" alt="Foto Barang">
@endif
```

**URL Result:** `http://127.0.0.1:8000/storage/reports/abc123.jpg`

**Delete File:**
```php
public function destroy($id)
{
    $report = Report::findOrFail($id);

    // Delete image file if exists
    if ($report->image_path) {
        Storage::disk('public')->delete($report->image_path);
    }

    // Delete database record
    $report->delete();
}
```

---

## 5️⃣ TESTING

### Q: Bagaimana cara testing aplikasi ini?
**Jawaban:**

### Manual Testing Checklist

**1. Authentication Testing:**

✅ **Register:**
- [ ] Form validasi: email format, password min 8 karakter
- [ ] Email harus unique (tidak boleh duplikat)
- [ ] Password otomatis di-hash (tidak plain text di DB)
- [ ] Default role = 'user'
- [ ] Redirect ke homepage setelah register
- [ ] Otomatis login setelah register

✅ **Login:**
- [ ] Login dengan email dan password yang benar
- [ ] Error message jika credentials salah
- [ ] Remember me berfungsi
- [ ] Redirect ke intended page

✅ **Logout:**
- [ ] Logout berhasil
- [ ] Session destroyed
- [ ] Redirect ke homepage
- [ ] Tidak bisa akses protected page

**2. Report CRUD Testing:**

✅ **Create:**
- [ ] Form validasi semua required fields
- [ ] Radio button Barang Hilang/Temuan berfungsi
- [ ] Date picker berfungsi
- [ ] Time input berfungsi (optional)
- [ ] Upload foto JPG/PNG berhasil (max 5MB)
- [ ] Error jika upload file > 5MB
- [ ] Error jika upload bukan gambar
- [ ] Data tersimpan di database
- [ ] Foto tersimpan di storage
- [ ] Redirect ke catalog dengan success message

✅ **Read:**
- [ ] Katalog tampil semua laporan
- [ ] Card tampil foto, judul, kategori, status
- [ ] Click card buka detail
- [ ] Detail tampil semua informasi lengkap
- [ ] Kontak WhatsApp button berfungsi
- [ ] Status badge tampil dengan warna yang tepat

✅ **Update:**
- [ ] User bisa edit laporan sendiri
- [ ] User tidak bisa edit laporan user lain (403)
- [ ] Admin bisa edit laporan siapapun
- [ ] Form pre-filled dengan data existing
- [ ] Upload foto baru replace foto lama
- [ ] Foto lama terhapus dari storage
- [ ] Data terupdate di database
- [ ] Redirect dengan success message

✅ **Delete:**
- [ ] User bisa delete laporan sendiri
- [ ] User tidak bisa delete laporan user lain (403)
- [ ] Admin bisa delete laporan siapapun
- [ ] Konfirmasi sebelum delete
- [ ] Data terhapus dari database
- [ ] Foto terhapus dari storage
- [ ] Redirect ke catalog (BUKAN 404!)

**3. Admin Dashboard Testing:**

✅ **Access Control:**
- [ ] User biasa tidak bisa akses dashboard (403)
- [ ] Admin bisa akses dashboard
- [ ] Menu "Dashboard Admin" hanya tampil untuk admin

✅ **Statistics:**
- [ ] Total laporan benar
- [ ] Jumlah "Belum Ditemukan" benar
- [ ] Jumlah "Sudah Ditemukan" benar
- [ ] Jumlah "Sudah Dikembalikan" benar

✅ **Status Management:**
- [ ] Dropdown status tampil di setiap laporan
- [ ] Update status berhasil tanpa reload page
- [ ] Status terupdate di database
- [ ] Visual feedback saat update

✅ **Delete:**
- [ ] Admin bisa delete laporan apapun
- [ ] Data dan foto terhapus

**4. File Upload Testing:**

✅ **Valid Uploads:**
- [ ] JPG file upload berhasil
- [ ] PNG file upload berhasil
- [ ] JPEG file upload berhasil
- [ ] File 4.9MB upload berhasil

✅ **Invalid Uploads:**
- [ ] File > 5MB ditolak
- [ ] PDF file ditolak
- [ ] TXT file ditolak
- [ ] Video file ditolak
- [ ] Error message jelas

✅ **Storage:**
- [ ] File tersimpan di `storage/app/public/reports/`
- [ ] Nama file random (tidak original name)
- [ ] Path tersimpan di database
- [ ] File accessible via public URL

**5. Responsive Testing:**

✅ **Desktop (1920x1080):**
- [ ] Layout proper
- [ ] Navigation horizontal
- [ ] Grid 3 columns
- [ ] All elements visible

✅ **Tablet (768x1024):**
- [ ] Layout adjusted
- [ ] Navigation collapsed (burger menu)
- [ ] Grid 2 columns
- [ ] Touch-friendly buttons

✅ **Mobile (375x667):**
- [ ] Layout mobile-optimized
- [ ] Navigation burger menu
- [ ] Grid 1 column
- [ ] Text readable without zoom
- [ ] Buttons large enough for touch

**6. Security Testing:**

✅ **Authentication:**
- [ ] Cannot access protected routes without login
- [ ] Session timeout berfungsi
- [ ] CSRF token validated

✅ **Authorization:**
- [ ] User tidak bisa edit/delete laporan orang lain
- [ ] User tidak bisa akses admin dashboard
- [ ] Direct URL access blocked (not just hidden menu)

✅ **Input Validation:**
- [ ] SQL injection prevented (Eloquent ORM)
- [ ] XSS prevented (Blade escaping)
- [ ] File upload validation
- [ ] CSRF protection

**7. Database Testing:**

✅ **Relations:**
- [ ] User hasMany Reports
- [ ] Report belongsTo User
- [ ] Cascade delete: delete user delete all reports

✅ **Constraints:**
- [ ] Email unique
- [ ] Foreign key constraint
- [ ] Enum values validated

### Browser Testing

Test di berbagai browser:
- [ ] Chrome/Edge (Chromium)
- [ ] Firefox
- [ ] Safari (jika Mac)

### Network Testing

- [ ] Test dengan internet lambat
- [ ] Test file upload dengan koneksi lambat
- [ ] Loading indicators berfungsi

### Q: Apa saja bug yang pernah ditemukan dan bagaimana solusinya?
**Jawaban:**

**Bug #1: 404 Not Found saat akses `/reports/create`**

**Penyebab:**
Route order salah. Laravel membaca route dari atas ke bawah. Route `/reports/{id}` di atas `/reports/create`, jadi "create" dianggap sebagai {id}.

**Solusi:**
```php
// ❌ SALAH - create ketangkap sebagai {id}
Route::get('/reports/{id}', [HomeController::class, 'show']);
Route::get('/reports/create', [ReportController::class, 'create']);

// ✅ BENAR - specific route di atas dynamic route
Route::get('/reports/create', [ReportController::class, 'create']);
Route::get('/reports/{id}', [HomeController::class, 'show'])->where('id', '[0-9]+');
```

Tambahan constraint `->where('id', '[0-9]+')` memastikan {id} hanya match angka.

---

**Bug #2: Radio Button tidak interaktif**

**Penyebab:**
Blade conditional static, tidak update saat user klik.

**Solusi:**
Tambah JavaScript event handler untuk update visual state:

```javascript
radioContainers.forEach(container => {
    container.addEventListener('click', function() {
        const radio = this.querySelector('input[type="radio"]');
        radio.checked = true;
        updateRadioState(); // Update border dan background color
    });
});
```

---

**Bug #3: 404 setelah delete laporan (tapi data terhapus)**

**Penyebab:**
Controller menggunakan `return back()` yang redirect ke halaman detail laporan. Karena laporan sudah dihapus, halaman detail tidak ada (404).

**Solusi:**
```php
// ❌ SALAH - back to deleted page
public function destroy($id) {
    $report->delete();
    return back()->with('success', 'Laporan dihapus');
}

// ✅ BENAR - redirect to catalog
public function destroy($id) {
    $report->delete();
    return redirect()->route('catalog')->with('success', 'Laporan dihapus');
}
```

---

**Bug #4: Seeder error (UserSeeder dan ReportSeeder)**

**Penyebab:**
Seeder menggunakan dummy user yang tidak ada di database.

**Solusi:**
Disable semua seeder di `DatabaseSeeder.php`:

```php
public function run(): void
{
    // ❌ Disabled - using manual registration
    // $this->call([
    //     UserSeeder::class,
    //     ReportSeeder::class,
    // ]);
}
```

User register manual via form, admin promote role via phpMyAdmin.

---

**Bug #5: Upload foto error "file not uploaded"**

**Penyebab:**
Storage symlink belum dibuat.

**Solusi:**
```bash
php artisan storage:link
```

Ini membuat symlink dari `public/storage` ke `storage/app/public`.

---

## 6️⃣ DOKUMENTASI

### Q: Apa saja dokumentasi yang dibuat untuk project ini?
**Jawaban:**

**1. README.md** - Dokumentasi utama berisi:
- Deskripsi project
- Fitur-fitur
- Tech stack
- Instalasi step-by-step
- Konfigurasi
- Struktur database
- Struktur folder
- Panduan penggunaan
- Role & permissions
- Testing checklist
- Troubleshooting
- Pengembangan selanjutnya
- Informasi pengembang

**2. .env.example** - Template konfigurasi:
- Database connection
- APP_KEY placeholder
- Session driver
- Tidak berisi data sensitif
- Aman untuk dibagikan di GitHub

**3. Code Comments** - Inline documentation:
```php
/**
 * Show the form for creating a new report
 */
public function create()
{
    return view('reports.create');
}
```

**4. Migration Files** - Database schema documentation:
- Struktur tabel
- Relasi foreign key
- Constraints dan indexes

**5. Git Commits** - Version control history:
- Commit messages yang descriptive
- Track perubahan code
- Rollback capability

### Q: Bagaimana cara setup project dari dokumentasi?
**Jawaban:**

Berdasarkan README.md, langkah setup:

1. **Clone repository**
   ```bash
   git clone https://github.com/username/barangtemu.git
   cd barangtemu
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Setup environment**
   ```bash
   copy .env.example .env
   php artisan key:generate
   ```

4. **Create database**
   - Buka phpMyAdmin
   - Create database `barangtemu`

5. **Configure .env**
   - Set DB_DATABASE, DB_USERNAME, DB_PASSWORD

6. **Run migration**
   ```bash
   php artisan migrate
   ```

7. **Create storage symlink**
   ```bash
   php artisan storage:link
   ```

8. **Start server**
   ```bash
   php artisan serve
   ```

9. **Register account**
   - Akses http://127.0.0.1:8000
   - Klik Register

10. **Promote to admin (optional)**
    - Via phpMyAdmin atau SQL query

Total waktu setup: **~10-15 menit** (dengan dokumentasi yang jelas)

### Q: Kenapa menggunakan Git dan GitHub?
**Jawaban:**

**Git Benefits:**
1. **Version Control** - Track semua perubahan code
2. **Backup** - Code aman di cloud
3. **Collaboration** - Multiple developers bisa kerja sama
4. **Branching** - Develop fitur tanpa ganggu main code
5. **Rollback** - Kembalikan ke versi sebelumnya jika ada bug
6. **History** - Lihat siapa ubah apa dan kapan

**GitHub Benefits:**
1. **Remote Repository** - Backup di cloud
2. **Portfolio** - Showcase project ke perusahaan
3. **Documentation** - README.md render otomatis
4. **Issues** - Track bugs dan feature requests
5. **Pull Requests** - Code review sebelum merge
6. **GitHub Pages** - Deploy static site gratis

**Git Commands yang digunakan:**
```bash
# Initialize git
git init

# Check status
git status

# Stage files
git add .

# Commit dengan message
git commit -m "Initial commit: BarangTemu - Lost & Found System"

# Add remote
git remote add origin https://github.com/username/barangtemu.git

# Push to GitHub
git push -u origin main
```

**Best Practices:**
- Commit messages yang descriptive
- Commit frequently dengan changes yang kecil
- Jangan commit file sensitif (.env, passwords)
- Gunakan .gitignore untuk exclude files

**File yang di-ignore (.gitignore):**
```
.env              # Data sensitif
/vendor           # PHP dependencies
/node_modules     # Node dependencies
/public/storage   # Symlink
/storage/*.key    # Keys
*.log             # Log files
```

---

## 7️⃣ AI (ARTIFICIAL INTELLIGENCE)

### Q: Bagaimana AI (Kiro) membantu dalam development project ini?
**Jawaban:**

**1. Code Generation:**
- Generate boilerplate code (controllers, models, views)
- Generate migration files
- Generate form validation rules
- Generate Blade templates dengan Material Design 3

**2. Debugging:**
- Identifikasi penyebab 404 error (route order issue)
- Fix radio button interactivity issue
- Fix delete redirect 404 issue
- Analyze seeder errors

**3. Problem Solving:**
- Suggest solusi untuk bug yang ditemukan
- Provide alternative approaches
- Explain root cause masalah

**4. Documentation:**
- Generate README.md yang comprehensive
- Write code comments
- Create troubleshooting guides
- Explain complex concepts

**5. Best Practices:**
- Suggest security improvements (CSRF, password hashing)
- Recommend proper file structure
- Enforce coding standards
- Optimize database queries

**6. Learning:**
- Explain Laravel concepts (Eloquent, routing, middleware)
- Explain MVC pattern
- Explain authentication flow
- Answer technical questions

### Q: Apa peran AI dalam modern web development?
**Jawaban:**

**AI as Assistant (bukan replacement):**

**What AI CAN do:**
✅ Generate boilerplate code
✅ Suggest code improvements
✅ Explain complex concepts
✅ Debug common errors
✅ Write documentation
✅ Generate test cases
✅ Optimize performance
✅ Suggest best practices

**What AI CANNOT do (yet):**
❌ Understand full business context
❌ Make architecture decisions
❌ Replace human creativity
❌ Understand user needs
❌ Test with real users
❌ Deploy to production
❌ Handle edge cases completely

**Developer's Role:**
- Define requirements
- Make design decisions
- Review AI-generated code
- Test thoroughly
- Understand the code (not just copy-paste)
- Fix edge cases
- Deploy and maintain

**Best Practices with AI:**
1. **Review code** - Jangan langsung copy-paste tanpa review
2. **Understand** - Pastikan paham bagaimana code bekerja
3. **Test** - AI code tetap harus ditest
4. **Adapt** - Sesuaikan dengan project context
5. **Learn** - Gunakan AI untuk belajar, bukan shortcut

### Q: Contoh spesifik AI membantu solve problem di project ini?
**Jawaban:**

**Case Study: 404 Error pada /reports/create**

**Problem:**
User tidak bisa akses form create report, selalu 404 Not Found.

**AI Debugging Process:**

1. **Analysis:**
   ```
   AI: "Let me check the routes..."
   - Route exists ✓
   - Controller exists ✓
   - View exists ✓
   - Middleware cleared ✓
   ```

2. **Hypothesis:**
   ```
   AI: "Route order might be the issue. Let me check route list..."
   ```

3. **Root Cause Identification:**
   ```
   AI: "Found it! Route /reports/{id} is catching /reports/create"
   ```

4. **Solution:**
   ```php
   // AI Suggestion:
   // Move specific route ABOVE dynamic route
   Route::get('/reports/create', [ReportController::class, 'create']);
   Route::get('/reports/{id}', [HomeController::class, 'show'])
       ->where('id', '[0-9]+'); // Add constraint
   ```

5. **Explanation:**
   ```
   AI: "Laravel reads routes top-to-bottom. Since '{id}' matches
        any string including 'create', it was catching your route.
        Adding ->where('id', '[0-9]+') ensures {id} only matches
        numbers."
   ```

6. **Testing:**
   ```bash
   AI: "Test with: php artisan route:clear then access /reports/create"
   ```

**Result:** Bug fixed! User bisa akses form create report.

**Learning:**
- Route order matters dalam Laravel
- Dynamic routes harus diberi constraint
- Specific routes harus di atas dynamic routes

---

## 📌 TIPS SAAT MENJAWAB PENGUJI

### 1. Jujur
- Jangan berpura-pura tahu jika tidak tahu
- Say: "Saya belum pernah explore bagian itu secara mendalam, tapi saya tahu konsep dasarnya..."

### 2. Tunjukkan Code
- Buka project dan tunjukkan langsung
- Demonstrasikan fitur yang ditanyakan
- Show, don't just tell

### 3. Explain Flow
- Jelaskan dari user action sampai database
- Gunakan diagram jika perlu
- Step-by-step explanation

### 4. Mention Challenges
- Ceritakan bug yang pernah ditemukan
- Explain bagaimana solve masalahnya
- Show learning process

### 5. Connect to Theory
- Hubungkan implementasi dengan teori yang dipelajari
- Mention OOP concepts, design patterns
- Explain why certain decisions were made

### 6. Show Testing
- Demonstrasikan fitur bekerja
- Show edge cases handling
- Explain validation

### 7. Discuss Future Improvements
- Mention fitur yang bisa ditambahkan
- Discuss scalability
- Show understanding of limitations

---

## 🎯 PERTANYAAN YANG MUNGKIN DITANYA

### Technical Deep Dive:
- "Jelaskan alur dari user submit form sampai data tersimpan di database"
- "Bagaimana Laravel mencegah SQL injection?"
- "Apa bedanya middleware dan controller?"
- "Kenapa pakai Laravel bukan PHP native?"

### Implementation Details:
- "Show me bagaimana upload foto dihandle"
- "Explain bagaimana role-based access control bekerja"
- "Demo create laporan dan show di database"
- "Bagaimana memastikan user tidak bisa delete laporan orang lain?"

### Problem Solving:
- "Bug apa yang paling challenging dan bagaimana solusinya?"
- "Kalau ada bug di production, langkah pertama apa yang kamu lakukan?"
- "How do you ensure code quality?"

### Design & UX:
- "Kenapa pakai Material Design 3?"
- "Bagaimana memastikan responsive di semua device?"
- "Explain user flow dari buka website sampai submit laporan"

### Future Development:
- "Kalau mau add email notification, bagaimana caranya?"
- "How to make this scalable untuk ribuan users?"
- "Apa security concerns yang harus diperhatikan?"

---

## ✅ CHECKLIST SEBELUM PRESENTASI

- [ ] Project berjalan tanpa error
- [ ] Database terisi sample data (bukan dummy seeder)
- [ ] Semua fitur berfungsi:
  - [ ] Register & Login
  - [ ] Create Report
  - [ ] Upload Foto
  - [ ] Edit & Delete (own report)
  - [ ] Admin Dashboard
  - [ ] Update Status
- [ ] README.md up-to-date
- [ ] Code di-push ke GitHub
- [ ] .env tidak ter-commit
- [ ] XAMPP MySQL running
- [ ] Laravel server running (php artisan serve)
- [ ] Browser siap untuk demo
- [ ] Backup database (jaga-jaga)

---

**SEMOGA SUKSES USK! 🎓🚀**

---

**Dibuat dengan ❤️ untuk Alvaro Geraldy - XII RPL**  
**SMK Negeri 20 Jakarta**
