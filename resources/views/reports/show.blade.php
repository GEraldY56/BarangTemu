@extends('layouts.app')

@section('title', $report->title . ' - BarangTemu')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-surface-container-lowest rounded-3xl shadow-lg border border-outline-variant overflow-hidden">
        <!-- Header -->
        <div class="flex items-center justify-between p-6 border-b border-outline-variant bg-surface-container-low">
            <div class="flex items-center gap-2">
                <span class="px-3 py-1 rounded-full text-xs font-bold
                    @if($report->type == 'Barang Hilang') bg-error-container text-error
                    @else bg-secondary-fixed text-secondary
                    @endif">
                    {{ $report->type }}
                </span>
                <span class="px-3 py-1 rounded-full text-xs font-bold
                    @if($report->status == 'Belum Ditemukan') bg-amber-100 text-amber-800 border border-amber-300
                    @elseif($report->status == 'Sudah Ditemukan') bg-emerald-100 text-emerald-800 border border-emerald-300
                    @else bg-indigo-100 text-indigo-800 border border-indigo-300
                    @endif">
                    {{ $report->status }}
                </span>
            </div>
            <a href="{{ route('catalog') }}" class="w-8 h-8 rounded-full flex items-center justify-center text-outline hover:text-on-surface hover:bg-surface-container transition-colors">
                <span class="material-symbols-outlined text-lg">close</span>
            </a>
        </div>

        <!-- Body -->
        <div class="p-6 space-y-6">
            <div class="flex flex-col sm:flex-row gap-6">
                @if($report->image_path)
                    <img src="{{ asset('storage/' . $report->image_path) }}" alt="{{ $report->title }}" class="w-full sm:w-48 h-48 object-cover rounded-2xl border border-outline-variant shadow-sm flex-shrink-0">
                @else
                    <div class="w-full sm:w-48 h-48 rounded-2xl border border-outline-variant shadow-sm flex-shrink-0 flex items-center justify-center bg-surface-container text-outline">
                        <span class="material-symbols-outlined text-6xl">image</span>
                    </div>
                @endif

                <div class="space-y-3 flex-1">
                    <h3 class="text-2xl font-bold text-on-surface">{{ $report->title }}</h3>
                    <div class="flex items-center gap-2 text-outline text-sm">
                        <span class="material-symbols-outlined text-base">category</span>
                        <span>{{ $report->category }}</span>
                    </div>
                    <div class="flex items-center gap-2 text-outline text-sm">
                        <span class="material-symbols-outlined text-base">location_on</span>
                        <span>{{ $report->location }}</span>
                    </div>
                    <div class="flex items-center gap-2 text-outline text-sm">
                        <span class="material-symbols-outlined text-base">event</span>
                        <span>{{ $report->report_date->format('d F Y') }}{{ $report->report_time ? ', ' . $report->report_time->format('H:i') : '' }}</span>
                    </div>
                </div>
            </div>

            <div class="space-y-2">
                <h4 class="font-bold text-on-surface">Ciri-Ciri Khusus & Kondisi</h4>
                <p class="text-sm text-on-surface-variant bg-surface-container-low p-4 rounded-xl border border-outline-variant leading-relaxed">
                    {{ $report->description }}
                </p>
            </div>

            <!-- Storage Info -->
            <div class="bg-secondary-fixed/20 p-4 rounded-2xl border border-secondary-container/40 flex items-start gap-3">
                <span class="material-symbols-outlined text-secondary text-2xl flex-shrink-0">inventory_2</span>
                <div>
                    <div class="text-sm font-bold text-on-surface">Lokasi Penyimpanan Sementara:</div>
                    <div class="text-sm text-on-surface-variant">Ruang Tata Usaha.</div>
                </div>
            </div>

            <!-- Reporter Contact -->
            <div class="border-t border-outline-variant pt-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <span class="text-xs text-outline block">Pelapor / Penemu:</span>
                    <span class="text-sm font-bold text-on-surface">{{ $report->reporter_name }} ({{ $report->reporter_class }})</span>
                </div>
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $report->reporter_contact) }}?text=Halo%20{{ urlencode($report->reporter_name) }},%20saya%20menghubungi%20terkait%20laporan%20BarangTemu%20'{{ urlencode($report->title) }}'"
                   target="_blank"
                   class="inline-flex items-center justify-center gap-2 bg-tertiary-container hover:opacity-90 px-5 py-2.5 rounded-xl text-sm font-bold transition-all text-white">
                    <span class="material-symbols-outlined text-base">chat</span>
                    Hubungi WhatsApp Pelapor
                </a>
            </div>

            <!-- Action Buttons for Owner -->
            @auth
                @if($report->user_id === auth()->id() || auth()->user()->isAdmin())
                <div class="flex gap-3 pt-4 border-t border-outline-variant">
                    <a href="{{ route('reports.edit', $report->id) }}" class="flex-1 inline-flex items-center justify-center gap-2 bg-primary-container text-on-primary text-sm font-bold px-4 py-2.5 rounded-xl hover:opacity-95 transition-all">
                        <span class="material-symbols-outlined text-base">edit</span>
                        Edit Laporan
                    </a>
                    <form action="{{ route('reports.destroy', $report->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full inline-flex items-center justify-center gap-2 bg-error-container text-error text-sm font-bold px-4 py-2.5 rounded-xl hover:opacity-95 transition-all">
                            <span class="material-symbols-outlined text-base">delete</span>
                            Hapus Laporan
                        </button>
                    </form>
                </div>
                @endif
            @endauth
        </div>
    </div>
</div>
@endsection
