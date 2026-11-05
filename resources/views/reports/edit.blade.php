@extends('layouts.app')

@section('title', 'Edit Laporan - BarangTemu')

@section('content')
<div class="max-w-3xl mx-auto bg-surface-container-lowest p-6 sm:p-10 rounded-3xl border border-outline-variant shadow-sm">
    <div class="text-center space-y-2 mb-8">
        <h2 class="text-3xl font-bold text-on-surface">Edit Laporan Barang</h2>
        <p class="text-sm text-outline">Perbarui informasi laporan Anda.</p>
    </div>

    <form action="{{ route('reports.update', $report->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Report Type -->
        <div class="space-y-2">
            <label class="text-sm font-semibold text-on-surface block">Jenis Laporan *</label>
            <div class="grid grid-cols-2 gap-4">
                <label class="flex items-center gap-3 p-4 rounded-2xl border-2 cursor-pointer transition-all {{ old('report_type', $report->type) == 'Barang Hilang' ? 'border-primary bg-primary/5' : 'border-outline-variant hover:border-primary/50' }}">
                    <input type="radio" name="report_type" value="Barang Hilang" {{ old('report_type', $report->type) == 'Barang Hilang' ? 'checked' : '' }} class="text-primary focus:ring-secondary" required/>
                    <div>
                        <span class="text-sm font-bold text-primary block">Barang Hilang</span>
                        <span class="text-xs text-outline">Saya kehilangan barang milik pribadi</span>
                    </div>
                </label>
                <label class="flex items-center gap-3 p-4 rounded-2xl border-2 cursor-pointer transition-all {{ old('report_type', $report->type) == 'Barang Temuan' ? 'border-primary bg-primary/5' : 'border-outline-variant hover:border-primary/50' }}">
                    <input type="radio" name="report_type" value="Barang Temuan" {{ old('report_type', $report->type) == 'Barang Temuan' ? 'checked' : '' }} class="text-primary focus:ring-secondary" required/>
                    <div>
                        <span class="text-sm font-bold text-on-surface block">Barang Temuan</span>
                        <span class="text-xs text-outline">Saya menemukan barang tak bertuan</span>
                    </div>
                </label>
            </div>
        </div>

        <!-- Item Name -->
        <div class="space-y-2">
            <label for="title" class="text-sm font-semibold text-on-surface block">Nama Barang *</label>
            <input type="text" name="title" id="title" value="{{ old('title', $report->title) }}" required
                   class="w-full px-4 py-3 rounded-xl border border-outline-variant bg-surface-container-lowest focus:border-secondary focus:ring-2 focus:ring-secondary-fixed outline-none text-on-surface"
                   placeholder="Contoh: Almamater Hitam UK XL"/>
        </div>

        <!-- Category & Location -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="space-y-2">
                <label for="category" class="text-sm font-semibold text-on-surface block">Kategori Barang *</label>
                <select name="category" id="category" required class="w-full px-4 py-3 rounded-xl border border-outline-variant bg-surface-container-lowest focus:border-secondary focus:ring-2 focus:ring-secondary-fixed outline-none text-on-surface">
                    <option value="Elektronik & Gadget" {{ old('category', $report->category) == 'Elektronik & Gadget' ? 'selected' : '' }}>Elektronik & Gadget</option>
                    <option value="Alat Tulis & Buku" {{ old('category', $report->category) == 'Alat Tulis & Buku' ? 'selected' : '' }}>Alat Tulis & Buku</option>
                    <option value="Pakaian & Jaket" {{ old('category', $report->category) == 'Pakaian & Jaket' ? 'selected' : '' }}>Pakaian & Jaket</option>
                    <option value="Identitas & Kartu" {{ old('category', $report->category) == 'Identitas & Kartu' ? 'selected' : '' }}>Identitas & Kartu</option>
                    <option value="Kunci & Aksesoris" {{ old('category', $report->category) == 'Kunci & Aksesoris' ? 'selected' : '' }}>Kunci & Aksesoris</option>
                    <option value="Lainnya" {{ old('category', $report->category) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
            </div>
            <div class="space-y-2">
                <label for="location" class="text-sm font-semibold text-on-surface block">Lokasi Terakhir / Ditemukan *</label>
                <input type="text" name="location" id="location" value="{{ old('location', $report->location) }}" required
                       class="w-full px-4 py-3 rounded-xl border border-outline-variant bg-surface-container-lowest focus:border-secondary focus:ring-2 focus:ring-secondary-fixed outline-none text-on-surface"/>
            </div>
        </div>

        <!-- Date & Time -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="space-y-2">
                <label for="report_date" class="text-sm font-semibold text-on-surface block">Tanggal Kejadian *</label>
                <input type="date" name="report_date" id="report_date" value="{{ old('report_date', $report->report_date->format('Y-m-d')) }}" required
                       class="w-full px-4 py-3 rounded-xl border border-outline-variant bg-surface-container-lowest focus:border-secondary focus:ring-2 focus:ring-secondary-fixed outline-none text-on-surface"/>
            </div>
            <div class="space-y-2">
                <label for="report_time" class="text-sm font-semibold text-on-surface block">Perkiraan Waktu (Opsional)</label>
                <input type="time" name="report_time" id="report_time" value="{{ old('report_time', $report->report_time ? $report->report_time->format('H:i') : '') }}"
                       class="w-full px-4 py-3 rounded-xl border border-outline-variant bg-surface-container-lowest focus:border-secondary focus:ring-2 focus:ring-secondary-fixed outline-none text-on-surface"/>
            </div>
        </div>

        <!-- Description -->
        <div class="space-y-2">
            <label for="description" class="text-sm font-semibold text-on-surface block">Deskripsi Detail & Ciri Khas *</label>
            <textarea name="description" id="description" rows="3" required
                      class="w-full px-4 py-3 rounded-xl border border-outline-variant bg-surface-container-lowest focus:border-secondary focus:ring-2 focus:ring-secondary-fixed outline-none text-on-surface">{{ old('description', $report->description) }}</textarea>
        </div>

        <!-- Reporter Info -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="space-y-2">
                <label for="reporter_name" class="text-sm font-semibold text-on-surface block">Nama Lengkap *</label>
                <input type="text" name="reporter_name" id="reporter_name" value="{{ old('reporter_name', $report->reporter_name) }}" required
                       class="w-full px-4 py-3 rounded-xl border border-outline-variant bg-surface-container-lowest focus:border-secondary focus:ring-2 focus:ring-secondary-fixed outline-none text-on-surface"/>
            </div>
            <div class="space-y-2">
                <label for="reporter_class" class="text-sm font-semibold text-on-surface block">Kelas / Posisi *</label>
                <input type="text" name="reporter_class" id="reporter_class" value="{{ old('reporter_class', $report->reporter_class) }}" required
                       class="w-full px-4 py-3 rounded-xl border border-outline-variant bg-surface-container-lowest focus:border-secondary focus:ring-2 focus:ring-secondary-fixed outline-none text-on-surface"/>
            </div>
            <div class="space-y-2">
                <label for="reporter_contact" class="text-sm font-semibold text-on-surface block">No. WhatsApp Aktif *</label>
                <input type="tel" name="reporter_contact" id="reporter_contact" value="{{ old('reporter_contact', $report->reporter_contact) }}" required
                       class="w-full px-4 py-3 rounded-xl border border-outline-variant bg-surface-container-lowest focus:border-secondary focus:ring-2 focus:ring-secondary-fixed outline-none text-on-surface"/>
            </div>
        </div>

        <!-- Photo Upload -->
        <div class="space-y-2">
            <label class="text-sm font-semibold text-on-surface block">Foto Barang (Opsional)</label>
            @if($report->image_path)
                <div class="mb-3">
                    <img src="{{ asset('storage/' . $report->image_path) }}" alt="Current" class="w-32 h-32 object-cover rounded-xl border border-outline-variant shadow-sm"/>
                    <p class="text-xs text-outline mt-1">Foto saat ini. Upload foto baru untuk mengganti.</p>
                </div>
            @endif
            <input type="file" name="image" id="image" accept="image/*" class="w-full px-4 py-3 rounded-xl border border-outline-variant bg-surface-container-lowest focus:border-secondary focus:ring-2 focus:ring-secondary-fixed outline-none text-on-surface"/>
        </div>

        <!-- Submit Button -->
        <div class="pt-4 flex items-center justify-end gap-3">
            <a href="{{ route('reports.show', $report->id) }}" class="px-5 py-3 rounded-xl text-outline hover:text-on-surface text-sm font-semibold">
                Batal
            </a>
            <button type="submit" class="bg-primary-container text-on-primary text-sm font-bold px-8 py-3.5 rounded-xl shadow-md hover:bg-primary transition-all flex items-center gap-2">
                <span class="material-symbols-outlined">save</span>
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
