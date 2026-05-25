@extends('layouts.app')
@section('title', 'Pengaturan')
@section('page_title', 'Pengaturan Sistem')
@section('page_subtitle', 'Kelola profil admin dan pengaturan')

@section('content')
<div style="max-width:800px;margin:0 auto;display:flex;flex-direction:column;gap:20px;">

    {{-- Admin Profile --}}
    <div class="card-elevated">
        <div style="display:flex;align-items:center;gap:12px;margin-bottom:20px;">
            <div style="width:36px;height:36px;border-radius:8px;background:rgba(139,211,221,0.15);display:flex;align-items:center;justify-content:center;">
                <svg width="18" height="18" fill="none" stroke="var(--color-teal)" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            </div>
            <h3 style="font-family:var(--font-display);font-size:16px;font-weight:800;color:var(--color-text-primary);margin:0;">Profil Admin</h3>
        </div>

        <form action="{{ route('admin.settings.profile') }}" method="POST">
            @csrf
            @method('PUT')
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                <div>
                    <label class="form-label">Nama</label>
                    <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" class="form-input" required>
                    @error('name') <p class="form-error">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" class="form-input" required>
                    @error('email') <p class="form-error">{{ $message }}</p> @enderror
                </div>
            </div>
            <div style="display:flex;justify-content:flex-end;margin-top:16px;">
                <button type="submit" class="btn-secondary">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Simpan Profil
                </button>
            </div>
        </form>
    </div>

    {{-- Change Password --}}
    <div class="card-elevated">
        <div style="display:flex;align-items:center;gap:12px;margin-bottom:20px;">
            <div style="width:36px;height:36px;border-radius:8px;background:rgba(250,174,43,0.12);display:flex;align-items:center;justify-content:center;">
                <svg width="18" height="18" fill="none" stroke="var(--color-golden)" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
            </div>
            <h3 style="font-family:var(--font-display);font-size:16px;font-weight:800;color:var(--color-text-primary);margin:0;">Ubah Password</h3>
        </div>
        <form action="{{ route('admin.settings.password') }}" method="POST">
            @csrf
            @method('PUT')
            <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;">
                <div>
                    <label class="form-label">Password Saat Ini</label>
                    <input type="password" name="current_password" class="form-input" required>
                    @error('current_password') <p class="form-error">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="form-label">Password Baru</label>
                    <input type="password" name="password" class="form-input" required>
                    @error('password') <p class="form-error">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="form-label">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-input" required>
                </div>
            </div>
            <div style="display:flex;justify-content:flex-end;margin-top:16px;">
                <button type="submit" class="btn-primary">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                    Ubah Password
                </button>
            </div>
        </form>
    </div>

    {{-- Activity Log --}}
    <div class="card-elevated">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;">
            <div style="display:flex;align-items:center;gap:12px;">
                <div style="width:36px;height:36px;border-radius:8px;background:rgba(221,107,32,0.12);display:flex;align-items:center;justify-content:center;">
                    <svg width="18" height="18" fill="none" stroke="var(--color-orange)" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 style="font-family:var(--font-display);font-size:16px;font-weight:800;color:var(--color-text-primary);margin:0;">Activity Log Terbaru</h3>
            </div>
            <form action="{{ route('admin.settings.clearLogs') }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus semua logs?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-danger btn-sm">Hapus Semua</button>
            </form>
        </div>
        <div style="max-height:384px;overflow-y:auto;display:flex;flex-direction:column;gap:8px;">
            @forelse($activityLogs as $log)
            <div style="display:flex;align-items:flex-start;gap:12px;padding:10px 12px;border-radius:8px;background:var(--color-surface-soft);border:1px solid var(--color-border);">
                <div style="width:32px;height:32px;border-radius:8px;background:var(--color-surface-bg);display:flex;align-items:center;justify-content:center;color:var(--color-text-secondary);flex-shrink:0;margin-top:2px;">
                    @switch($log->action)
                        @case('login')
                            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                            @break
                        @case('logout')
                            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            @break
                        @default
                            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    @endswitch
                </div>
                <div style="flex:1;min-width:0;">
                    <p style="font-family:var(--font-body);font-size:13px;color:var(--color-text-primary);margin:0 0 4px;">{{ $log->description }}</p>
                    <div style="display:flex;align-items:center;gap:8px;">
                        <span style="font-family:var(--font-body);font-size:11px;color:var(--color-text-muted);">{{ $log->user?->name ?? 'System' }}</span>
                        <span style="color:var(--color-border);">•</span>
                        <span style="font-family:var(--font-body);font-size:11px;color:var(--color-text-muted);">{{ $log->created_at->diffForHumans() }}</span>
                        <span style="color:var(--color-border);">•</span>
                        <span class="badge badge-info">{{ $log->action }}</span>
                    </div>
                </div>
            </div>
            @empty
            <p style="font-family:var(--font-body);font-size:14px;color:var(--color-text-muted);text-align:center;padding:32px;">Belum ada activity log</p>
            @endforelse
        </div>
    </div>

    {{-- System Info --}}
    <div class="card-elevated">
        <div style="display:flex;align-items:center;gap:12px;margin-bottom:16px;">
            <div style="width:36px;height:36px;border-radius:8px;background:rgba(139,211,221,0.15);display:flex;align-items:center;justify-content:center;">
                <svg width="18" height="18" fill="none" stroke="var(--color-teal)" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            </div>
            <h3 style="font-family:var(--font-display);font-size:16px;font-weight:800;color:var(--color-text-primary);margin:0;">Informasi Sistem</h3>
        </div>
        <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:12px;">
            @foreach(['Framework' => 'Laravel ' . app()->version(), 'PHP' => phpversion(), 'Database' => ucfirst(config('database.default')), 'Timezone' => config('app.timezone')] as $label => $val)
            <div class="card-surface" style="text-align:center;">
                <p style="font-family:var(--font-body);font-size:12px;color:var(--color-text-muted);margin:0 0 4px;">{{ $label }}</p>
                <p style="font-family:var(--font-body);font-size:13px;font-weight:600;color:var(--color-text-primary);margin:0;">{{ $val }}</p>
            </div>
            @endforeach
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    anime({ targets: '.card-elevated', opacity: [0, 1], translateY: [20, 0], delay: anime.stagger(120), duration: 600, easing: 'easeOutCubic' });
});
</script>
@endpush
