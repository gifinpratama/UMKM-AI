@extends('layouts.app')
@section('title', 'Pengaturan')
@section('page_title', 'Pengaturan Sistem')
@section('page_subtitle', 'Kelola profil admin dan pengaturan')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    {{-- Admin Profile --}}
    <div class="glass-card p-6">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-8 h-8 rounded-lg bg-indigo-500/15 flex items-center justify-center">
                <svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            </div>
            <h3 class="text-sm font-semibold text-white">Profil Admin</h3>
        </div>

        <form action="{{ route('admin.settings.profile') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="form-label">Nama</label>
                    <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" class="form-input" required>
                    @error('name') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" class="form-input" required>
                    @error('email') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex justify-end mt-6">
                <button type="submit" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Simpan Profil
                </button>
            </div>
        </form>
    </div>

    {{-- Change Password --}}
    <div class="glass-card p-6">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-8 h-8 rounded-lg bg-amber-500/15 flex items-center justify-center">
                <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
            </div>
            <h3 class="text-sm font-semibold text-white">Ubah Password</h3>
        </div>

        <form action="{{ route('admin.settings.password') }}" method="POST">
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

    {{-- Activity Log --}}
    <div class="glass-card p-6">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-purple-500/15 flex items-center justify-center">
                    <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="text-sm font-semibold text-white">Activity Log Terbaru</h3>
            </div>
            <form action="{{ route('admin.settings.clearLogs') }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus semua logs?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-danger text-xs py-1.5 px-3">Hapus Semua</button>
            </form>
        </div>

        <div class="space-y-2 max-h-96 overflow-y-auto custom-scrollbar">
            @forelse($activityLogs as $log)
            <div class="flex items-start gap-3 p-3 rounded-lg bg-white/[0.02] border border-white/5">
                <div class="w-8 h-8 rounded-lg bg-dark-800 flex items-center justify-center text-dark-400 shrink-0 mt-0.5">
                    @switch($log->action)
                        @case('login')
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                            @break
                        @case('logout')
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            @break
                        @default
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    @endswitch
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm text-dark-200">{{ $log->description }}</p>
                    <div class="flex items-center gap-2 mt-1">
                        <span class="text-[10px] text-dark-500">{{ $log->user?->name ?? 'System' }}</span>
                        <span class="text-[10px] text-dark-600">•</span>
                        <span class="text-[10px] text-dark-500">{{ $log->created_at->diffForHumans() }}</span>
                        <span class="text-[10px] text-dark-600">•</span>
                        <span class="badge badge-info text-[10px] py-0 px-1.5">{{ $log->action }}</span>
                    </div>
                </div>
            </div>
            @empty
            <p class="text-sm text-dark-500 text-center py-8">Belum ada activity log</p>
            @endforelse
        </div>
    </div>

    {{-- System Info --}}
    <div class="glass-card p-6">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-8 h-8 rounded-lg bg-cyan-500/15 flex items-center justify-center">
                <svg class="w-4 h-4 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            </div>
            <h3 class="text-sm font-semibold text-white">Informasi Sistem</h3>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="p-3 rounded-lg bg-white/[0.02]">
                <p class="text-xs text-dark-500">Framework</p>
                <p class="text-sm text-dark-200 font-medium mt-0.5">Laravel {{ app()->version() }}</p>
            </div>
            <div class="p-3 rounded-lg bg-white/[0.02]">
                <p class="text-xs text-dark-500">PHP</p>
                <p class="text-sm text-dark-200 font-medium mt-0.5">{{ phpversion() }}</p>
            </div>
            <div class="p-3 rounded-lg bg-white/[0.02]">
                <p class="text-xs text-dark-500">Database</p>
                <p class="text-sm text-dark-200 font-medium mt-0.5">{{ ucfirst(config('database.default')) }}</p>
            </div>
            <div class="p-3 rounded-lg bg-white/[0.02]">
                <p class="text-xs text-dark-500">Timezone</p>
                <p class="text-sm text-dark-200 font-medium mt-0.5">{{ config('app.timezone') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    anime({ targets: '.glass-card', opacity: [0, 1], translateY: [20, 0], delay: anime.stagger(120), duration: 600, easing: 'easeOutCubic' });
});
</script>
@endpush
