@extends('layouts.app')

@section('title', 'Login - BarangTemu')

@section('content')
<div class="max-w-md mx-auto">
    <div class="bg-surface-container-lowest p-8 rounded-3xl border border-outline-variant shadow-lg">
        <div class="text-center space-y-2 mb-8">
            <div class="w-16 h-16 rounded-2xl bg-primary-container text-on-primary flex items-center justify-center shadow-md mx-auto">
                <span class="material-symbols-outlined text-4xl">login</span>
            </div>
            <h2 class="text-2xl font-bold text-on-surface">Selamat Datang Kembali</h2>
            <p class="text-sm text-outline">Login untuk melaporkan atau melacak barang Anda</p>
        </div>

        <form action="{{ route('login') }}" method="POST" class="space-y-5">
            @csrf

            <div class="space-y-2">
                <label for="email" class="text-sm font-semibold text-on-surface block">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                       class="w-full px-4 py-3 rounded-xl border border-outline-variant bg-surface-container-lowest focus:border-secondary focus:ring-2 focus:ring-secondary-fixed outline-none text-on-surface @error('email') border-error @enderror"
                       placeholder="nama@email.com"/>
                @error('email')
                    <p class="text-xs text-error mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="password" class="text-sm font-semibold text-on-surface block">Password</label>
                <input type="password" name="password" id="password" required
                       class="w-full px-4 py-3 rounded-xl border border-outline-variant bg-surface-container-lowest focus:border-secondary focus:ring-2 focus:ring-secondary-fixed outline-none text-on-surface @error('password') border-error @enderror"
                       placeholder="••••••••"/>
                @error('password')
                    <p class="text-xs text-error mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center">
                <input type="checkbox" name="remember" id="remember" class="rounded text-primary focus:ring-secondary"/>
                <label for="remember" class="ml-2 text-sm text-on-surface-variant">Ingat saya</label>
            </div>

            <button type="submit" class="w-full bg-primary-container text-on-primary text-sm font-bold px-6 py-3.5 rounded-xl shadow-md hover:bg-primary transition-all flex items-center justify-center gap-2">
                <span class="material-symbols-outlined">login</span>
                Login
            </button>
        </form>

        <div class="mt-6 text-center">
            <p class="text-sm text-outline">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-primary font-bold hover:underline">Daftar sekarang</a>
            </p>
        </div>
    </div>
</div>
@endsection
