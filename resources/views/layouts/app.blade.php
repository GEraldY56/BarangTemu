<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'BarangTemu - Sistem Informasi Barang Hilang & Ditemukan Sekolah')</title>

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>

    <!-- Material Symbols Outlined -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

    <!-- Tailwind CSS v3 -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    <!-- Tailwind Config -->
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "primary": "#00236f",
                        "primary-container": "#1e3a8a",
                        "on-primary": "#ffffff",
                        "secondary": "#006398",
                        "secondary-container": "#5bb8fe",
                        "secondary-fixed": "#cce5ff",
                        "tertiary": "#00311f",
                        "tertiary-container": "#004a31",
                        "tertiary-fixed": "#6ffbbe",
                        "error": "#ba1a1a",
                        "error-container": "#ffdad6",
                        "background": "#faf8ff",
                        "surface": "#faf8ff",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-low": "#f2f3ff",
                        "surface-container": "#eaedff",
                        "on-surface": "#131b2e",
                        "on-surface-variant": "#444651",
                        "outline": "#757682",
                        "outline-variant": "#c5c5d3"
                    }
                }
            }
        }
    </script>

    @stack('styles')
</head>
<body class="bg-background text-on-surface font-body-md antialiased min-h-screen flex flex-col">

    <!-- Top Navigation -->
    <header class="sticky top-0 z-50 w-full bg-surface-container-lowest border-b border-outline-variant shadow-sm">
        <div class="max-w-7xl mx-auto px-6 py-3 flex items-center justify-between gap-4">
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <div class="w-12 h-12 flex-shrink-0">
                    <img src="{{ asset('images/logosmkn20.png') }}" alt="Logo SMKN 20 Jakarta" class="w-full h-full object-contain">
                </div>
                <div>
                    <span class="font-bold text-primary tracking-tight block text-lg">BarangTemu</span>
                    <span class="text-xs text-outline block">SMK Negeri 20 Jakarta</span>
                </div>
            </a>

            <!-- Navigation Links (Desktop) -->
            <nav class="hidden md:flex items-center gap-6">
                <a href="{{ route('home') }}" class="text-sm font-semibold {{ request()->routeIs('home') ? 'text-primary border-b-2 border-primary' : 'text-on-surface-variant hover:text-primary' }} pb-1 transition-colors">
                    Beranda
                </a>
                <a href="{{ route('catalog') }}" class="text-sm font-semibold {{ request()->routeIs('catalog') ? 'text-primary border-b-2 border-primary' : 'text-on-surface-variant hover:text-primary' }} pb-1 transition-colors">
                    Daftar Barang
                </a>
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="text-sm font-semibold {{ request()->routeIs('admin.*') ? 'text-primary border-b-2 border-primary' : 'text-on-surface-variant hover:text-primary' }} pb-1 transition-colors">
                            Dashboard Admin
                        </a>
                    @endif
                @endauth
            </nav>

            <!-- Trailing Actions -->
            <div class="flex items-center gap-3">
                @auth
                    <!-- User Profile -->
                    <div class="flex items-center gap-2 pl-2 border-l border-outline-variant">
                        <div class="w-8 h-8 rounded-full bg-secondary-container text-on-surface font-bold text-xs flex items-center justify-center">
                            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                        </div>
                        <div class="hidden lg:block text-left">
                            <span class="text-xs font-bold block text-on-surface">{{ auth()->user()->name }}</span>
                            <span class="text-[10px] text-outline block">{{ auth()->user()->class ?? ucfirst(auth()->user()->role) }}</span>
                        </div>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="w-8 h-8 rounded-xl flex items-center justify-center text-on-surface-variant hover:bg-surface-container transition-colors" title="Logout">
                                <span class="material-symbols-outlined text-lg">logout</span>
                            </button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-primary hover:underline">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="inline-flex items-center gap-2 bg-primary-container text-on-primary text-sm font-bold px-4 py-2 rounded-xl shadow-sm hover:opacity-95 transition-all">
                        Register
                    </a>
                @endauth
            </div>
        </div>

        <!-- Mobile Sub-Navigation -->
        @auth
        <div class="flex md:hidden border-t border-outline-variant px-4 py-2 justify-around bg-surface-container-low text-xs">
            <a href="{{ route('home') }}" class="flex flex-col items-center py-1 {{ request()->routeIs('home') ? 'text-primary font-bold' : 'text-on-surface-variant' }}">
                <span class="material-symbols-outlined text-lg">home</span>
                Beranda
            </a>
            <a href="{{ route('catalog') }}" class="flex flex-col items-center py-1 {{ request()->routeIs('catalog') ? 'text-primary font-bold' : 'text-on-surface-variant' }}">
                <span class="material-symbols-outlined text-lg">manage_search</span>
                Daftar
            </a>
            <a href="{{ route('reports.create') }}" class="flex flex-col items-center py-1 {{ request()->routeIs('reports.create') ? 'text-primary font-bold' : 'text-on-surface-variant' }}">
                <span class="material-symbols-outlined text-lg">edit_document</span>
                Lapor
            </a>
            @if(auth()->user()->isAdmin())
            <a href="{{ route('admin.dashboard') }}" class="flex flex-col items-center py-1 {{ request()->routeIs('admin.*') ? 'text-primary font-bold' : 'text-on-surface-variant' }}">
                <span class="material-symbols-outlined text-lg">admin_panel_settings</span>
                Admin
            </a>
            @endif
        </div>
        @endif
    </header>

    <!-- Flash Messages -->
    @if(session('success') || session('error') || session('info'))
    <div class="fixed top-20 right-6 z-50 transform transition-all duration-300" id="flash-message">
        <div class="bg-primary text-on-primary px-5 py-3 rounded-xl shadow-lg flex items-center gap-3 border border-outline-variant">
            <span class="material-symbols-outlined">
                @if(session('success')) check_circle @elseif(session('error')) error @else info @endif
            </span>
            <span class="text-sm font-semibold">
                {{ session('success') ?? session('error') ?? session('info') }}
            </span>
        </div>
    </div>
    <script>
        setTimeout(() => {
            const flash = document.getElementById('flash-message');
            if (flash) {
                flash.style.opacity = '0';
                flash.style.transform = 'translateY(-100%)';
                setTimeout(() => flash.remove(), 300);
            }
        }, 3500);
    </script>
    @endif

    <!-- Main Content -->
    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 py-6 sm:py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="w-full bg-surface-container border-t border-outline-variant mt-auto">
        <div class="max-w-7xl mx-auto py-8 px-6 flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="space-y-1 text-center md:text-left">
                <div class="font-bold text-primary text-base">BarangTemu Sekolah</div>
                <p class="text-xs text-on-surface-variant">
                    © 2024 BarangTemu Sekolah. Sistem Pelaporan Barang Hilang & Temuan.
                </p>
            </div>
            <div class="flex flex-wrap items-center justify-center gap-6 text-xs text-on-surface-variant">
                <a href="#" class="hover:text-secondary transition-colors">Panduan Siswa</a>
                <a href="#" class="hover:text-secondary transition-colors">Kebijakan Pengambilan</a>
                <a href="#" class="hover:text-secondary transition-colors">Pusat Informasi Sarpras</a>
                <a href="#" class="hover:text-secondary transition-colors">Kontak Admin</a>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
