@extends('layouts.app')

@section('title', 'Beranda - BarangTemu')

@section('content')
<div class="space-y-12">
    <!-- Hero Banner -->
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-primary via-primary-container to-secondary text-on-primary p-8 sm:p-12 shadow-xl">
        <div class="relative z-10 max-w-2xl space-y-5">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/15 backdrop-blur-md border border-white/20 text-white text-xs">
                <span class="material-symbols-outlined text-sm">verified</span>
                Sistem Resmi Pelaporan Barang Terintegrasi Sekolah
            </div>
            <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-white leading-tight">
                Temukan Kembali Barang Berhargamu di Sekolah
            </h1>
            <p class="text-base text-white/90 max-w-xl">
                Kehilangan tempat pensil, kalkulator, atau jaket almamater? Jangan cemas. Laporkan rinciannya sekarang atau telusuri koleksi barang temuan di ruang sarpras & piket.
            </p>
            <div class="pt-2 flex flex-wrap items-center gap-4">
                @auth
                    <a href="{{ route('reports.create') }}" class="bg-white text-primary text-sm font-bold px-6 py-3.5 rounded-xl shadow-md hover:bg-gray-100 transition-all flex items-center gap-2">
                        <span class="material-symbols-outlined">add_circle</span>
                        Laporkan Barang Sekarang
                    </a>
                @else
                    <a href="{{ route('login') }}" class="bg-white text-primary text-sm font-bold px-6 py-3.5 rounded-xl shadow-md hover:bg-gray-100 transition-all flex items-center gap-2">
                        <span class="material-symbols-outlined">add_circle</span>
                        Laporkan Barang Sekarang
                    </a>
                @endauth
                <a href="{{ route('catalog') }}" class="bg-primary/40 hover:bg-primary/60 text-white border border-white/30 text-sm font-bold px-6 py-3.5 rounded-xl backdrop-blur-sm transition-all flex items-center gap-2">
                    <span class="material-symbols-outlined">search</span>
                    Cari di Daftar Temuan
                </a>
            </div>
        </div>
        <!-- Decorative Icon -->
        <div class="absolute -right-8 -bottom-10 opacity-10 pointer-events-none hidden sm:block">
            <span class="material-symbols-outlined text-[320px] text-white">shield</span>
        </div>
    </div>

    <!-- Real-time Stats Grid -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
        <div class="bg-surface-container-lowest p-5 rounded-2xl border border-outline-variant shadow-sm flex items-center gap-4 hover:shadow-md transition-shadow">
            <div class="w-12 h-12 rounded-xl bg-surface-container text-primary flex items-center justify-center">
                <span class="material-symbols-outlined text-2xl">assignment</span>
            </div>
            <div>
                <div class="text-2xl font-bold text-on-surface">{{ $stats['total'] }}</div>
                <div class="text-xs text-outline">Total Laporan Aktif</div>
            </div>
        </div>
        <div class="bg-surface-container-lowest p-5 rounded-2xl border border-outline-variant shadow-sm flex items-center gap-4 hover:shadow-md transition-shadow">
            <div class="w-12 h-12 rounded-xl bg-tertiary-fixed text-tertiary flex items-center justify-center">
                <span class="material-symbols-outlined text-2xl">check_circle</span>
            </div>
            <div>
                <div class="text-2xl font-bold text-tertiary">{{ $stats['found'] }}</div>
                <div class="text-xs text-outline">Barang Ditemukan</div>
            </div>
        </div>
        <div class="bg-surface-container-lowest p-5 rounded-2xl border border-outline-variant shadow-sm flex items-center gap-4 hover:shadow-md transition-shadow">
            <div class="w-12 h-12 rounded-xl bg-secondary-fixed text-secondary flex items-center justify-center">
                <span class="material-symbols-outlined text-2xl">handshake</span>
            </div>
            <div>
                <div class="text-2xl font-bold text-secondary">{{ $stats['returned'] }}</div>
                <div class="text-xs text-outline">Sudah Dikembalikan</div>
            </div>
        </div>
        <div class="bg-surface-container-lowest p-5 rounded-2xl border border-outline-variant shadow-sm flex items-center gap-4 hover:shadow-md transition-shadow">
            <div class="w-12 h-12 rounded-xl bg-error-container text-error flex items-center justify-center">
                <span class="material-symbols-outlined text-2xl">pending_actions</span>
            </div>
            <div>
                <div class="text-2xl font-bold text-error">{{ $stats['pending'] }}</div>
                <div class="text-xs text-outline">Menunggu Klaim Pemilik</div>
            </div>
        </div>
    </div>

    <!-- Recent Reports -->
    <div class="space-y-5">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-bold text-on-surface">Barang Baru Dilaporkan</h2>
                <p class="text-sm text-outline">Laporan terkini 24 jam terakhir di lingkungan sekolah</p>
            </div>
            <a href="{{ route('catalog') }}" class="text-sm text-primary font-bold hover:underline flex items-center gap-1">
                Lihat Semua Barang
                <span class="material-symbols-outlined text-base">arrow_forward</span>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($recentReports as $report)
            <div class="bg-surface-container-lowest rounded-2xl border border-outline-variant shadow-sm overflow-hidden flex flex-col hover:shadow-md transition-all">
                <div class="relative h-44 overflow-hidden bg-surface-container">
                    @if($report->image_path)
                        <img src="{{ asset('storage/' . $report->image_path) }}" alt="{{ $report->title }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-outline">
                            <span class="material-symbols-outlined text-6xl">image</span>
                        </div>
                    @endif
                    <div class="absolute top-3 left-3 flex gap-1.5 flex-wrap">
                        <span class="px-2.5 py-1 rounded-full text-xs font-bold
                            @if($report->status == 'Belum Ditemukan') bg-amber-100 text-amber-800 border border-amber-300
                            @elseif($report->status == 'Sudah Ditemukan') bg-emerald-100 text-emerald-800 border border-emerald-300
                            @else bg-indigo-100 text-indigo-800 border border-indigo-300
                            @endif">
                            {{ $report->status }}
                        </span>
                    </div>
                </div>
                <div class="p-4 flex-1 flex flex-col justify-between space-y-3">
                    <div>
                        <h3 class="font-bold text-on-surface line-clamp-1">{{ $report->title }}</h3>
                        <p class="text-sm text-outline flex items-center gap-1 mt-1">
                            <span class="material-symbols-outlined text-sm">location_on</span>
                            {{ $report->location }}
                        </p>
                    </div>
                    <div class="flex items-center justify-between pt-2 border-t border-outline-variant">
                        <span class="text-xs text-outline">{{ $report->report_date->format('d M Y') }}</span>
                        <a href="{{ route('reports.show', $report->id) }}" class="text-primary text-sm font-bold hover:underline">
                            Detail
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-8 text-outline">
                <span class="material-symbols-outlined text-4xl">inbox</span>
                <p class="mt-2">Belum ada laporan</p>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Procedure Guide -->
    <div class="bg-surface-container-low rounded-3xl p-8 border border-outline-variant">
        <div class="text-center max-w-xl mx-auto space-y-2 mb-8">
            <h2 class="text-xl font-bold text-on-surface">Panduan 3 Langkah Pengambilan Barang</h2>
            <p class="text-sm text-on-surface-variant">Ikuti prosedur verifikasi resmi agar barang diserahkan dengan aman dan transparan.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-surface-container-lowest p-6 rounded-2xl border border-outline-variant shadow-sm">
                <div class="w-10 h-10 rounded-full bg-primary text-white font-bold flex items-center justify-center mb-4">1</div>
                <h3 class="font-bold text-on-surface mb-2">Cek Katalog atau Laporkan</h3>
                <p class="text-sm text-on-surface-variant">Cari barang yang sesuai pada daftar atau buat pelaporan kehilangan jika barang belum tercantum di sistem.</p>
            </div>
            <div class="bg-surface-container-lowest p-6 rounded-2xl border border-outline-variant shadow-sm">
                <div class="w-10 h-10 rounded-full bg-secondary text-white font-bold flex items-center justify-center mb-4">2</div>
                <h3 class="font-bold text-on-surface mb-2">Verifikasi Bukti & Ciri</h3>
                <p class="text-sm text-on-surface-variant">Bawa tanda pengenal siswa (Kartu OSIS) dan sebutkan ciri spesifik seperti isi dompet, goresan, atau sandi perangkat.</p>
            </div>
            <div class="bg-surface-container-lowest p-6 rounded-2xl border border-outline-variant shadow-sm">
                <div class="w-10 h-10 rounded-full bg-tertiary-fixed text-tertiary font-bold flex items-center justify-center mb-4">3</div>
                <h3 class="font-bold text-on-surface mb-2">Serah Terima di Sarpras</h3>
                <p class="text-sm text-on-surface-variant">Temui petugas di Ruang Piket / Sarpras untuk menandatangani berita acara penyerahan fisik barang.</p>
            </div>
        </div>
    </div>
</div>
@endsection
