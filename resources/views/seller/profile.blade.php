@extends('layouts.app')
@section('title', 'Profil Bisnis')
@section('page_title', 'Profil Bisnis')
@section('page_subtitle', 'Kelola informasi bisnis Anda')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    {{-- Business Info --}}
    <div class="glass-card p-6">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-8 h-8 rounded-lg bg-indigo-500/15 flex items-center justify-center">
                <svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
            </div>
            <h3 class="text-sm font-semibold text-white">Informasi Bisnis</h3>
        </div>

        <form action="{{ route('seller.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- Avatar --}}
                <div class="md:col-span-2 flex items-center gap-4 mb-2">
                    <div id="avatar-preview" class="w-16 h-16 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white text-2xl font-bold shrink-0 overflow-hidden">
                        @if(auth()->user()->avatar)
                            <img src="{{ Storage::url(auth()->user()->avatar) }}" class="w-full h-full object-cover" alt="Avatar" id="avatar-img">
                        @else
                            <span id="avatar-initial">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                        @endif
                    </div>
                    <div>
                        <label class="btn-secondary text-xs cursor-pointer inline-flex items-center gap-1.5" for="avatar-input">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            Ganti Foto
                        </label>
                        <input type="file" name="avatar" id="avatar-input" class="hidden" accept="image/*" onchange="previewAvatar(this)">
                        <p class="text-[10px] text-dark-500 mt-1" id="avatar-filename">JPG, PNG. Maks 2MB</p>
                    </div>
                </div>

                <div>
                    <label class="form-label">Nama Pemilik</label>
                    <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" class="form-input" required>
                    @error('name') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="form-label">Nama Bisnis</label>
                    <input type="text" name="business_name" value="{{ old('business_name', auth()->user()->business_name) }}" class="form-input" required>
                    @error('business_name') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="form-label">Jenis Bisnis</label>
                    <input type="text" name="business_type" value="{{ old('business_type', auth()->user()->business_type) }}" class="form-input" required>
                    @error('business_type') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="form-label">Nomor Telepon</label>
                    <input type="text" name="phone" value="{{ old('phone', auth()->user()->phone) }}" class="form-input">
                    @error('phone') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="form-label">Alamat</label>
                    <textarea name="address" rows="3" class="form-input">{{ old('address', auth()->user()->address) }}</textarea>
                    @error('address') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex justify-end mt-6">
                <button type="submit" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    {{-- Account Info --}}
    <div class="glass-card p-6">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-8 h-8 rounded-lg bg-emerald-500/15 flex items-center justify-center">
                <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            </div>
            <h3 class="text-sm font-semibold text-white">Info Akun</h3>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4 rounded-xl bg-white/[0.02]">
            <div>
                <p class="text-xs text-dark-500">Email</p>
                <p class="text-sm text-dark-200 font-medium mt-0.5">{{ auth()->user()->email }}</p>
            </div>
            <div>
                <p class="text-xs text-dark-500">Tenant ID</p>
                <p class="text-sm text-dark-200 font-mono mt-0.5">{{ auth()->user()->tenant_id }}</p>
            </div>
            <div>
                <p class="text-xs text-dark-500">Bergabung Sejak</p>
                <p class="text-sm text-dark-200 font-medium mt-0.5">{{ auth()->user()->created_at->format('d M Y') }}</p>
            </div>
            <div>
                <p class="text-xs text-dark-500">Status</p>
                <span class="badge badge-success mt-0.5">Aktif</span>
            </div>
        </div>
    </div>

    {{-- Change Password --}}
    <div class="glass-card p-6">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-8 h-8 rounded-lg bg-amber-500/15 flex items-center justify-center">
                <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
            </div>
            <h3 class="text-sm font-semibold text-white">Ubah Password</h3>
        </div>

        <form action="{{ route('seller.profile.password') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="form-label">Password Saat Ini</label>
                    <input type="password" name="current_password" class="form-input" required>
                    @error('current_password') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="form-label">Password Baru</label>
                    <input type="password" name="password" class="form-input" required>
                    @error('password') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="form-label">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-input" required>
                </div>
            </div>

            <div class="flex justify-end mt-6">
                <button type="submit" class="btn-accent">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                    Ubah Password
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    anime({ targets: '.glass-card', opacity: [0, 1], translateY: [20, 0], delay: anime.stagger(120), duration: 600, easing: 'easeOutCubic' });
});

function previewAvatar(input) {
    if (input.files && input.files[0]) {
        const file = input.files[0];

        // Validate file size (max 2MB)
        if (file.size > 2 * 1024 * 1024) {
            alert('Ukuran file terlalu besar. Maksimal 2MB.');
            input.value = '';
            return;
        }

        // Validate file type
        if (!file.type.startsWith('image/')) {
            alert('File harus berupa gambar (JPG, PNG).');
            input.value = '';
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('avatar-preview');
            const initial = document.getElementById('avatar-initial');
            let img = document.getElementById('avatar-img');

            // Hide initial letter if exists
            if (initial) {
                initial.style.display = 'none';
            }

            // Create or update img element
            if (!img) {
                img = document.createElement('img');
                img.id = 'avatar-img';
                img.className = 'w-full h-full object-cover';
                img.alt = 'Avatar Preview';
                preview.appendChild(img);
            }

            img.src = e.target.result;
        };
        reader.readAsDataURL(file);

        // Show filename
        const filenameEl = document.getElementById('avatar-filename');
        if (filenameEl) {
            filenameEl.textContent = '📷 ' + file.name;
            filenameEl.classList.remove('text-dark-500');
            filenameEl.classList.add('text-emerald-400');
        }
    }
}
</script>
@endpush
