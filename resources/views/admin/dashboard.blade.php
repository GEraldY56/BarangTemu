@extends('layouts.app')

@section('title', 'Dashboard Admin - BarangTemu')

@section('content')
<div class="space-y-8">
    <!-- Header Banner -->
    <div class="bg-surface-container-lowest rounded-3xl p-6 sm:p-8 border border-outline-variant shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div class="space-y-1">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary text-white text-xs">
                <span class="material-symbols-outlined text-sm">security</span>
                Melati & Ketertiban Sekolah
            </div>
            <h2 class="text-3xl font-bold text-on-surface">Panel Manajemen Laporan Barang</h2>
            <p class="text-sm text-outline">Kelola verifikasi, perbarui status kepemilikan, dan pantau serah terima barang siswa.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.export') }}" class="px-4 py-2.5 rounded-xl border border-outline-variant bg-surface-container-lowest hover:bg-surface-container text-on-surface text-sm font-bold flex items-center gap-2 shadow-sm transition-all">
                <span class="material-symbols-outlined text-base">download</span>
                Cetak Berita Acara
            </a>
            <a href="{{ route('reports.create') }}" class="bg-primary-container text-on-primary px-4 py-2.5 rounded-xl text-sm font-bold flex items-center gap-2 shadow-sm hover:opacity-95 transition-all">
                <span class="material-symbols-outlined text-base">add</span>
                Lapor Manual
            </a>
        </div>
    </div>

    <!-- Statistics -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
        <div class="bg-surface-container-lowest p-5 rounded-2xl border border-outline-variant shadow-sm">
            <div class="text-2xl font-bold text-on-surface">{{ $stats['total'] }}</div>
            <div class="text-xs text-outline">Total Laporan</div>
        </div>
        <div class="bg-surface-container-lowest p-5 rounded-2xl border border-outline-variant shadow-sm">
            <div class="text-2xl font-bold text-tertiary">{{ $stats['found'] }}</div>
            <div class="text-xs text-outline">Sudah Ditemukan</div>
        </div>
        <div class="bg-surface-container-lowest p-5 rounded-2xl border border-outline-variant shadow-sm">
            <div class="text-2xl font-bold text-secondary">{{ $stats['returned'] }}</div>
            <div class="text-xs text-outline">Sudah Dikembalikan</div>
        </div>
        <div class="bg-surface-container-lowest p-5 rounded-2xl border border-outline-variant shadow-sm">
            <div class="text-2xl font-bold text-error">{{ $stats['pending'] }}</div>
            <div class="text-xs text-outline">Belum Ditemukan</div>
        </div>
    </div>

    <!-- Filter Pills -->
    <div class="flex flex-wrap items-center gap-2">
        <span class="text-sm text-outline mr-2">Filter Cepat:</span>
        <a href="{{ route('admin.dashboard') }}" class="px-4 py-1.5 rounded-full text-xs font-semibold {{ !request('status') ? 'bg-primary text-white' : 'bg-surface-container text-on-surface-variant hover:bg-surface-container-high' }}">
            Semua
        </a>
        <a href="{{ route('admin.dashboard', ['status' => 'Belum Ditemukan']) }}" class="px-4 py-1.5 rounded-full text-xs font-semibold {{ request('status') == 'Belum Ditemukan' ? 'bg-primary text-white' : 'bg-surface-container text-on-surface-variant hover:bg-surface-container-high' }}">
            Belum Ditemukan
        </a>
        <a href="{{ route('admin.dashboard', ['status' => 'Sudah Ditemukan']) }}" class="px-4 py-1.5 rounded-full text-xs font-semibold {{ request('status') == 'Sudah Ditemukan' ? 'bg-primary text-white' : 'bg-surface-container text-on-surface-variant hover:bg-surface-container-high' }}">
            Sudah Ditemukan
        </a>
        <a href="{{ route('admin.dashboard', ['status' => 'Sudah Dikembalikan']) }}" class="px-4 py-1.5 rounded-full text-xs font-semibold {{ request('status') == 'Sudah Dikembalikan' ? 'bg-primary text-white' : 'bg-surface-container text-on-surface-variant hover:bg-surface-container-high' }}">
            Sudah Dikembalikan
        </a>
    </div>

    <!-- Admin Table -->
    <div class="bg-surface-container-lowest rounded-3xl border border-outline-variant shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-surface-container-low text-on-surface-variant text-xs font-semibold border-b border-outline-variant">
                        <th class="py-4 px-6">ID & Tanggal</th>
                        <th class="py-4 px-6">Pelapor & Kontak</th>
                        <th class="py-4 px-6">Barang & Kategori</th>
                        <th class="py-4 px-6">Jenis</th>
                        <th class="py-4 px-6">Status Saat Ini</th>
                        <th class="py-4 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant text-sm">
                    @forelse($reports as $report)
                    <tr class="hover:bg-surface-container-low transition-colors">
                        <td class="py-4 px-6">
                            <span class="font-bold text-on-surface block">#{{ $report->id }}</span>
                            <span class="text-outline text-xs block">{{ $report->report_date->format('d M Y') }}</span>
                        </td>
                        <td class="py-4 px-6">
                            <span class="font-bold text-on-surface block">{{ $report->reporter_name }}</span>
                            <span class="text-secondary text-xs block">{{ $report->reporter_contact }}</span>
                        </td>
                        <td class="py-4 px-6">
                            <span class="font-bold text-on-surface block">{{ $report->title }}</span>
                            <span class="text-outline text-xs block">{{ $report->category }} • {{ $report->location }}</span>
                        </td>
                        <td class="py-4 px-6">
                            <span class="px-2.5 py-1 rounded-full text-xs font-bold
                                @if($report->type == 'Barang Hilang') bg-error-container text-error
                                @else bg-secondary-fixed text-secondary
                                @endif">
                                {{ $report->type }}
                            </span>
                        </td>
                        <td class="py-4 px-6">
                            <form action="{{ route('admin.reports.updateStatus', $report->id) }}" method="POST">
                                @csrf
                                <select name="status" onchange="this.form.submit()" class="text-xs font-bold rounded-lg border border-outline-variant bg-surface-container-lowest px-2.5 py-1.5 focus:border-secondary outline-none">
                                    <option value="Belum Ditemukan" {{ $report->status == 'Belum Ditemukan' ? 'selected' : '' }}>Belum Ditemukan</option>
                                    <option value="Sudah Ditemukan" {{ $report->status == 'Sudah Ditemukan' ? 'selected' : '' }}>Sudah Ditemukan</option>
                                    <option value="Sudah Dikembalikan" {{ $report->status == 'Sudah Dikembalikan' ? 'selected' : '' }}>Sudah Dikembalikan</option>
                                </select>
                            </form>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('reports.show', $report->id) }}" class="p-1.5 rounded-lg text-primary hover:bg-surface-container" title="Lihat Detail">
                                    <span class="material-symbols-outlined text-lg">visibility</span>
                                </a>
                                <form action="{{ route('admin.reports.destroy', $report->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan #{{ $report->id }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 rounded-lg text-error hover:bg-error-container" title="Hapus Laporan">
                                        <span class="material-symbols-outlined text-lg">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-8 text-center text-outline">
                            <span class="material-symbols-outlined text-4xl">inbox</span>
                            <p class="mt-2">Belum ada laporan</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if($reports->hasPages())
    <div class="mt-6">
        {{ $reports->links() }}
    </div>
    @endif

    <!-- API Info Card -->
    <div class="bg-surface-container-low p-6 rounded-3xl border border-outline-variant space-y-4">
        <div class="flex items-center gap-2 text-primary font-bold text-base">
            <span class="material-symbols-outlined">integration_instructions</span>
            Arsitektur Integrasi RESTful API & MySQL Mapping
        </div>
        <p class="text-sm text-on-surface-variant">
            Struktur data reports siap dipetakan langsung ke tabel MySQL atau dihubungkan ke endpoint backend PHP/Laravel / Node.js Express.
        </p>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 font-mono text-xs">
            <div class="bg-surface-container-lowest p-3 rounded-xl border border-outline-variant">
                <span class="text-tertiary font-bold">GET</span> /api/reports<br/>
                <span class="text-outline text-[11px]">Ambil semua data laporan</span>
            </div>
            <div class="bg-surface-container-lowest p-3 rounded-xl border border-outline-variant">
                <span class="text-primary font-bold">POST</span> /api/reports<br/>
                <span class="text-outline text-[11px]">Simpan laporan baru</span>
            </div>
            <div class="bg-surface-container-lowest p-3 rounded-xl border border-outline-variant">
                <span class="text-secondary font-bold">PUT</span> /api/reports/:id<br/>
                <span class="text-outline text-[11px]">Perbarui status klaim</span>
            </div>
            <div class="bg-surface-container-lowest p-3 rounded-xl border border-outline-variant">
                <span class="text-error font-bold">DELETE</span> /api/reports/:id<br/>
                <span class="text-outline text-[11px]">Hapus arsip laporan</span>
            </div>
        </div>
    </div>
</div>
@endsection
