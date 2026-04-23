@extends('layouts.landing')

@section('title', 'Masuk - UMKM.AI')

@section('content')
<div class="min-h-screen flex items-center justify-center px-6 relative">
    {{-- Background --}}
    <div class="absolute w-[500px] h-[500px] rounded-full bg-indigo-600/15 blur-[120px] -top-40 -left-40"></div>
    <div class="absolute w-[400px] h-[400px] rounded-full bg-purple-600/10 blur-[100px] -bottom-40 -right-40"></div>

    <div class="w-full max-w-md relative z-10">
        {{-- Logo --}}
        <div class="text-center mb-8">
            <a href="{{ route('landing') }}" class="inline-flex items-center gap-3 mb-6">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center shadow-lg shadow-indigo-500/25">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <span class="text-2xl font-bold gradient-text">UMKM.AI</span>
            </a>
            <h1 class="text-2xl font-bold text-white mb-2">Selamat Datang Kembali</h1>
            <p class="text-sm text-dark-400">Masuk ke dashboard untuk mengelola bisnis Anda</p>
        </div>

        {{-- Login Form --}}
        <div class="glass-card p-8" id="login-card">
            @if($errors->any())
            <div class="mb-4 p-3 rounded-lg bg-red-500/10 border border-red-500/20 text-red-400 text-sm">
                {{ $errors->first() }}
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf
                <div>
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-input" placeholder="nama@email.com" required autofocus>
                </div>

                <div>
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-input" placeholder="••••••••" required>
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded border-dark-600 bg-dark-800 text-indigo-500 focus:ring-indigo-500">
                        <span class="text-sm text-dark-400">Ingat saya</span>
                    </label>
                </div>

                <button type="submit" class="btn-primary w-full justify-center py-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                    Masuk
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-sm text-dark-500">Belum punya akun? <a href="{{ route('register') }}" class="text-indigo-400 hover:text-indigo-300 font-medium">Daftar Gratis</a></p>
            </div>
        </div>

        {{-- Demo Accounts --}}
        <div class="mt-6 glass-card p-4">
            <p class="text-xs text-dark-500 mb-3 text-center font-semibold">AKUN DEMO</p>
            <div class="grid grid-cols-2 gap-3">
                <button onclick="fillDemo('admin@umkm.ai', 'password')" class="p-2.5 rounded-lg bg-white/[0.03] border border-white/5 hover:border-indigo-500/30 transition text-center cursor-pointer">
                    <p class="text-xs font-semibold text-indigo-400">Admin</p>
                    <p class="text-[10px] text-dark-500">admin@umkm.ai</p>
                </button>
                <button onclick="fillDemo('seller@umkm.ai', 'password')" class="p-2.5 rounded-lg bg-white/[0.03] border border-white/5 hover:border-emerald-500/30 transition text-center cursor-pointer">
                    <p class="text-xs font-semibold text-emerald-400">Seller</p>
                    <p class="text-[10px] text-dark-500">seller@umkm.ai</p>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function fillDemo(email, password) {
    document.querySelector('input[name="email"]').value = email;
    document.querySelector('input[name="password"]').value = password;
    anime({
        targets: '#login-card',
        scale: [1, 1.02, 1],
        duration: 400,
        easing: 'easeInOutQuad'
    });
}

document.addEventListener('DOMContentLoaded', () => {
    anime({
        targets: '#login-card',
        opacity: [0, 1],
        translateY: [30, 0],
        scale: [0.95, 1],
        duration: 800,
        easing: 'easeOutCubic',
    });
});
</script>
@endpush
