@extends('layouts.app')

@section('title', 'Daftar Barang - BarangTemu')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="space-y-6">
        <div>
            <h2 class="text-3xl font-bold text-on-surface">Daftar Barang Hilang & Ditemukan</h2>
            <p class="text-sm text-outline">Gunakan pencarian instan dan filter multi-kategori untuk menemukan barang Anda.</p>
        </div>

        <!-- Search Bar -->
        <form action="{{ route('catalog') }}" method="GET" id="filterForm">
            <div class="relative">
                <span class="material-symbols-outlined absolute left-4 top-3.5 text-2xl text-outline">search</span>
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    class="w-full pl-12 pr-4 py-3.5 rounded-2xl border border-outline-variant bg-surface-container-lowest focus:border-secondary focus:ring-4 focus:ring-secondary-fixed/50 outline-none text-on-surface shadow-sm transition-all"
                    placeholder="Cari nama barang, ciri khusus, atau lokasi (misal: Casio, Jaket, Ruang Piket)..."
                />
            </div>

            <!-- Filters -->
            <div class="flex flex-wrap items-center gap-3 mt-4">
                <select name="category" onchange="document.getElementById('filterForm').submit()" class="px-4 py-2 rounded-xl border border-outline-variant bg-surface-container-lowest text-on-surface text-sm focus:border-secondary outline-none shadow-sm">
                    <option value="Semua" {{ request('category') == 'Semua' ? 'selected' : '' }}>Semua Kategori</option>
                    <option value="Elektronik & Gadget" {{ request('category') == 'Elektronik & Gadget' ? 'selected' : '' }}>Elektronik & Gadget</option>
                    <option value="Alat Tulis & Buku" {{ request('category') == 'Alat Tulis & Buku' ? 'selected' : '' }}>Alat Tulis & Buku</option>
                    <option value="Pakaian & Jaket" {{ request('category') == 'Pakaian & Jaket' ? 'selected' : '' }}>Pakaian & Jaket</option>
                    <option value="Identitas & Kartu" {{ request('category') == 'Identitas & Kartu' ? 'selected' : '' }}>Identitas & Kartu</option>
                    <option value="Kunci & Aksesoris" {{ request('category') == 'Kunci & Aksesoris' ? 'selected' : '' }}>Kunci & Aksesoris</option>
                    <option value="Lainnya" {{ request('category') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>

                <select name="status" onchange="document.getElementById('filterForm').submit()" class="px-4 py-2 rounded-xl border border-outline-variant bg-surface-container-lowest text-on-surface text-sm focus:border-secondary outline-none shadow-sm">
                    <option value="Semua" {{ request('status') == 'Semua' ? 'selected' : '' }}>Semua Status</option>
                    <option value="Belum Ditemukan" {{ request('status') == 'Belum Ditemukan' ? 'selected' : '' }}>Belum Ditemukan</option>
                    <option value="Sudah Ditemukan" {{ request('status') == 'Sudah Ditemukan' ? 'selected' : '' }}>Sudah Ditemukan</option>
                    <option value="Sudah Dikembalikan" {{ request('status') == 'Sudah Dikembalikan' ? 'selected' : '' }}>Sudah Dikembalikan</option>
                </select>

                <select name="type" onchange="document.getElementById('filterForm').submit()" class="px-4 py-2 rounded-xl border border-outline-variant bg-surface-container-lowest text-on-surface text-sm focus:border-secondary outline-none shadow-sm">
                    <option value="Semua" {{ request('type') == 'Semua' ? 'selected' : '' }}>Semua Jenis Laporan</option>
                    <option value="Barang Hilang" {{ request('type') == 'Barang Hilang' ? 'selected' : '' }}>Barang Hilang</option>
                    <option value="Barang Temuan" {{ request('type') == 'Barang Temuan' ? 'selected' : '' }}>Barang Temuan</option>
                </select>

                @if(request()->hasAny(['search', 'category', 'status', 'type']))
                <a href="{{ route('catalog') }}" class="px-3 py-2 rounded-xl text-outline hover:text-primary text-sm flex items-center gap-1">
                    <span class="material-symbols-outlined text-sm">refresh</span>
                    Reset Filter
                </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Results -->
    @if($reports->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($reports as $report)
            <div class="bg-surface-container-lowest rounded-2xl border border-outline-variant shadow-sm overflow-hidden flex flex-col hover:shadow-md transition-all group">
                <div class="relative h-48 overflow-hidden bg-surface-container">
                    @if($report->image_path)
                        <img src="{{ asset('storage/' . $report->image_path) }}" alt="{{ $report->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-outline">
                            <span class="material-symbols-outlined text-6xl">image</span>
                        </div>
                    @endif
                    <div class="absolute top-3 left-3 flex gap-1.5 flex-wrap">
                        <span class="px-2.5 py-1 rounded-full text-xs font-bold shadow-sm
                            @if($report->status == 'Belum Ditemukan') bg-amber-100 text-amber-800 border border-amber-300
                            @elseif($report->status == 'Sudah Ditemukan') bg-emerald-100 text-emerald-800 border border-emerald-300
                            @else bg-indigo-100 text-indigo-800 border border-indigo-300
                            @endif">
                            {{ $report->status }}
                        </span>
                        <span class="px-2.5 py-1 rounded-full text-xs font-bold shadow-sm
                            @if($report->type == 'Barang Hilang') bg-error-container text-error
                            @else bg-secondary-fixed text-secondary
                            @endif">
                            {{ $report->type }}
                        </span>
                    </div>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                    <div class="space-y-2">
                        <div class="text-xs text-secondary font-bold">{{ $report->category }}</div>
                        <h3 class="font-bold text-on-surface leading-tight">{{ $report->title }}</h3>
                        <p class="text-sm text-on-surface-variant line-clamp-2">{{ Str::limit($report->description, 80) }}</p>

                        <div class="pt-2 space-y-1 text-outline text-sm">
                            <div class="flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-sm">location_on</span>
                                <span class="line-clamp-1">{{ $report->location }}</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-sm">calendar_today</span>
                                <span>{{ $report->report_date->format('d M Y') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="pt-3 border-t border-outline-variant flex items-center justify-between">
                        <span class="text-xs text-outline">ID: #{{ $report->id }}</span>
                        <a href="{{ route('reports.show', $report->id) }}" class="bg-surface-container hover:bg-primary hover:text-white text-primary text-sm font-bold px-4 py-2 rounded-xl transition-all">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $reports->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="text-center py-16 space-y-4">
            <div class="w-20 h-20 rounded-full bg-surface-container mx-auto flex items-center justify-center text-outline">
                <span class="material-symbols-outlined text-4xl">find_in_page</span>
            </div>
            <h3 class="text-xl font-bold text-on-surface">Tidak Ditemukan Barang yang Cocok</h3>
            <p class="text-sm text-outline max-w-md mx-auto">Coba gunakan kata kunci pencarian yang berbeda atau periksa filter yang sedang aktif.</p>
            <a href="{{ route('catalog') }}" class="inline-block bg-primary-container text-on-primary text-sm font-bold px-6 py-2.5 rounded-xl">
                Tampilkan Semua Barang
            </a>
        </div>
    @endif
</div>
@endsection
