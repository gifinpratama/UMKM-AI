{{--
    Tujuan     : Halaman register — Neubrutalism style
    Caller     : routes/web.php → AuthController@showRegister
--}}
@extends('layouts.landing')

@section('title', 'Daftar - UMKM-AI')

@section('content')
<div style="min-height:100vh;background:var(--color-bg-base);background-image:radial-gradient(circle,#00000015 1px,transparent 1px);background-size:24px 24px;display:flex;align-items:center;justify-content:center;padding:32px 16px;" id="register-card">

    <div style="width:100%;max-width:560px;">

        {{-- Logo --}}
        <div style="text-align:center;margin-bottom:24px;">
            <a href="{{ route('landing') }}" style="display:inline-flex;align-items:center;gap:12px;padding:10px 18px;background:var(--color-orange);border:4px solid #000;box-shadow:var(--nb-shadow-lg);border-radius:6px;margin-bottom:16px;text-decoration:none;">
                <svg width="24" height="24" fill="none" stroke="#000" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                <span style="font-family:var(--font-display);font-size:22px;font-weight:800;color:#000;">UMKM-AI</span>
            </a>
            <h1 style="font-family:var(--font-display);font-size:28px;font-weight:800;color:#000;margin:0 0 6px;letter-spacing:-0.5px;">Buat Akun Baru</h1>
            <p style="font-family:var(--font-body);font-size:13px;color:#555;margin:0;">Daftarkan bisnis UMKM kamu dan mulai analisis dengan AI 🚀</p>
        </div>

        {{-- Card --}}
        <div style="background:#fff;border:4px solid #000;border-radius:6px;box-shadow:var(--nb-shadow-xl);padding:28px 32px;">

            {{-- Errors --}}
            @if($errors->any())
            <div class="alert alert-error">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="flex-shrink:0;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <ul style="margin:0;padding:0;list-style:none;display:flex;flex-direction:column;gap:2px;">
                    @foreach($errors->all() as $error)<li>⚠ {{ $error }}</li>@endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('register') }}" style="display:flex;flex-direction:column;gap:16px;">
                @csrf

                {{-- Nama + Email --}}
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                    <div>
                        <label class="form-label">👤 Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-input {{ $errors->has('name') ? 'error' : '' }}" placeholder="John Doe" required autofocus>
                        @error('name')<p class="form-error">⚠ {{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="form-label">📧 Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-input {{ $errors->has('email') ? 'error' : '' }}" placeholder="nama@email.com" required>
                        @error('email')<p class="form-error">⚠ {{ $message }}</p>@enderror
                    </div>
                </div>

                {{-- Nama Bisnis + Jenis --}}
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                    <div>
                        <label class="form-label">🏪 Nama Bisnis</label>
                        <input type="text" name="business_name" value="{{ old('business_name') }}" class="form-input {{ $errors->has('business_name') ? 'error' : '' }}" placeholder="Toko Jaya Abadi" required>
                        @error('business_name')<p class="form-error">⚠ {{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="form-label">📦 Jenis Bisnis</label>
                        <select name="business_type" class="form-input {{ $errors->has('business_type') ? 'error' : '' }}" required>
                            <option value="">Pilih jenis...</option>
                            @foreach(['Makanan & Minuman','Fashion','Elektronik','Kerajinan','Jasa','Pertanian','Lainnya'] as $type)
                            <option value="{{ $type }}" {{ old('business_type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                            @endforeach
                        </select>
                        @error('business_type')<p class="form-error">⚠ {{ $message }}</p>@enderror
                    </div>
                </div>

                {{-- Telepon --}}
                <div>
                    <label class="form-label">📱 No. Telepon <span style="font-weight:400;color:#777;">(opsional)</span></label>
                    <input type="text" name="phone" value="{{ old('phone') }}" class="form-input" placeholder="08123456789">
                </div>

                {{-- Password --}}
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                    <div>
                        <label class="form-label">🔒 Kata Sandi</label>
                        <input type="password" name="password" class="form-input {{ $errors->has('password') ? 'error' : '' }}" placeholder="Min. 8 karakter" required>
                        @error('password')<p class="form-error">⚠ {{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="form-label">🔒 Konfirmasi Sandi</label>
                        <input type="password" name="password_confirmation" class="form-input" placeholder="Ulangi kata sandi" required>
                    </div>
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn-primary" style="width:100%;justify-content:center;font-size:15px;padding:12px 20px;margin-top:4px;">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                    Daftar Sekarang!
                </button>
            </form>

            {{-- Divider --}}
            <div style="display:flex;align-items:center;gap:12px;margin:20px 0;">
                <div style="flex:1;height:3px;background:#000;"></div>
                <span style="font-family:var(--font-display);font-size:12px;font-weight:800;color:#000;">SUDAH PUNYA AKUN?</span>
                <div style="flex:1;height:3px;background:#000;"></div>
            </div>
            <a href="{{ route('login') }}" class="btn-secondary" style="width:100%;justify-content:center;font-size:15px;padding:12px 20px;">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                Masuk ke Akun
            </a>
        </div>

        <p style="text-align:center;font-family:var(--font-body);font-size:11px;color:#777;margin-top:16px;font-weight:700;">
            © {{ date('Y') }} UMKM-AI — Platform Analisis Bisnis UMKM
        </p>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    anime({ targets: '#register-card > div', opacity: [0,1], translateY: [24,0], duration: 500, easing: 'easeOutCubic' });
});
</script>
@endpush
