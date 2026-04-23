@extends('layouts.app')
@section('title', 'Analytics Global')
@section('page_title', 'Analytics Global')
@section('page_subtitle', 'Statistik dan performa seluruh UMKM')

@section('content')
{{-- Stats --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <div class="stat-card">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 rounded-xl bg-emerald-500/15 flex items-center justify-center">
                <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            @if($growthPercent != 0)
            <span class="badge {{ $growthPercent > 0 ? 'badge-success' : 'badge-danger' }}">
                {{ $growthPercent > 0 ? '↑' : '↓' }} {{ abs($growthPercent) }}%
            </span>
            @endif
        </div>
        <p class="text-2xl font-bold text-white">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
        <p class="text-xs text-dark-500 mt-1">Total Pendapatan Global</p>
    </div>

    <div class="stat-card">
        <div class="w-10 h-10 rounded-xl bg-indigo-500/15 flex items-center justify-center mb-3">
            <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
        </div>
        <p class="text-2xl font-bold text-white">{{ number_format($totalTransactions) }}</p>
        <p class="text-xs text-dark-500 mt-1">Total Transaksi</p>
    </div>

    <div class="stat-card">
        <div class="w-10 h-10 rounded-xl bg-purple-500/15 flex items-center justify-center mb-3">
            <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
        </div>
        <p class="text-2xl font-bold text-white">{{ number_format($totalProducts) }}</p>
        <p class="text-xs text-dark-500 mt-1">Total Produk</p>
    </div>

    <div class="stat-card">
        <div class="w-10 h-10 rounded-xl bg-amber-500/15 flex items-center justify-center mb-3">
            <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
        </div>
        <p class="text-2xl font-bold text-white">{{ number_format($totalCustomers) }}</p>
        <p class="text-xs text-dark-500 mt-1">Total Pelanggan</p>
    </div>
</div>

<div class="grid lg:grid-cols-3 gap-6 mb-6">
    {{-- Monthly Revenue Trend --}}
    <div class="lg:col-span-2 glass-card p-6">
        <h3 class="text-sm font-semibold text-white mb-4">Tren Pendapatan Bulanan</h3>
        <canvas id="monthlyRevenueChart" height="200"></canvas>
    </div>

    {{-- Payment Methods --}}
    <div class="glass-card p-6">
        <h3 class="text-sm font-semibold text-white mb-4">Metode Pembayaran (Bulan Ini)</h3>
        <canvas id="paymentChart" height="200"></canvas>
        <div class="mt-4 space-y-2">
            @foreach($paymentMethods as $pm)
            <div class="flex items-center justify-between text-sm">
                <span class="text-dark-400 capitalize">{{ $pm->payment_method }}</span>
                <span class="text-dark-200 font-medium">{{ $pm->count }}x — Rp {{ number_format($pm->total, 0, ',', '.') }}</span>
            </div>
            @endforeach
        </div>
    </div>
</div>

<div class="grid lg:grid-cols-2 gap-6 mb-6">
    {{-- Daily Transactions Chart --}}
    <div class="glass-card p-6">
        <h3 class="text-sm font-semibold text-white mb-4">Transaksi Harian (Bulan Ini)</h3>
        <canvas id="dailyChart" height="200"></canvas>
    </div>

    {{-- Business Type Distribution --}}
    <div class="glass-card p-6">
        <h3 class="text-sm font-semibold text-white mb-4">Distribusi Jenis Bisnis</h3>
        <canvas id="businessTypeChart" height="200"></canvas>
    </div>
</div>

{{-- Seller Revenue Ranking --}}
<div class="glass-card p-6">
    <h3 class="text-sm font-semibold text-white mb-4">Peringkat Seller Berdasarkan Pendapatan</h3>
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Bisnis</th>
                    <th class="text-right">Transaksi</th>
                    <th class="text-right">Pendapatan</th>
                    <th>Kontribusi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sellerRevenue as $idx => $seller)
                <tr>
                    <td>
                        <span class="w-6 h-6 rounded-full {{ $idx < 3 ? 'bg-gradient-to-br from-indigo-500 to-purple-600' : 'bg-dark-700' }} inline-flex items-center justify-center text-white text-xs font-bold">{{ $idx + 1 }}</span>
                    </td>
                    <td class="font-medium text-dark-200">{{ $seller['name'] }}</td>
                    <td class="text-right">{{ number_format($seller['transactions']) }}</td>
                    <td class="text-right font-semibold text-white">Rp {{ number_format($seller['revenue'], 0, ',', '.') }}</td>
                    <td>
                        @php $pct = $totalRevenue > 0 ? round(($seller['revenue'] / $totalRevenue) * 100, 1) : 0; @endphp
                        <div class="flex items-center gap-2">
                            <div class="flex-1 h-1.5 rounded-full bg-dark-800 overflow-hidden">
                                <div class="h-full rounded-full bg-gradient-to-r from-indigo-500 to-purple-500" style="width: {{ $pct }}%"></div>
                            </div>
                            <span class="text-xs text-dark-400 w-10 text-right">{{ $pct }}%</span>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Month Comparison --}}
