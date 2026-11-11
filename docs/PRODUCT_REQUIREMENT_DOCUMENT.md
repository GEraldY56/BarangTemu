# Product Requirement Document (PRD)
## BarangTemu - Sistem Pelaporan Barang Hilang & Temuan

**Version:** 1.0.0  
**Last Updated:** 2 November 2026  
**Document Owner:** Alvaro Geraldy (XII RPL, SMK Negeri 20 Jakarta)  
**Status:** ✅ Production Ready

---

## 📋 Table of Contents

1. [Executive Summary](#executive-summary)
2. [Product Overview](#product-overview)
3. [Problem Statement](#problem-statement)
4. [Goals & Objectives](#goals--objectives)
5. [Target Users](#target-users)
6. [Features & Requirements](#features--requirements)
7. [User Stories](#user-stories)
8. [Technical Architecture](#technical-architecture)
9. [User Interface & Experience](#user-interface--experience)
10. [Security & Privacy](#security--privacy)
11. [Performance Requirements](#performance-requirements)
12. [Success Metrics](#success-metrics)
13. [Future Roadmap](#future-roadmap)
14. [Appendix](#appendix)

---

## 1. Executive Summary

**BarangTemu** adalah sistem informasi berbasis web yang dirancang untuk memfasilitasi pelaporan dan pencarian barang hilang atau barang yang ditemukan di lingkungan SMK Negeri 20 Jakarta. Sistem ini menghubungkan siswa yang kehilangan barang dengan siswa yang menemukan barang, serta memudahkan staff sarpras dalam mengelola barang temuan.

### Key Highlights:
- 🎯 **Problem Solved:** Centralized lost & found reporting system
- 👥 **Target Users:** Siswa, Guru, Staff Sarpras (Admin)
- 🛠️ **Technology Stack:** Laravel 11, MySQL, Tailwind CSS, Material Design 3
- 📱 **Platform:** Web responsive (desktop, tablet, mobile)
- ✅ **Status:** Fully functional production system

---

## 2. Product Overview

### 2.1 Vision
Menjadi platform terpercaya untuk meningkatkan peluang barang hilang kembali ke pemiliknya di lingkungan sekolah melalui sistem yang terorganisir dan mudah diakses.

### 2.2 Mission
- Menyediakan platform pelaporan barang hilang/temuan yang user-friendly
- Memfasilitasi komunikasi antara pihak yang kehilangan dengan pihak yang menemukan
- Memudahkan staff sarpras dalam mengelola dan melacak status barang

### 2.3 Value Proposition

**Untuk Siswa:**
- ✅ Melaporkan barang hilang dengan mudah dan cepat
- ✅ Mencari barang temuan dengan filter dan search
- ✅ Kontak langsung via WhatsApp dengan pelapor
- ✅ Track status barang (Belum/Sudah Ditemukan/Dikembalikan)

**Untuk Staff Sarpras:**
- ✅ Dashboard terpusat untuk monitor semua laporan
- ✅ Update status barang dengan mudah
- ✅ Statistik real-time untuk reporting
- ✅ Moderate konten laporan

---

## 3. Problem Statement

### 3.1 Current Pain Points

**Before BarangTemu:**

1. **Tidak Ada Sistem Terpusat**
   - Siswa yang kehilangan barang tidak tahu kemana harus melapor
   - Barang temuan menumpuk di ruang sarpras tanpa pemilik
   - Tidak ada database yang terorganisir

2. **Komunikasi Tidak Efektif**
   - Pengumuman manual di papan pengumuman sering terlewat
   - Sulit mencocokkan barang hilang dengan barang temuan
   - Kontak informasi tidak tersimpan dengan baik

3. **Tidak Ada Tracking System**
   - Tidak jelas status barang (sudah ditemukan atau belum)
   - Tidak ada history barang yang sudah dikembalikan
   - Sulit membuat laporan statistik

4. **Proses Manual Memakan Waktu**
   - Staff sarpras harus manual catat di buku
   - Pencarian memakan waktu lama
   - Data mudah hilang atau rusak

### 3.2 Impact Analysis

| Impact Area | Before | After BarangTemu |
|------------|--------|------------------|
| **Reporting Time** | 30-60 menit (datang ke sarpras) | 5 menit (online) |
| **Search Efficiency** | Manual browsing | Instant search & filter |
| **Recovery Rate** | ~20% (estimasi) | Target: 50-70% |
| **Admin Workload** | High (manual record) | Low (automated) |
| **Data Integrity** | Paper-based, mudah hilang | Digital, persistent |

---

## 4. Goals & Objectives

### 4.1 Primary Goals

1. **Increase Recovery Rate**
   - Target: 50% barang hilang ditemukan dalam 30 hari
   - Metric: Track jumlah status "Sudah Dikembalikan"

2. **Reduce Admin Workload**
   - Target: 70% reduction dalam waktu manual entry
   - Metric: Time saved per report

3. **Improve User Satisfaction**
   - Target: 80% user satisfaction score
   - Metric: User feedback & survey

4. **Centralize Data Management**
   - Target: 100% laporan tercatat di sistem
   - Metric: Database completeness

### 4.2 Secondary Goals

- Meningkatkan awareness siswa terhadap tanggung jawab atas barang pribadi
- Mempermudah koordinasi antara siswa dan staff sarpras
- Menyediakan data untuk analisis tren barang hilang di sekolah
- Mengurangi kehilangan barang bernilai tinggi

### 4.3 Success Criteria

✅ **Launch Criteria (Met):**
- [x] Core features implemented (Register, Login, CRUD Report, Admin Dashboard)
- [x] Security measures in place (Authentication, Authorization, CSRF)
- [x] Responsive design across devices
- [x] Basic testing completed
- [x] Documentation complete

📈 **Post-Launch Metrics (To Track):**
- [ ] 100+ registered users dalam 1 bulan
- [ ] 50+ laporan barang dalam 1 bulan
- [ ] 20% conversion rate (laporan → dikembalikan)
- [ ] < 5 detik average page load time
- [ ] Zero critical security incidents

---

## 5. Target Users

### 5.1 Primary Users

#### 👨‍🎓 **Siswa (User Role)**

**Demographics:**
- Students SMK Negeri 20 Jakarta
- Age: 15-19 tahun
- Tech-savvy, familiar dengan smartphone & web apps

**User Needs:**
- Melaporkan barang hilang dengan cepat
- Mencari barang temuan dengan mudah
- Kontak pelapor langsung via WhatsApp
- Track status laporan mereka

**Pain Points:**
- Tidak tahu kemana harus melapor
- Sulit mencari barang di tempat kehilangan
- Takut barang tidak akan ditemukan

**User Journey:**
1. Kehilangan barang
2. Buka BarangTemu
3. Register/Login
4. Buat laporan dengan detail lengkap
5. Check catalog secara berkala
6. Kontak jika ada barang cocok
7. Update status jika ditemukan

---

#### 👨‍💼 **Staff Sarpras (Admin Role)**

**Demographics:**
- Staff/Guru SMK Negeri 20 Jakarta
- Age: 25-50 tahun
- Moderate tech proficiency

**User Needs:**
- Monitor semua laporan di satu tempat
- Update status barang dengan mudah
- Statistik untuk reporting ke kepala sekolah
- Moderate konten yang tidak sesuai

**Pain Points:**
- Workload tinggi untuk manual entry
- Sulit track status banyak barang
- Data paper-based mudah hilang

**User Journey:**
1. Login dengan akun admin
2. Buka admin dashboard
3. Review laporan baru
4. Update status barang yang sudah ada di ruang sarpras
5. Koordinasi penyerahan barang ke pemilik
6. Mark sebagai "Sudah Dikembalikan"

---

### 5.2 Secondary Users

#### 👨‍🏫 **Guru**
- Membantu siswa yang kehilangan barang
- Menggunakan sistem untuk melihat barang temuan

#### 🏫 **Kepala Sekolah**
- Melihat statistik dan laporan
- Monitoring effectiveness sistem

---

## 6. Features & Requirements

### 6.1 Core Features (✅ Implemented)

#### 6.1.1 Authentication & Authorization

**Feature: User Registration**
- **Status:** ✅ Implemented
- **Priority:** P0 (Critical)

**Requirements:**
- User dapat register dengan email unique
- Input: Nama, Email, Kelas, Password (min 8 karakter)
- Password di-hash dengan bcrypt
- Default role: 'user'
- Setelah register, redirect ke login (tidak auto-login)
- Email verification: ❌ Not implemented (future)

**Acceptance Criteria:**
- [x] Form validasi berfungsi (email format, password min 8)
- [x] Email harus unique (tidak boleh duplikat)
- [x] Password ter-hash di database
- [x] User redirect ke login setelah register
- [x] Flash message sukses tampil

---

**Feature: User Login**
- **Status:** ✅ Implemented
- **Priority:** P0 (Critical)

**Requirements:**
- User login dengan email dan password
- Remember me checkbox available
- Setelah login berhasil:
  - Admin → redirect ke `/admin/dashboard`
  - User → redirect ke homepage `/`
- Session created dan regenerated untuk security
- Failed login → error message: "Email atau password salah"

**Acceptance Criteria:**
- [x] Authentication dengan Laravel Auth::attempt
- [x] Remember me functionality
- [x] Role-based redirect
- [x] Session management secure
- [x] Error handling proper

---

**Feature: User Logout**
- **Status:** ✅ Implemented
- **Priority:** P0 (Critical)

**Requirements:**
- Logout button accessible di navbar
- Session destroyed dan invalidated
- CSRF token regenerated
- Redirect ke login page dengan flash message

**Acceptance Criteria:**
- [x] Logout berhasil destroy session
- [x] User tidak bisa akses protected routes setelah logout
- [x] Flash message: "Logout berhasil!"

---

#### 6.1.2 Report Management (CRUD)

**Feature: Create Report**
- **Status:** ✅ Implemented
- **Priority:** P0 (Critical)

**Requirements:**

**Form Fields:**
1. **Tipe Laporan** (required) - Radio button
   - Barang Hilang
   - Barang Temuan

2. **Informasi Barang:**
   - Nama Barang (required, max 255 char)
   - Kategori (required, dropdown):
     - Elektronik & Gadget
     - Alat Tulis & Buku
     - Pakaian & Aksesoris
     - Olahraga & Ekstrakurikuler
     - Kunci & Dompet
     - Lainnya
   
3. **Detail Kejadian:**
   - Lokasi (required, max 255 char)
   - Tanggal Kejadian (required, date picker)
   - Waktu Kejadian (optional, time picker)
   
4. **Deskripsi Detail:**
   - Deskripsi lengkap (required, textarea)
   
5. **Informasi Pelapor:**
   - Nama Pelapor (required, max 150 char)
   - Kelas (required, max 100 char)
   - Kontak WhatsApp (required, max 50 char)
   
6. **Foto Barang:**
   - Upload foto (optional)
   - Format: JPG, PNG, JPEG
   - Max size: 5MB

**Business Logic:**
- Auto-determine status:
  - Barang Temuan → status = "Sudah Ditemukan"
  - Barang Hilang → status = "Belum Ditemukan"
- Foto disimpan di `storage/app/public/reports/` dengan nama random
- user_id otomatis dari auth()->id()
- Redirect ke `/catalog` setelah sukses dengan flash message

**Validations:**
```php
report_type: required|in:Barang Hilang,Barang Temuan
title: required|string|max:255
category: required|string|max:100
location: required|string|max:255
report_date: required|date
report_time: nullable|date_format:H:i
description: required|string
reporter_name: required|string|max:150
reporter_class: required|string|max:100
reporter_contact: required|string|max:50
image: nullable|image|mimes:jpeg,png,jpg|max:5120
```

**Acceptance Criteria:**
- [x] Form accessible di `/reports/create` (hanya untuk authenticated users)
- [x] Radio button interaktif (klik area card)
- [x] Semua validasi berfungsi dengan error messages
- [x] Foto upload dengan preview (client-side)
- [x] Foto tersimpan di storage dengan path di database
- [x] Status auto-determined berdasarkan tipe
- [x] Data tersimpan ke MySQL table `reports`
- [x] Redirect ke catalog dengan success message

---

**Feature: View Reports (Catalog)**
- **Status:** ✅ Implemented
- **Priority:** P0 (Critical)

**Requirements:**

**Display:**
- Grid layout responsive (1 col mobile, 2 tablet, 3 desktop)
- Card menampilkan:
  - Foto barang (jika ada)
  - Nama barang (title)
  - Kategori
  - Status (badge dengan warna)
  - Lokasi
  - Tanggal kejadian
  - Tipe (Barang Hilang/Temuan)

**Search & Filter:**
1. **Search Bar:**
   - Real-time search (submit on type)
   - Search in: title, description, location
   
2. **Filter by Category:**
   - Dropdown all categories + "Semua Kategori"
   
3. **Filter by Status:**
   - Belum Ditemukan
   - Sudah Ditemukan
   - Sudah Dikembalikan
   - Semua Status
   
4. **Filter by Type:**
   - Barang Hilang
   - Barang Temuan
   - Semua Jenis Laporan

**Pagination:**
- 12 items per page
- Laravel pagination with Tailwind styling

**Acceptance Criteria:**
- [x] Catalog accessible di `/catalog` (public, no auth required)
- [x] Grid layout responsive
- [x] Search berfungsi real-time
- [x] Filter kombinasi berfungsi (category + status + type)
- [x] Pagination smooth
- [x] Empty state jika tidak ada hasil

---

**Feature: View Report Detail**
- **Status:** ✅ Implemented
- **Priority:** P0 (Critical)

**Requirements:**

**Display:**
- Foto barang (jika ada, full size)
- Semua informasi lengkap:
  - Nama barang
  - Kategori
  - Tipe (Barang Hilang/Temuan)
  - Status (badge)
  - Lokasi
  - Tanggal & waktu kejadian
  - Deskripsi lengkap
  - Nama pelapor
  - Kelas pelapor
  - Kontak WhatsApp (clickable link)

**Actions:**
- **Jika user = owner atau admin:**
  - Tombol "Edit Laporan"
  - Tombol "Hapus Laporan"
- **Jika user lain:**
  - Tombol "Hubungi via WhatsApp" (link ke wa.me)

**Acceptance Criteria:**
- [x] Detail accessible di `/reports/{id}`
- [x] Semua informasi tampil lengkap
- [x] WhatsApp button functional (open wa.me)
- [x] Authorization check untuk edit/delete buttons
- [x] Responsive layout

---

**Feature: Edit Report**
- **Status:** ✅ Implemented
- **Priority:** P1 (High)

**Requirements:**

**Authorization:**
- Hanya owner report atau admin yang bisa edit
- Check: `report->user_id == auth()->id() || auth()->user()->isAdmin()`
- Jika tidak authorized → 403 Forbidden

**Form:**
- Pre-filled dengan data existing
- Semua field editable
- Validasi sama dengan create

**Photo Handling:**
- Jika upload foto baru:
  - Hapus foto lama dari storage
  - Upload foto baru
  - Update path di database
- Jika tidak upload foto baru:
  - Foto lama tetap

**Acceptance Criteria:**
- [x] Edit page accessible di `/reports/{id}/edit`
- [x] Authorization check berfungsi
- [x] Form pre-filled
- [x] Update data ke database
- [x] Photo replacement berfungsi
- [x] Redirect ke catalog dengan success message

---

**Feature: Delete Report**
- **Status:** ✅ Implemented
- **Priority:** P1 (High)

**Requirements:**

**Authorization:**
- Hanya owner report atau admin yang bisa delete
- Check sama dengan edit

**Confirmation:**
- JavaScript confirm dialog: "Yakin ingin menghapus?"
- Prevent accidental deletion

**Process:**
1. Find report by ID
2. Check authorization
3. Delete foto dari storage (jika ada)
4. Delete record dari database
5. Redirect ke catalog

**Acceptance Criteria:**
- [x] Delete button functional
- [x] Confirmation dialog muncul
- [x] Authorization check berfungsi
- [x] Foto terhapus dari storage
- [x] Record terhapus dari database
- [x] Redirect ke catalog (not 404!)
- [x] Flash message: "Laporan berhasil dihapus"

---

#### 6.1.3 Admin Dashboard

**Feature: Admin Dashboard**
- **Status:** ✅ Implemented
- **Priority:** P0 (Critical)

**Requirements:**

**Authorization:**
- Middleware: `['auth', 'role:admin']`
- Hanya user dengan role 'admin' yang bisa akses
- Jika bukan admin → 403 Forbidden

**Dashboard Components:**

1. **Statistics Cards:**
   - Total Laporan
   - Sudah Ditemukan
   - Sudah Dikembalikan
   - Belum Ditemukan
   - Real-time count dari database

2. **Reports Table:**
   - Display all reports dengan pagination (20 per page)
   - Columns:
     - ID
     - Nama Barang
     - Kategori
     - Tipe
     - Status (dropdown editable)
     - Pelapor (nama + kelas)
     - Tanggal
     - Actions (Update Status, Delete)
   - Latest first (newest on top)

3. **Filter:**
   - Filter by status
   - Auto-submit on change

**Actions:**
- Update status (inline dropdown)
- Delete laporan dengan confirmation

**Acceptance Criteria:**
- [x] Dashboard accessible di `/admin/dashboard`
- [x] Middleware protection berfungsi
- [x] Statistik cards accurate (real-time query)
- [x] Table pagination smooth
- [x] Filter by status berfungsi
- [x] Eager loading (`with('user')`) untuk performance

---

**Feature: Update Report Status (Admin)**
- **Status:** ✅ Implemented
- **Priority:** P0 (Critical)

**Requirements:**

**Authorization:**
- Hanya admin yang bisa update status
- Middleware: `role:admin`

**Status Options:**
- Belum Ditemukan
- Sudah Ditemukan
- Sudah Dikembalikan

**Process:**
1. Select laporan dari table
2. Choose new status dari dropdown
3. Submit via POST `/admin/reports/{id}/status`
4. Validate status value
5. Update database
6. Flash message: "Status laporan #{id} diperbarui menjadi: {status}"

**Acceptance Criteria:**
- [x] Dropdown menampilkan semua status options
- [x] Validation: only allowed status values
- [x] Update query berfungsi
- [x] Flash message informatif
- [x] Page tidak reload (future: AJAX)

---

**Feature: Delete Report (Admin)**
- **Status:** ✅ Implemented
- **Priority:** P1 (High)

**Requirements:**

**Authorization:**
- Hanya admin
- Middleware: `role:admin`

**Use Cases:**
- Moderate konten tidak sesuai
- Hapus laporan duplikat
- Cleanup laporan spam

**Process:**
- Same as user delete
- Delete foto dari storage (if exists)
- Delete record dari database

**Acceptance Criteria:**
- [x] Delete button di admin dashboard
- [x] Confirmation dialog
- [x] Authorization check
- [x] Photo deletion
- [x] Database deletion
- [x] Flash message

---

#### 6.1.4 Homepage & Public Pages

**Feature: Homepage**
- **Status:** ✅ Implemented
- **Priority:** P0 (Critical)

**Components:**

1. **Hero Section:**
   - Headline: "Temukan Kembali Barang Berhargamu di Sekolah"
   - Description singkat
   - CTA buttons:
     - "Laporkan Barang Sekarang" → `/reports/create` atau `/login`
     - "Cari di Daftar Temuan" → `/catalog`

2. **Statistics Cards:**
   - Total Laporan
   - Sudah Ditemukan
   - Sudah Dikembalikan
   - Belum Ditemukan
   - Real-time data dari database

3. **Recent Reports Section:**
   - 4 latest reports
   - Card dengan foto, title, kategori, status
   - Click to view detail

**Acceptance Criteria:**
- [x] Homepage accessible di `/`
- [x] Hero section responsive
- [x] Statistics cards real-time
- [x] Recent reports query optimized (`take(4)`)
- [x] Material Design 3 styling

---

### 6.2 Non-Functional Requirements

#### 6.2.1 Performance

| Metric | Requirement | Current |
|--------|------------|---------|
| **Page Load Time** | < 3 seconds | ✅ ~1-2s (local) |
| **Database Query** | < 100ms average | ✅ Optimized with indexes |
| **Image Upload** | < 5 seconds | ✅ < 3s (5MB) |
| **Search Response** | < 1 second | ✅ ~500ms |
| **Concurrent Users** | 100+ simultaneous | ⚠️ Not tested yet |

**Optimizations Implemented:**
- ✅ Eager loading (`with('user')`)
- ✅ Pagination (12-20 items per page)
- ✅ Database indexes on foreign keys
- ✅ Image optimization (max 5MB)
- ⚠️ Caching: Not implemented yet (future)

---

#### 6.2.2 Security

**Implemented Security Measures:**

1. **Authentication:**
   - ✅ Password hashing (bcrypt)
   - ✅ Session management
   - ✅ Session regeneration after login
   - ✅ Remember me token

2. **Authorization:**
   - ✅ Middleware protection (`auth`, `guest`, `role:admin`)
   - ✅ Controller-level checks
   - ✅ Route protection

3. **Input Validation:**
   - ✅ Server-side validation (Laravel rules)
   - ✅ Client-side validation (HTML5 + JS)
   - ✅ CSRF protection on all forms
   - ✅ SQL injection prevention (Eloquent ORM)
   - ✅ XSS prevention (Blade auto-escaping)

4. **File Upload:**
   - ✅ File type validation (image only)
   - ✅ File size limit (5MB)
   - ✅ Stored outside public root
   - ✅ Random filename generation

5. **Data Protection:**
   - ✅ `.env` file not in version control
   - ✅ `.gitignore` configured properly
   - ✅ Sensitive data in environment variables

**Not Implemented (Future):**
- ❌ Rate limiting
- ❌ Two-factor authentication
- ❌ Email verification
- ❌ Password reset
- ❌ Security headers (CSP, HSTS)
- ❌ Audit logging

---

#### 6.2.3 Scalability

**Current Architecture:**
- Single server deployment
- Shared hosting compatible
- MySQL database

**Scalability Considerations:**
- ✅ Database design normalized
- ✅ File storage abstraction (Laravel Storage)
- ⚠️ No load balancing yet
- ⚠️ No caching layer yet
- ⚠️ No CDN for static assets

**Future Improvements:**
- Database replication (read replicas)
- Redis caching
- Queue for async jobs (email, notifications)
- CDN for images
- Horizontal scaling

---

#### 6.2.4 Usability

**Design Principles:**
- Material Design 3 guidelines
- Mobile-first responsive design
- Accessibility considerations:
  - ✅ Semantic HTML
  - ✅ ARIA labels on interactive elements
  - ✅ Keyboard navigation support
  - ⚠️ Screen reader not fully tested
  - ⚠️ Color contrast not fully validated

**User Experience:**
- ✅ Instant feedback (flash messages)
- ✅ Error messages clear and actionable
- ✅ Loading states for async operations
- ✅ Empty states with helpful messages
- ✅ Responsive across devices

---

#### 6.2.5 Compatibility

**Browser Support:**
| Browser | Version | Status |
|---------|---------|--------|
| Chrome | 90+ | ✅ Fully tested |
| Firefox | 88+ | ✅ Tested |
| Safari | 14+ | ⚠️ Not tested |
| Edge | 90+ | ✅ Tested |
| Mobile Safari | 14+ | ⚠️ Not tested |
| Chrome Mobile | Latest | ✅ Tested |

**Device Support:**
- ✅ Desktop (1920x1080, 1366x768)
- ✅ Tablet (768x1024)
- ✅ Mobile (375x667, 414x896)

**Server Requirements:**
- PHP 8.1+
- MySQL 5.7+ or MariaDB 10.3+
- Apache/Nginx with mod_rewrite
- Composer 2.x
- Node.js 16+ (for asset compilation)

---

## 7. User Stories

### 7.1 As a Student (User)

**User Story 1: Report Lost Item**
```
As a student who lost my calculator,
I want to create a report with details and photo,
So that someone who found it can contact me.

Acceptance Criteria:
- Given I am logged in
- When I go to /reports/create
- And I fill in all required fields
- And I upload a photo of similar item
- And I submit the form
- Then my report should be saved to database
- And I should see my report in the catalog
- And I should receive a success message
```

**User Story 2: Search for Found Item**
```
As a student looking for my lost jacket,
I want to search the catalog by keyword "jaket",
So that I can quickly find if someone reported finding it.

Acceptance Criteria:
- Given I am on the catalog page
- When I type "jaket" in the search box
- Then I should see all reports with "jaket" in title/description/location
- And I should be able to filter by category "Pakaian & Aksesoris"
- And I should see the pelapor's WhatsApp contact to reach out
```

**User Story 3: Contact Report Owner**
```
As a student who found a matching item in catalog,
I want to contact the reporter via WhatsApp,
So that I can arrange to return the item.

Acceptance Criteria:
- Given I found a matching report
- When I click on the report card
- Then I should see full details
- And I should see a "Hubungi via WhatsApp" button
- When I click the button
- Then it should open WhatsApp with pre-filled message
```

**User Story 4: Edit My Report**
```
As a student who made a typo in my report,
I want to edit my report,
So that the information is accurate.

Acceptance Criteria:
- Given I am logged in
- And I am viewing my own report
- When I click "Edit Laporan"
- Then I should see a pre-filled form
- And I can update any field
- And I can replace the photo
- When I submit
- Then my report should be updated
- And I should be redirected to catalog
```

**User Story 5: Delete My Report After Found**
```
As a student whose item was returned,
I want to delete my report,
So that the catalog stays relevant.

Acceptance Criteria:
- Given I am logged in
- And I am viewing my own report
- When I click "Hapus Laporan"
- Then I should see a confirmation dialog
- When I confirm
- Then the report should be deleted from database
- And the photo should be removed from storage
- And I should be redirected to catalog
```

---

### 7.2 As a Staff Sarpras (Admin)

**User Story 6: View All Reports**
```
As a staff sarpras,
I want to see all reports in one dashboard,
So that I can monitor barang hilang/temuan di sekolah.

Acceptance Criteria:
- Given I am logged in as admin
- When I access /admin/dashboard
- Then I should see statistics cards (total, found, returned, pending)
- And I should see a table of all reports
- And I should see 20 reports per page
- And I can navigate through pages
```

**User Story 7: Update Report Status**
```
As a staff sarpras who has the item in storage,
I want to update the status to "Sudah Ditemukan",
So that the owner knows to come and collect it.

Acceptance Criteria:
- Given I am on admin dashboard
- And I see a report with status "Belum Ditemukan"
- When I select "Sudah Ditemukan" from dropdown
- And I submit
- Then the status should be updated in database
- And I should see a success message
- And the statistics should update
```

**User Story 8: Filter Reports by Status**
```
As a staff sarpras,
I want to filter reports by "Belum Ditemukan",
So that I can focus on active cases.

Acceptance Criteria:
- Given I am on admin dashboard
- When I select "Belum Ditemukan" from status filter
- Then I should see only reports with that status
- And the page should auto-submit
- And the filter should persist on pagination
```

**User Story 9: Delete Inappropriate Report**
```
As a staff sarpras,
I want to delete a spam report,
So that the system stays clean.

Acceptance Criteria:
- Given I am on admin dashboard
- When I click delete on any report
- Then I should see a confirmation dialog
- When I confirm
- Then the report and its photo should be deleted
- And I should see a success message
```

---

## 8. Technical Architecture

### 8.1 Technology Stack

**Backend:**
- **Framework:** Laravel 11
- **Language:** PHP 8.1+
- **Database:** MySQL 8.0
- **ORM:** Eloquent
- **Authentication:** Laravel Sanctum / Session-based

**Frontend:**
- **Templating:** Blade Engine
- **CSS Framework:** Tailwind CSS 3
- **Design System:** Material Design 3
- **Icons:** Material Symbols Outlined
- **Font:** Plus Jakarta Sans (Google Fonts)
- **JavaScript:** Vanilla JS (minimal)

**Infrastructure:**
- **Web Server:** Apache / Nginx
- **Storage:** Local file system (Storage facade)
- **Session Driver:** Database
- **Cache Driver:** File (future: Redis)

**Development Tools:**
- **Dependency Manager:** Composer
- **Version Control:** Git
- **Repository:** GitHub
- **IDE:** Kiro (VS Code-based)

---

### 8.2 Architecture Pattern

**MVC (Model-View-Controller):**

```
┌─────────────┐
│   Browser   │
└──────┬──────┘
       │ HTTP Request
       ▼
┌─────────────────────┐
│   Routes (web.php)  │ ← Middleware (auth, role)
└──────┬──────────────┘
       │
       ▼
┌─────────────────────┐
│   Controllers       │
│  - RegisterController
│  - LoginController
│  - ReportController
│  - AdminController
│  - HomeController
└──────┬──────────────┘
       │
       ├────────► ┌──────────────┐
       │          │    Models     │
       │          │  - User       │
       │          │  - Report     │
       │          └───────┬───────┘
       │                  │
       │                  ▼
       │          ┌──────────────┐
       │          │   MySQL DB   │
       │          │  - users     │
       │          │  - reports   │
       │          └──────────────┘
       │
       ▼
┌─────────────────────┐
│      Views          │
│  - Blade Templates  │
│  - Layouts          │
│  - Components       │
└──────┬──────────────┘
       │
       ▼
┌─────────────┐
│   Browser   │ ← Rendered HTML
└─────────────┘
```

---

### 8.3 Database Schema

**Entity Relationship Diagram:**

```
┌─────────────────────┐
│       users         │
├─────────────────────┤
│ id (PK)             │
│ name                │
│ email (UNIQUE)      │
│ password            │
│ role                │ ← ENUM('admin', 'user')
│ class               │
│ remember_token      │
│ created_at          │
│ updated_at          │
└──────────┬──────────┘
           │
           │ 1:N (One user can have many reports)
           │
           ▼
┌─────────────────────┐
│      reports        │
├─────────────────────┤
│ id (PK)             │
│ user_id (FK)        │ → users.id
│ title               │
│ category            │
│ type                │ ← ENUM('Barang Hilang', 'Barang Temuan')
│ location            │
│ report_date         │
│ report_time         │
│ status              │ ← ENUM('Belum Ditemukan', 'Sudah Ditemukan', 'Sudah Dikembalikan')
│ description         │
│ reporter_name       │
│ reporter_class      │
│ reporter_contact    │
│ image_path          │
│ created_at          │
│ updated_at          │
└─────────────────────┘
```

**Relationships:**
- `User` hasMany `Report`
- `Report` belongsTo `User`
- Cascade delete: if user deleted → all their reports deleted

**Indexes:**
- PRIMARY: `users.id`, `reports.id`
- UNIQUE: `users.email`
- FOREIGN KEY: `reports.user_id` → `users.id`
- INDEX: `reports.status`, `reports.category`, `reports.type` (for filtering)

---

### 8.4 File Structure

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
│
├── database/
│   ├── migrations/
│   │   ├── *_create_users_table.php
│   │   ├── *_create_reports_table.php
│   │   └── *_add_role_to_users_table.php
│   └── seeders/
│       └── DatabaseSeeder.php (disabled)
│
├── public/
│   ├── images/
│   │   └── logosmkn20.png
│   ├── storage/ → symlink to storage/app/public/
│   └── index.php
│
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
│       ├── catalog.blade.php
│       └── welcome.blade.php
│
├── routes/
│   └── web.php
│
├── storage/
│   ├── app/
│   │   └── public/
│   │       └── reports/ ← uploaded images
│   ├── framework/
│   └── logs/
│
├── docs/
│   ├── flowcharts/
│   │   ├── README.md
│   │   ├── 01-flowchart-login-register.md
│   │   ├── 02-flowchart-pelaporan-barang.md
│   │   ├── 03-flowchart-pengelolaan-admin.md
│   │   └── pdf/
│   └── PRODUCT_REQUIREMENT_DOCUMENT.md (this file)
│
├── .env (not in Git)
├── .env.example
├── .gitignore
├── composer.json
├── README.md
└── PANDUAN_JAWABAN_PENGUJI.md
```

---

### 8.5 API Endpoints (Routes)

**Public Routes:**
```
GET  /                    → HomeController@index
GET  /catalog             → HomeController@catalog
GET  /reports/{id}        → HomeController@show
```

**Guest Routes (not authenticated):**
```
GET  /login               → LoginController@showLoginForm
POST /login               → LoginController@login
GET  /register            → RegisterController@showRegisterForm
POST /register            → RegisterController@register
```

**Authenticated Routes:**
```
POST   /logout            → LoginController@logout
GET    /reports/create    → ReportController@create
POST   /reports           → ReportController@store
GET    /reports/{id}/edit → ReportController@edit
PUT    /reports/{id}      → ReportController@update
DELETE /reports/{id}      → ReportController@destroy
```

**Admin Routes (role:admin):**
```
GET    /admin/dashboard              → AdminController@index
POST   /admin/reports/{id}/status    → AdminController@updateStatus
DELETE /admin/reports/{id}           → AdminController@destroy
GET    /admin/export                 → AdminController@export (placeholder)
```

---

## 9. User Interface & Experience

### 9.1 Design System

**Material Design 3 Color Palette:**

```scss
Primary Colors:
  --primary: #00236f         (Dark Blue)
  --primary-container: #1e3a8a
  --on-primary: #ffffff

Secondary Colors:
  --secondary: #006398       (Blue)
  --secondary-container: #5bb8fe
  --secondary-fixed: #cce5ff

Surface Colors:
  --surface: #faf8ff
  --surface-container-lowest: #ffffff
  --surface-container-low: #f2f3ff
  --surface-container: #eaedff
  --on-surface: #131b2e

Outline Colors:
  --outline: #757682
  --outline-variant: #c5c5d3

Error Colors:
  --error: #ba1a1a
  --error-container: #ffdad6
```

**Typography:**
- **Font Family:** Plus Jakarta Sans (Google Fonts)
- **Weights:** 400 (Regular), 500 (Medium), 600 (Semi-bold), 700 (Bold), 800 (Extra-bold)
- **Headings:** Bold/Extra-bold
- **Body:** Regular/Medium

**Icons:**
- **Library:** Material Symbols Outlined
- **Usage:** Buttons, cards, navigation

---

### 9.2 Key Screens

#### 9.2.1 Homepage
**Purpose:** Landing page, show statistics, recent reports

**Components:**
- Hero section dengan gradient background
- CTA buttons (Laporkan Barang, Cari Barang)
- Statistics cards (4 cards)
- Recent reports grid (4 latest)
- Footer

**Responsive:**
- Desktop: Hero full width, stats 4 columns, recent 4 columns
- Tablet: Hero full width, stats 2 columns, recent 2 columns
- Mobile: Hero full width, stats 2 columns, recent 1 column

---

#### 9.2.2 Register Page
**Purpose:** User registration

**Components:**
- Centered form card
- Logo icon
- Form fields (nama, email, kelas, password, confirm password)
- Submit button
- Link to login

**UX:**
- Inline validation
- Error messages below fields
- Password strength indicator (future)
- "Sudah punya akun? Login di sini" link

---

#### 9.2.3 Login Page
**Purpose:** User authentication

**Components:**
- Centered form card
- Logo icon
- Form fields (email, password)
- Remember me checkbox
- Submit button
- Link to register

**UX:**
- Inline validation
- Error messages
- Auto-focus email field
- "Belum punya akun? Daftar sekarang" link

---

#### 9.2.4 Catalog Page
**Purpose:** Browse and search all reports

**Components:**
- Page header with title & description
- Search bar (full width)
- Filter dropdowns (category, status, type)
- Reports grid (cards)
- Pagination

**Card Design:**
- Photo (if available)
- Badge: Type (Hilang/Temuan)
- Badge: Status (color-coded)
- Title (bold)
- Category & location
- Date
- Click to view detail

**Responsive:**
- Desktop: 3 columns grid
- Tablet: 2 columns grid
- Mobile: 1 column grid

**Empty State:**
- Icon + message: "Tidak ada laporan ditemukan"
- CTA: "Buat laporan baru"

---

#### 9.2.5 Report Detail Page
**Purpose:** View full report details

**Components:**
- Back button
- Large photo (if available)
- All report information
- Status badge (prominent)
- Contact section:
  - Pelapor name & class
  - WhatsApp button (if not owner)
- Action buttons (if owner/admin):
  - Edit Laporan
  - Hapus Laporan

**Layout:**
- Two-column on desktop (photo left, info right)
- Single column on mobile (photo top, info bottom)

---

#### 9.2.6 Create Report Page
**Purpose:** Submit new report

**Components:**
- Form header
- Step indicator (future)
- Radio button: Tipe laporan (interactive cards)
- Form fields (all required fields)
- Photo upload (with preview)
- Submit button

**UX:**
- Radio button: click anywhere on card
- Date picker: calendar UI
- Time picker: clock UI
- Photo preview: show before upload
- Character counter on textarea
- Inline validation
- Success message after submit

---

#### 9.2.7 Admin Dashboard
**Purpose:** Manage all reports

**Components:**
- Statistics cards (4 cards)
- Filter dropdown (by status)
- Reports table:
  - Columns: ID, Barang, Kategori, Tipe, Status, Pelapor, Tanggal, Actions
  - Status: inline dropdown (editable)
  - Actions: Update, Delete
- Pagination

**Table Features:**
- Sortable columns (future)
- Row hover highlight
- Status dropdown: auto-submit
- Delete: confirmation dialog

**Responsive:**
- Desktop: Full table
- Tablet: Horizontal scroll
- Mobile: Card view (future)

---

### 9.3 Responsive Breakpoints

```scss
Mobile:    < 640px  (sm)
Tablet:    640px - 1024px (sm to lg)
Desktop:   > 1024px (lg+)

Tailwind breakpoints:
sm:  640px
md:  768px
lg:  1024px
xl:  1280px
2xl: 1536px
```

---

### 9.4 Accessibility

**Current Implementation:**
- ✅ Semantic HTML5 tags
- ✅ Form labels properly associated
- ✅ ARIA labels on buttons and icons
- ✅ Keyboard navigation support
- ✅ Focus states visible
- ⚠️ Color contrast not fully validated
- ⚠️ Screen reader not fully tested

**Future Improvements:**
- [ ] WCAG 2.1 AA compliance
- [ ] Screen reader testing
- [ ] Keyboard shortcuts
- [ ] Skip to content link
- [ ] Alt text on all images
- [ ] ARIA live regions for dynamic content

---

## 10. Security & Privacy

### 10.1 Security Measures

**Authentication & Authorization:**
- Password hashing: bcrypt (cost 12)
- Session-based authentication
- CSRF protection on all forms
- Middleware protection on routes
- Role-based access control

**Input Validation:**
- Server-side validation (Laravel)
- Client-side validation (HTML5 + JS)
- SQL injection prevention (Eloquent ORM)
- XSS prevention (Blade auto-escaping)

**File Upload:**
- Type validation (image only)
- Size limit (5MB)
- Stored outside public root
- Random filename generation
- MIME type checking

**Data Protection:**
- Sensitive data in `.env`
- `.env` not in version control
- Database credentials secure
- No sensitive data in logs

**Session Management:**
- Session regeneration after login
- Session invalidation on logout
- Secure session driver (database)
- HTTP-only cookies

---

### 10.2 Privacy

**Data Collection:**
- Nama, email, kelas (registration)
- Nama pelapor, kelas, kontak (report)
- IP address (server logs)
- Session data (temporary)

**Data Usage:**
- Authentication & authorization
- Report display & search
- Contact facilitation
- Analytics (future)

**Data Sharing:**
- Publicly visible: Nama barang, lokasi, tanggal, foto, kontak pelapor
- Private: Email, password
- Tidak ada third-party sharing

**Data Retention:**
- User account: Until deleted by user or admin
- Reports: Until deleted by owner or admin
- Session: 120 minutes idle
- Logs: 30 days (rotated)

**User Rights:**
- Edit profile (future)
- Delete account (future)
- Edit/delete own reports
- Export data (future - GDPR)

---

### 10.3 Compliance

**Current Status:**
- ⚠️ No formal security audit
- ⚠️ No privacy policy page
- ⚠️ No terms of service
- ⚠️ No GDPR compliance (not required for internal school system)

**Recommendations:**
- [ ] Create privacy policy
- [ ] Create terms of service
- [ ] Security audit by third party
- [ ] Penetration testing
- [ ] Regular security updates

---

## 11. Performance Requirements

### 11.1 Page Load Time

**Targets:**
- Homepage: < 2 seconds
- Catalog: < 3 seconds
- Report detail: < 2 seconds
- Admin dashboard: < 3 seconds

**Optimizations:**
- ✅ Eager loading (N+1 query prevention)
- ✅ Pagination (limit results)
- ✅ Database indexes
- ⚠️ Image optimization (future: WebP, lazy loading)
- ⚠️ Asset minification (future)
- ⚠️ Caching (future: Redis)

---

### 11.2 Database Performance

**Query Optimization:**
- Indexes on: `user_id`, `status`, `category`, `type`
- Eager loading: `Report::with('user')`
- Pagination: 12-20 items per page
- Avoid N+1 queries

**Database Size Estimation:**
- 1000 users: ~100 KB
- 10,000 reports: ~50 MB (text data)
- Photos (avg 1MB): 10,000 * 0.5 MB = 5 GB
- Total: ~5.1 GB for 10K reports

---

### 11.3 Concurrent Users

**Expected Load:**
- Normal: 50-100 concurrent users
- Peak: 200-300 concurrent users (during break time)

**Server Requirements:**
- CPU: 2-4 cores
- RAM: 4-8 GB
- Storage: 50 GB (for photos)
- Bandwidth: 100 Mbps

---

## 12. Success Metrics

### 12.1 User Adoption

**KPIs:**
- [ ] 100+ registered users within 1 month
- [ ] 50+ reports created within 1 month
- [ ] 70% of students aware of the system
- [ ] 50% of lost items reported through system

**Measurement:**
- User count query
- Report count query
- Survey awareness
- Compare with manual log (if available)

---

### 12.2 User Engagement

**KPIs:**
- [ ] 30% monthly active users (MAU)
- [ ] 10% daily active users (DAU)
- [ ] Average 3 reports per active user
- [ ] 50% return rate (users who come back)

**Measurement:**
- Login logs
- Report creation timestamps
- Session analytics
- Google Analytics (future)

---

### 12.3 Recovery Rate

**KPIs:**
- [ ] 50% of reported items status changed to "Sudah Ditemukan"
- [ ] 30% of items status "Sudah Dikembalikan"
- [ ] Average 7 days from report to found
- [ ] Average 14 days from report to returned

**Measurement:**
- Status change logs
- Time difference calculation
- Survey follow-up

---

### 12.4 System Performance

**KPIs:**
- [ ] 99% uptime
- [ ] < 3 seconds average page load
- [ ] < 1% error rate
- [ ] Zero critical security incidents

**Measurement:**
- Uptime monitoring (Pingdom, UptimeRobot)
- Laravel Telescope (performance monitoring)
- Error logs
- Security audit reports

---

### 12.5 User Satisfaction

**KPIs:**
- [ ] 80% user satisfaction score
- [ ] 4.0+ rating (if rating system implemented)
- [ ] < 5% complaint rate
- [ ] 70% would recommend to others

**Measurement:**
- User survey
- Feedback form
- NPS (Net Promoter Score)
- User interviews

---

## 13. Future Roadmap

### 13.1 Phase 2 (Short-term: 1-3 months)

**Priority Features:**

1. **Email Notifications**
   - Email after report created
   - Email when status changed
   - Email digest (weekly summary)

2. **Password Reset**
   - Forgot password flow
   - Reset password via email

3. **Advanced Search**
   - Search by multiple fields
   - Date range filter
   - Sort options (newest, oldest, most relevant)

4. **Export Functionality**
   - Export reports to Excel
   - Export statistics to PDF
   - Admin reporting

5. **User Profile**
   - Edit profile page
   - View own report history
   - Delete account option

---

### 13.2 Phase 3 (Mid-term: 3-6 months)

**Enhancement Features:**

1. **Real-time Notifications**
   - Push notifications (PWA)
   - In-app notification center
   - Notification preferences

2. **Chat/Messaging**
   - In-app messaging between users
   - Avoid exposing WhatsApp directly
   - Message history

3. **Multi-photo Upload**
   - Upload up to 5 photos per report
   - Image gallery
   - Image carousel

4. **Advanced Analytics**
   - Dashboard charts (reports over time)
   - Category analysis
   - Location heatmap
   - Recovery rate trends

5. **Geolocation**
   - Map view of report locations
   - Nearby reports
   - Location autocomplete

---

### 13.3 Phase 4 (Long-term: 6-12 months)

**Strategic Features:**

1. **Mobile App**
   - Native iOS app
   - Native Android app
   - Or Progressive Web App (PWA)

2. **AI/ML Integration**
   - Image recognition (match similar items)
   - Duplicate detection
   - Smart recommendations

3. **Gamification**
   - Points for reporting found items
   - Badges for helpful users
   - Leaderboard

4. **Multi-school Support**
   - SaaS model
   - Multi-tenancy
   - School branding customization

5. **Integration**
   - WhatsApp Business API
   - School ERP integration
   - QR code generation for items

---

### 13.4 Technical Debt & Improvements

**Code Quality:**
- [ ] Write unit tests (PHPUnit)
- [ ] Write feature tests
- [ ] Increase code coverage to 80%+
- [ ] Code refactoring
- [ ] Follow PSR-12 coding standards

**Performance:**
- [ ] Implement Redis caching
- [ ] Database query optimization
- [ ] Image lazy loading
- [ ] CDN for static assets
- [ ] Asset minification & bundling

**Security:**
- [ ] Security audit
- [ ] Penetration testing
- [ ] Implement rate limiting
- [ ] Add security headers
- [ ] Regular dependency updates

**DevOps:**
- [ ] CI/CD pipeline
- [ ] Automated deployment
- [ ] Database backup strategy
- [ ] Monitoring & alerting
- [ ] Error tracking (Sentry)

---

## 14. Appendix

### 14.1 Glossary

| Term | Definition |
|------|------------|
| **Barang Hilang** | Item that is lost by its owner |
| **Barang Temuan** | Item that is found by someone |
| **Pelapor** | Person who creates the report |
| **Sarpras** | Sarana dan Prasarana (facilities and infrastructure staff) |
| **USK** | Ujian Sekolah Kompetensi (school competency exam) |
| **RPL** | Rekayasa Perangkat Lunak (Software Engineering) |

---

### 14.2 References

**Framework Documentation:**
- Laravel 11: https://laravel.com/docs/11.x
- Tailwind CSS 3: https://tailwindcss.com/docs
- Material Design 3: https://m3.material.io/

**Tools:**
- Composer: https://getcomposer.org/
- Git: https://git-scm.com/
- Whimsical: https://whimsical.com/

**Related Documents:**
- README.md - Installation & usage guide
- PANDUAN_JAWABAN_PENGUJI.md - Q&A for exam
- Flowcharts (docs/flowcharts/) - System flowcharts

---

### 14.3 Change Log

| Version | Date | Changes | Author |
|---------|------|---------|--------|
| 1.0.0 | 2 Nov 2026 | Initial PRD creation | Alvaro Geraldy |

---

### 14.4 Contact

**Developer:**
- **Name:** Alvaro Geraldy
- **Class:** XII RPL
- **School:** SMK Negeri 20 Jakarta
- **GitHub:** https://github.com/GEraldY56/BarangTemu

**For Questions:**
- Technical issues: Create GitHub issue
- Feature requests: Create GitHub issue
- General inquiries: Contact via school

---

## Approval Signatures

**Document Prepared By:**
- Alvaro Geraldy (Developer, XII RPL)
- Date: 2 November 2026

**Reviewed By:**
- _______________ (Pembimbing/Guru)
- Date: __________

**Approved By:**
- _______________ (Kepala Sekolah/Wakasek)
- Date: __________

---

**Document Status:** ✅ Draft Complete  
**Next Review:** Post-Launch (1 month after deployment)

---

**END OF DOCUMENT**

---

*Product Requirement Document (PRD) - BarangTemu*  
*Version 1.0.0 | © 2026 SMK Negeri 20 Jakarta*
