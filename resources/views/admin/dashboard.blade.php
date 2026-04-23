@extends('layouts.app')

@section('title', 'Dashboard Admin')
@section('page_title', 'Dashboard Admin')
@section('page_subtitle', 'Overview semua UMKM yang terdaftar')

@section('content')
{{-- Stats Grid --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <div class="stat-card">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 rounded-xl bg-indigo-500/15 flex items-center justify-center">
                <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <span class="badge badge-success">Aktif: {{ $activeSellers }}</span>
        </div>
        <p class="text-2xl font-bold text-white">{{ $totalSellers }}</p>
        <p class="text-xs text-dark-500 mt-1">Total Seller UMKM</p>
    </div>

    <div class="stat-card">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 rounded-xl bg-emerald-500/15 flex items-center justify-center">
                <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>
        <p class="text-2xl font-bold text-white">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
        <p class="text-xs text-dark-500 mt-1">Total Revenue</p>
    </div>

    <div class="stat-card">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 rounded-xl bg-purple-500/15 flex items-center justify-center">
                <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            </div>
        </div>
        <p class="text-2xl font-bold text-white">{{ number_format($totalTransactions) }}</p>
        <p class="text-xs text-dark-500 mt-1">Total Transaksi</p>
    </div>

    <div class="stat-card">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 rounded-xl bg-amber-500/15 flex items-center justify-center">
                <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"/></svg>
            </div>
        </div>
        <p class="text-2xl font-bold text-white">{{ $totalDatabases }}</p>
        <p class="text-xs text-dark-500 mt-1">Database Aktif</p>
    </div>
</div>

<div class="grid lg:grid-cols-3 gap-6">
    {{-- Revenue Chart --}}
    <div class="lg:col-span-2 glass-card p-6">
        <h3 class="text-sm font-semibold text-white mb-4">Revenue Bulanan (6 Bulan Terakhir)</h3>
        <canvas id="revenueChart" height="200"></canvas>
    </div>

    {{-- Top Sellers --}}
    <div class="glass-card p-6">
        <h3 class="text-sm font-semibold text-white mb-4">Top Seller by Revenue</h3>
        <div class="space-y-3">
            @forelse($topSellers as $index => $seller)
            <div class="flex items-center gap-3 p-2.5 rounded-lg bg-white/[0.02]">
                <span class="text-xs font-bold text-dark-500 w-5">{{ $index + 1 }}</span>
                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white text-xs font-bold shrink-0">
                    {{ strtoupper(substr($seller->business_name ?? $seller->name, 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-dark-200 truncate">{{ $seller->business_name ?? $seller->name }}</p>
                    <p class="text-[10px] text-dark-500">Rp {{ number_format($seller->total_revenue, 0, ',', '.') }}</p>
                </div>
            </div>
            @empty
            <p class="text-sm text-dark-500 text-center py-4">Belum ada data seller</p>
            @endforelse
        </div>
    </div>
</div>

{{-- Recent Sellers & Activity --}}
<div class="grid lg:grid-cols-2 gap-6 mt-6">
    <div class="glass-card p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-semibold text-white">Seller Terbaru</h3>
            <a href="{{ route('admin.sellers.create') }}" class="btn-primary text-xs py-1.5 px-3">+ Tambah</a>
        </div>
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead><tr><th>Nama</th><th>Bisnis</th><th>Status</th><th>Tanggal</th></tr></thead>
                <tbody>
                    @forelse($recentSellers as $seller)
                    <tr>
                        <td class="font-medium text-dark-200">{{ $seller->name }}</td>
                        <td>{{ $seller->business_name }}</td>
                        <td><span class="badge {{ $seller->is_active ? 'badge-success' : 'badge-danger' }}">{{ $seller->is_active ? 'Aktif' : 'Nonaktif' }}</span></td>
                        <td class="text-dark-500 text-xs">{{ $seller->created_at->format('d M Y') }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center text-dark-500">Belum ada seller</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="glass-card p-6">
        <h3 class="text-sm font-semibold text-white mb-4">Aktivitas Terbaru</h3>
        <div class="space-y-3">
            @forelse($recentActivity as $activity)
            <div class="flex items-start gap-3 p-2 rounded-lg">
                <div class="w-2 h-2 rounded-full bg-indigo-400 mt-1.5 shrink-0"></div>
                <div>
                    <p class="text-sm text-dark-300">{{ $activity->description }}</p>
                    <p class="text-[10px] text-dark-600">{{ $activity->user->name ?? 'System' }} · {{ $activity->created_at->diffForHumans() }}</p>
                </div>
            </div>
            @empty
            <p class="text-sm text-dark-500 text-center py-4">Belum ada aktivitas</p>
            @endforelse
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Revenue chart
    const revenueData = @json($monthlyRevenue);
    const ctx = document.getElementById('revenueChart').getContext('2d');
    
    const gradient = ctx.createLinearGradient(0, 0, 0, 200);
    gradient.addColorStop(0, 'rgba(99, 102, 241, 0.3)');
    gradient.addColorStop(1, 'rgba(99, 102, 241, 0)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: revenueData.map(d => d.month),
            datasets: [{
                label: 'Revenue',
                data: revenueData.map(d => d.revenue),
                borderColor: '#6366f1',
                backgroundColor: gradient,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#6366f1',
                pointBorderColor: '#6366f1',
                pointRadius: 4,
                borderWidth: 2,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: 'rgba(15, 23, 42, 0.9)',
                    titleColor: '#e2e8f0',
                    bodyColor: '#94a3b8',
                    borderColor: 'rgba(99, 102, 241, 0.2)',
                    borderWidth: 1,
                    cornerRadius: 8,
                    callbacks: {
                        label: (ctx) => 'Rp ' + ctx.parsed.y.toLocaleString('id-ID')
                    }
                }
            },
            scales: {
                x: { grid: { color: 'rgba(148, 163, 184, 0.06)' }, ticks: { color: '#64748b', font: { size: 11 } } },
                y: { grid: { color: 'rgba(148, 163, 184, 0.06)' }, ticks: { color: '#64748b', font: { size: 11 }, callback: v => 'Rp ' + (v/1000000).toFixed(1) + 'jt' } }
            }
        }
    });

    // Stat cards animation
    anime({
        targets: '.stat-card',
        opacity: [0, 1],
        translateY: [20, 0],
        scale: [0.95, 1],
        delay: anime.stagger(100),
        duration: 600,
        easing: 'easeOutCubic'
    });
});
</script>
@endpush