<div class="grid lg:grid-cols-2 gap-6 mt-6">
    <div class="glass-card p-6 border-emerald-500/15">
        <h3 class="text-sm font-semibold text-white mb-2">Bulan Ini</h3>
        <p class="text-3xl font-bold text-emerald-400">Rp {{ number_format($revenueThisMonth, 0, ',', '.') }}</p>
        <p class="text-xs text-dark-500 mt-1">Pendapatan bulan berjalan</p>
    </div>
    <div class="glass-card p-6 border-dark-600/15">
        <h3 class="text-sm font-semibold text-white mb-2">Bulan Lalu</h3>
        <p class="text-3xl font-bold text-dark-300">Rp {{ number_format($revenueLastMonth, 0, ',', '.') }}</p>
        <p class="text-xs text-dark-500 mt-1">Pendapatan bulan sebelumnya</p>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const chartDefaults = {
        responsive: true,
        plugins: { legend: { display: false }, tooltip: { backgroundColor: 'rgba(15,23,42,0.95)', borderColor: 'rgba(99,102,241,0.2)', borderWidth: 1, cornerRadius: 8, callbacks: { label: ctx => 'Rp ' + ctx.parsed.y?.toLocaleString('id-ID') || ctx.parsed.toLocaleString('id-ID') } } },
    };
    const gridStyle = { color: 'rgba(148,163,184,0.06)' };
    const tickStyle = { color: '#64748b', font: { size: 10 } };

    // Monthly Revenue
    const monthlyData = @json($monthlyRevenue);
    const ctx1 = document.getElementById('monthlyRevenueChart').getContext('2d');
    const grad1 = ctx1.createLinearGradient(0, 0, 0, 200);
    grad1.addColorStop(0, 'rgba(99, 102, 241, 0.3)');
    grad1.addColorStop(1, 'rgba(99, 102, 241, 0)');
    new Chart(ctx1, {
        type: 'bar', data: {
            labels: monthlyData.map(d => d.month),
            datasets: [{ label: 'Pendapatan', data: monthlyData.map(d => d.revenue), backgroundColor: 'rgba(99,102,241,0.7)', borderRadius: 8, borderSkipped: false }]
        }, options: { ...chartDefaults, scales: { x: { grid: gridStyle, ticks: tickStyle }, y: { grid: gridStyle, ticks: { ...tickStyle, callback: v => 'Rp ' + (v/1000000).toFixed(1) + 'M' } } } }
    });

    // Payment Chart
    const pmData = @json($paymentMethods);
    const pmColors = ['#6366f1', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6'];
    new Chart(document.getElementById('paymentChart').getContext('2d'), {
        type: 'doughnut', data: { labels: pmData.map(d => d.payment_method), datasets: [{ data: pmData.map(d => d.total), backgroundColor: pmColors, borderWidth: 0 }] },
        options: { responsive: true, plugins: { legend: { display: false } }, cutout: '70%' }
    });

    // Daily Chart
    const dailyData = @json($dailyTransactions);
    const ctx3 = document.getElementById('dailyChart').getContext('2d');
    const grad3 = ctx3.createLinearGradient(0, 0, 0, 200);
    grad3.addColorStop(0, 'rgba(16, 185, 129, 0.3)');
    grad3.addColorStop(1, 'rgba(16, 185, 129, 0)');
    new Chart(ctx3, {
        type: 'line', data: { labels: dailyData.map(d => d.date), datasets: [{ label: 'Pendapatan', data: dailyData.map(d => d.revenue), borderColor: '#10b981', backgroundColor: grad3, fill: true, tension: 0.4, pointRadius: 2, borderWidth: 2 }] },
        options: { ...chartDefaults, scales: { x: { grid: gridStyle, ticks: { ...tickStyle, maxRotation: 45 } }, y: { grid: gridStyle, ticks: { ...tickStyle, callback: v => 'Rp ' + (v/1000).toFixed(0) + 'k' } } } }
    });

    // Business Type Chart
    const btData = @json($businessTypes);
    const btColors = ['#6366f1', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6', '#ec4899'];
    new Chart(document.getElementById('businessTypeChart').getContext('2d'), {
        type: 'pie', data: { labels: btData.map(d => d.business_type), datasets: [{ data: btData.map(d => d.count), backgroundColor: btColors, borderWidth: 0 }] },
        options: { responsive: true, plugins: { legend: { position: 'bottom', labels: { color: '#94a3b8', font: { size: 11 }, boxWidth: 12, padding: 16 } } } }
    });

    // Animations
    anime({ targets: '.stat-card', opacity: [0, 1], translateY: [20, 0], scale: [0.95, 1], delay: anime.stagger(100), duration: 600, easing: 'easeOutCubic' });
    anime({ targets: '.glass-card', opacity: [0, 1], translateY: [15, 0], delay: anime.stagger(80, { start: 300 }), duration: 600, easing: 'easeOutCubic' });
});
</script>
@endpush
