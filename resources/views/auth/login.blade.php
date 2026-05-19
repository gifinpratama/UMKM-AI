{{--
    Tujuan     : Halaman login — Neubrutalism style
    Caller     : routes/web.php → AuthController@showLogin
--}}
@extends('layouts.landing')

@section('title', 'Masuk - UMKM.AI')

@section('content')
<div style="min-height:100vh;background:var(--color-bg-base);background-image:radial-gradient(circle,#00000015 1px,transparent 1px);background-size:24px 24px;display:flex;align-items:center;justify-content:center;padding:24px 16px;">

    <div style="width:100%;max-width:440px;">

        {{-- Logo / Header --}}
        <div style="text-align:center;margin-bottom:28px;">
            <div style="display:inline-flex;align-items:center;gap:12px;padding:12px 20px;background:var(--color-orange);border:4px solid #000;box-shadow:var(--nb-shadow-lg);border-radius:6px;margin-bottom:20px;">
                <svg width="28" height="28" fill="none" stroke="#000" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                <span style="font-family:var(--font-display);font-size:26px;font-weight:800;color:#000;letter-spacing:-0.5px;">UMKM.AI</span>
            </div>
            <h1 style="font-family:var(--font-display);font-size:28px;font-weight:800;color:#000;margin:0 0 6px;letter-spacing:-0.5px;">Selamat Datang!</h1>
            <p style="font-family:var(--font-body);font-size:13px;color:#555;margin:0;">Masuk ke akun UMKM.AI kamu</p>
        </div>

        {{-- Card --}}
        <div style="background:#fff;border:4px solid #000;border-radius:6px;box-shadow:var(--nb-shadow-xl);padding:32px;">

            {{-- Error --}}
            @if($errors->any())
            <div class="alert alert-error">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ $errors->first() }}
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-error">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('error') }}
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}" style="display:flex;flex-direction:column;gap:18px;">
                @csrf

                {{-- Email --}}
                <div>
                    <label for="email" class="form-label">📧 Alamat Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                        class="form-input {{ $errors->has('email') ? 'error' : '' }}"
                        placeholder="kamu@bisnis.com" required autofocus>
                    @error('email')<p class="form-error">⚠ {{ $message }}</p>@enderror
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="form-label">🔒 Kata Sandi</label>
                    <input id="password" type="password" name="password"
                        class="form-input {{ $errors->has('password') ? 'error' : '' }}"
                        placeholder="••••••••" required>
                    @error('password')<p class="form-error">⚠ {{ $message }}</p>@enderror
                </div>

                {{-- Remember --}}
                <div style="display:flex;align-items:center;gap:8px;">
                    <input id="remember" type="checkbox" name="remember"
                        style="width:18px;height:18px;border:3px solid #000;border-radius:3px;accent-color:var(--color-orange);cursor:pointer;">
                    <label for="remember" style="font-family:var(--font-body);font-size:13px;color:#333;cursor:pointer;font-weight:700;">Ingat saya</label>
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn-primary" style="width:100%;justify-content:center;font-size:15px;padding:12px 20px;">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                    Masuk Sekarang
                </button>
            </form>

            {{-- Divider --}}
            <div style="display:flex;align-items:center;gap:12px;margin:20px 0;">
                <div style="flex:1;height:3px;background:#000;"></div>
                <span style="font-family:var(--font-display);font-size:12px;font-weight:800;color:#000;">ATAU</span>
                <div style="flex:1;height:3px;background:#000;"></div>
            </div>

            {{-- Register link --}}
            <a href="{{ route('register') }}" class="btn-secondary" style="width:100%;justify-content:center;font-size:15px;padding:12px 20px;">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                Daftar Akun Baru
            </a>
        </div>

        {{-- Footer --}}
        <p style="text-align:center;font-family:var(--font-body);font-size:11px;color:#777;margin-top:20px;font-weight:700;">
            © {{ date('Y') }} UMKM.AI — Platform Analisis Bisnis UMKM
        </p>
    </div>
</div>
@endsection
