@extends('layouts.landing')

@section('title', 'Daftar - UMKM.AI')

@section('content')
<div class="min-h-screen flex items-center justify-center px-6 py-12 relative">
    <div class="absolute w-[500px] h-[500px] rounded-full bg-indigo-600/15 blur-[120px] -top-40 -right-40"></div>
    <div class="absolute w-[400px] h-[400px] rounded-full bg-emerald-600/10 blur-[100px] -bottom-40 -left-40"></div>

    <div class="w-full max-w-lg relative z-10">
        <div class="text-center mb-8">
            <a href="{{ route('landing') }}" class="inline-flex items-center gap-3 mb-6">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center shadow-lg shadow-indigo-500/25">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <span class="text-2xl font-bold gradient-text">UMKM.AI</span>
            </a>
            <h1 class="text-2xl font-bold text-white mb-2">Buat Akun Baru</h1>
            <p class="text-sm text-dark-400">Daftarkan bisnis UMKM Anda dan mulai analisis dengan AI</p>
        </div>

        <div class="glass-card p-8" id="register-card">
            @if($errors->any())
            <div class="mb-4 p-3 rounded-lg bg-red-500/10 border border-red-500/20 text-red-400 text-sm">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-input" placeholder="John Doe" required>
                    </div>
                    <div>
                        <label class="form-label">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-input" placeholder="nama@email.com" required>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="form-label">Nama Bisnis</label>
                        <input type="text" name="business_name" value="{{ old('business_name') }}" class="form-input" placeholder="Toko Jaya Abadi" required>
                    </div>
                    <div>
                        <label class="form-label">Jenis Bisnis</label>
                        <select name="business_type" class="form-input" required>
                            <option value="">Pilih jenis</option>
                            <option value="Makanan & Minuman" {{ old('business_type') == 'Makanan & Minuman' ? 'selected' : '' }}>Makanan & Minuman</option>
                            <option value="Fashion" {{ old('business_type') == 'Fashion' ? 'selected' : '' }}>Fashion</option>
                            <option value="Elektronik" {{ old('business_type') == 'Elektronik' ? 'selected' : '' }}>Elektronik</option>
                            <option value="Kerajinan" {{ old('business_type') == 'Kerajinan' ? 'selected' : '' }}>Kerajinan</option>
                            <option value="Jasa" {{ old('business_type') == 'Jasa' ? 'selected' : '' }}>Jasa</option>
                            <option value="Pertanian" {{ old('business_type') == 'Pertanian' ? 'selected' : '' }}>Pertanian</option>
                            <option value="Lainnya" {{ old('business_type') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="form-label">No. Telepon (opsional)</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" class="form-input" placeholder="08123456789">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-input" placeholder="Min. 8 karakter" required>
                    </div>
                    <div>
                        <label class="form-label">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-input" placeholder="Ulangi password" required>
                    </div>
                </div>

                <button type="submit" class="btn-primary w-full justify-center py-3 mt-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                    Daftar Sekarang
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-sm text-dark-500">Sudah punya akun? <a href="{{ route('login') }}" class="text-indigo-400 hover:text-indigo-300 font-medium">Masuk</a></p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    anime({
        targets: '#register-card',
        opacity: [0, 1],
        translateY: [30, 0],
        scale: [0.95, 1],
        duration: 800,
        easing: 'easeOutCubic',
    });
});
</script>
@endpush
