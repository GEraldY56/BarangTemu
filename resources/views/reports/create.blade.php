@extends('layouts.app')

@section('title', 'Laporkan Barang - BarangTemu')

@section('content')
<div class="max-w-3xl mx-auto bg-surface-container-lowest p-6 sm:p-10 rounded-3xl border border-outline-variant shadow-sm">
    <div class="text-center space-y-2 mb-8">
        <div class="inline-flex items-center gap-1.5 text-primary bg-surface-container px-3 py-1 rounded-full text-xs">
            <span class="material-symbols-outlined text-sm">edit_note</span>
            Formulir Resmi Sarpras
        </div>
        <h2 class="text-3xl font-bold text-on-surface">Buat Laporan Barang</h2>
        <p class="text-sm text-outline">Bantu sesama warga sekolah menemukan kembali barang yang hilang atau serahkan temuan Anda.</p>
    </div>

    <form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- Report Type -->
        <div class="space-y-2">
            <label class="text-sm font-semibold text-on-surface block">Jenis Laporan *</label>
            <div class="grid grid-cols-2 gap-4" id="report-type-container">
                <label class="report-type-option flex items-center gap-3 p-4 rounded-2xl border-2 cursor-pointer transition-all border-outline-variant hover:border-primary/50" data-value="Barang Hilang">
                    <input type="radio" name="report_type" value="Barang Hilang" {{ old('report_type', 'Barang Hilang') == 'Barang Hilang' ? 'checked' : '' }} class="text-primary focus:ring-secondary" required/>
                    <div>
                        <span class="text-sm font-bold text-primary block">Barang Hilang</span>
                        <span class="text-xs text-outline">Saya kehilangan barang milik pribadi</span>
                    </div>
                </label>
                <label class="report-type-option flex items-center gap-3 p-4 rounded-2xl border-2 cursor-pointer transition-all border-outline-variant hover:border-primary/50" data-value="Barang Temuan">
                    <input type="radio" name="report_type" value="Barang Temuan" {{ old('report_type') == 'Barang Temuan' ? 'checked' : '' }} class="text-primary focus:ring-secondary" required/>
                    <div>
                        <span class="text-sm font-bold text-on-surface block">Barang Temuan</span>
                        <span class="text-xs text-outline">Saya menemukan barang tak bertuan</span>
                    </div>
                </label>
            </div>
            @error('report_type')
                <p class="text-xs text-error mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Item Name -->
        <div class="space-y-2">
            <label for="title" class="text-sm font-semibold text-on-surface block">Nama Barang *</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" required
                   class="w-full px-4 py-3 rounded-xl border border-outline-variant bg-surface-container-lowest focus:border-secondary focus:ring-2 focus:ring-secondary-fixed outline-none text-on-surface transition-all @error('title') border-error @enderror"
                   placeholder="Contoh: Kacamata, Almamater Hitam UK XL"/>
            @error('title')
                <p class="text-xs text-error mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Category & Location -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="space-y-2">
                <label for="category" class="text-sm font-semibold text-on-surface block">Kategori Barang *</label>
                <select name="category" id="category" required
                        class="w-full px-4 py-3 rounded-xl border border-outline-variant bg-surface-container-lowest focus:border-secondary focus:ring-2 focus:ring-secondary-fixed outline-none text-on-surface @error('category') border-error @enderror">
                    <option value="Elektronik & Gadget" {{ old('category') == 'Elektronik & Gadget' ? 'selected' : '' }}>Elektronik & Gadget</option>
                    <option value="Alat Tulis & Buku" {{ old('category') == 'Alat Tulis & Buku' ? 'selected' : '' }}>Alat Tulis & Buku</option>
                    <option value="Pakaian & Jaket" {{ old('category') == 'Pakaian & Jaket' ? 'selected' : '' }}>Pakaian & Jaket</option>
                    <option value="Identitas & Kartu" {{ old('category') == 'Identitas & Kartu' ? 'selected' : '' }}>Identitas & Kartu</option>
                    <option value="Kunci & Aksesoris" {{ old('category') == 'Kunci & Aksesoris' ? 'selected' : '' }}>Kunci & Aksesoris</option>
                    <option value="Lainnya" {{ old('category') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
                @error('category')
                    <p class="text-xs text-error mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="space-y-2">
                <label for="location" class="text-sm font-semibold text-on-surface block">Lokasi Terakhir / Ditemukan *</label>
                <input type="text" name="location" id="location" value="{{ old('location') }}" required
                       class="w-full px-4 py-3 rounded-xl border border-outline-variant bg-surface-container-lowest focus:border-secondary focus:ring-2 focus:ring-secondary-fixed outline-none text-on-surface @error('location') border-error @enderror"
                       placeholder="Misal: Lab Bahasa, Meja Piket"/>
                @error('location')
                    <p class="text-xs text-error mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Date & Time -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="space-y-2">
                <label for="report_date" class="text-sm font-semibold text-on-surface block">Tanggal Kejadian *</label>
                <input type="date" name="report_date" id="report_date" value="{{ old('report_date', date('Y-m-d')) }}" required
                       class="w-full px-4 py-3 rounded-xl border border-outline-variant bg-surface-container-lowest focus:border-secondary focus:ring-2 focus:ring-secondary-fixed outline-none text-on-surface @error('report_date') border-error @enderror"/>
                @error('report_date')
                    <p class="text-xs text-error mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="space-y-2">
                <label for="report_time" class="text-sm font-semibold text-on-surface block">Perkiraan Waktu (Opsional)</label>
                <input type="time" name="report_time" id="report_time" value="{{ old('report_time') }}"
                       class="w-full px-4 py-3 rounded-xl border border-outline-variant bg-surface-container-lowest focus:border-secondary focus:ring-2 focus:ring-secondary-fixed outline-none text-on-surface"/>
            </div>
        </div>

        <!-- Description -->
        <div class="space-y-2">
            <label for="description" class="text-sm font-semibold text-on-surface block">Deskripsi Detail & Ciri Khas *</label>
            <textarea name="description" id="description" rows="3" required
                      class="w-full px-4 py-3 rounded-xl border border-outline-variant bg-surface-container-lowest focus:border-secondary focus:ring-2 focus:ring-secondary-fixed outline-none text-on-surface @error('description') border-error @enderror"
                      placeholder="Sebutkan warna spesifik, stiker yang menempel, goresan, gantungan kunci, atau nomor seri jika ada...">{{ old('description') }}</textarea>
            @error('description')
                <p class="text-xs text-error mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Reporter Info -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="space-y-2">
                <label for="reporter_name" class="text-sm font-semibold text-on-surface block">Nama Lengkap *</label>
                <input type="text" name="reporter_name" id="reporter_name" value="{{ old('reporter_name', auth()->check() ? auth()->user()->name : '') }}" required
                       class="w-full px-4 py-3 rounded-xl border border-outline-variant bg-surface-container-lowest focus:border-secondary focus:ring-2 focus:ring-secondary-fixed outline-none text-on-surface @error('reporter_name') border-error @enderror"
                       placeholder="Nama"/>
                @error('reporter_name')
                    <p class="text-xs text-error mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="space-y-2">
                <label for="reporter_class" class="text-sm font-semibold text-on-surface block">Kelas / Posisi *</label>
                <input type="text" name="reporter_class" id="reporter_class" value="{{ old('reporter_class', auth()->check() ? auth()->user()->class : '') }}" required
                       class="w-full px-4 py-3 rounded-xl border border-outline-variant bg-surface-container-lowest focus:border-secondary focus:ring-2 focus:ring-secondary-fixed outline-none text-on-surface @error('reporter_class') border-error @enderror"
                       placeholder="Kelas"/>
                @error('reporter_class')
                    <p class="text-xs text-error mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="space-y-2">
                <label for="reporter_contact" class="text-sm font-semibold text-on-surface block">No. WhatsApp Aktif *</label>
                <input type="tel" name="reporter_contact" id="reporter_contact" value="{{ old('reporter_contact') }}" required
                       class="w-full px-4 py-3 rounded-xl border border-outline-variant bg-surface-container-lowest focus:border-secondary focus:ring-2 focus:ring-secondary-fixed outline-none text-on-surface @error('reporter_contact') border-error @enderror"
                       placeholder="Nomor"/>
                @error('reporter_contact')
                    <p class="text-xs text-error mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Photo Upload -->
        <div class="space-y-2">
            <label class="text-sm font-semibold text-on-surface block">Foto Barang (Opsional namun disarankan)</label>
            <div class="border-2 border-dashed border-secondary-container rounded-2xl p-6 text-center bg-surface-container-low hover:bg-surface-container transition-colors cursor-pointer" onclick="document.getElementById('image').click()">
                <input type="file" name="image" id="image" accept="image/*" class="hidden" onchange="previewImage(event)"/>
                <div id="upload-prompt">
                    <span class="material-symbols-outlined text-4xl text-secondary">photo_camera</span>
                    <div class="text-sm font-bold text-on-surface mt-2">Klik atau seret foto bukti barang di sini</div>
                    <div class="text-xs text-outline mt-1">Format JPG, PNG maksimal 5MB. Membantu mempercepat klaim barang.</div>
                </div>
                <div id="preview-container" class="hidden mt-3 flex items-center justify-center gap-3">
                    <img id="preview-image" class="w-20 h-20 object-cover rounded-xl border border-outline-variant shadow-sm"/>
                    <span class="text-sm text-primary font-bold">Foto siap diunggah!</span>
                </div>
            </div>
            @error('image')
                <p class="text-xs text-error mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="pt-4 flex items-center justify-end gap-3">
            <a href="{{ route('home') }}" class="px-5 py-3 rounded-xl text-outline hover:text-on-surface text-sm font-semibold">
                Batal
            </a>
            <button type="submit" class="bg-primary-container text-on-primary text-sm font-bold px-8 py-3.5 rounded-xl shadow-md hover:bg-primary transition-all flex items-center gap-2">
                <span class="material-symbols-outlined">send</span>
                Kirim Laporan
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
// Handle Report Type Selection - Interactive Radio Buttons
document.addEventListener('DOMContentLoaded', function() {
    const reportTypeOptions = document.querySelectorAll('.report-type-option');
    const radioButtons = document.querySelectorAll('input[name="report_type"]');

    // Function to update active state
    function updateActiveState() {
        reportTypeOptions.forEach(option => {
            const radio = option.querySelector('input[type="radio"]');
            if (radio.checked) {
                // Active state
                option.classList.remove('border-outline-variant');
                option.classList.add('border-primary', 'bg-primary/5');
            } else {
                // Inactive state
                option.classList.remove('border-primary', 'bg-primary/5');
                option.classList.add('border-outline-variant');
            }
        });
    }

    // Set initial state based on checked radio
    updateActiveState();

    // Add click event to entire label
    reportTypeOptions.forEach(option => {
        option.addEventListener('click', function(e) {
            // Find radio in this option
            const radio = this.querySelector('input[type="radio"]');
            // Check this radio
            radio.checked = true;
            // Update all states
            updateActiveState();
        });
    });

    // Also listen to radio change events
    radioButtons.forEach(radio => {
        radio.addEventListener('change', updateActiveState);
    });
});

// Handle Image Preview
function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview-image').src = e.target.result;
            document.getElementById('upload-prompt').classList.add('hidden');
            document.getElementById('preview-container').classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    }
}
</script>
@endpush
@endsection
