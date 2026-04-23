@extends('layouts.app')
@section('title', 'Dashboard')
@section('page_title', 'Dashboard ' . auth()->user()->business_name)
@section('page_subtitle', 'Overview bisnis Anda hari ini')

@section('content')
{{-- Stats --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <div class="stat-card">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 rounded-xl bg-emerald-500/15 flex items-center justify-center">
                <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            @if($stats['revenue_growth_percent'] != 0)
            <span class="badge {{ $stats['revenue_growth_percent'] > 0 ? 'badge-success' : 'badge-danger' }}">
                {{ $stats['revenue_growth_percent'] > 0 ? '↑' : '↓' }} {{ abs($stats['revenue_growth_percent']) }}%
            </span>
            @endif
        </div>
        <p class="text-2xl font-bold text-white">Rp {{ number_format($stats['revenue_this_month'], 0, ',', '.') }}</p>
        <p class="text-xs text-dark-500 mt-1">Pendapatan Bulan Ini</p>
    </div>

    <div class="stat-card">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 rounded-xl bg-indigo-500/15 flex items-center justify-center">
                <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            </div>
        </div>
        <p class="text-2xl font-bold text-white">{{ $stats['transactions_this_month'] }}</p>
        <p class="text-xs text-dark-500 mt-1">Transaksi Bulan Ini</p>
    </div>

    <div class="stat-card">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 rounded-xl bg-purple-500/15 flex items-center justify-center">
                <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
            </div>
            @if($stats['low_stock_products'] > 0)
            <span class="badge badge-warning">{{ $stats['low_stock_products'] }} rendah</span>
            @endif
        </div>
        <p class="text-2xl font-bold text-white">{{ $stats['active_products'] }}</p>
        <p class="text-xs text-dark-500 mt-1">Produk Aktif</p>
    </div>

    <div class="stat-card">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 rounded-xl bg-amber-500/15 flex items-center justify-center">
                <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            </div>
        </div>
        <p class="text-2xl font-bold text-white">{{ $stats['total_customers'] }}</p>
        <p class="text-xs text-dark-500 mt-1">Total Pelanggan</p>
    </div>
</div>

<div class="grid lg:grid-cols-3 gap-6">
    {{-- Revenue Chart --}}
    <div class="lg:col-span-2 glass-card p-6">
        <h3 class="text-sm font-semibold text-white mb-4">Pendapatan 14 Hari Terakhir</h3>
        <canvas id="revenueChart" height="180"></canvas>
    </div>

    {{-- Payment Methods --}}
    <div class="glass-card p-6">
        <h3 class="text-sm font-semibold text-white mb-4">Metode Pembayaran</h3>
        <canvas id="paymentChart" height="180"></canvas>
        <div class="mt-4 space-y-2">
            @foreach($paymentMethods as $pm)
            <div class="flex items-center justify-between text-sm">
                <span class="text-dark-400 capitalize">{{ $pm->payment_method }}</span>
                <span class="text-dark-200 font-medium">{{ $pm->count }}x</span>
            </div>
            @endforeach
        </div>
    </div>
</div>

<div class="grid lg:grid-cols-2 gap-6 mt-6">
    {{-- Recent Transactions --}}
    <div class="glass-card p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-semibold text-white">Transaksi Terbaru</h3>
            <a href="{{ route('seller.transactions.create') }}" class="btn-primary text-xs py-1.5 px-3">+ Baru</a>
        </div>
        <div class="space-y-2">
            @forelse($recentTransactions as $trx)
            <div class="flex items-center justify-between p-3 rounded-lg bg-white/[0.02] border border-white/5">
                <div>
                    <p class="text-sm font-medium text-dark-200">{{ $trx->customer_name }}</p>
                    <p class="text-[10px] text-dark-500 font-mono">{{ $trx->transaction_code }}</p>
                </div>
                <div class="text-right">
                    <p class="text-sm font-semibold text-white">Rp {{ number_format($trx->total, 0, ',', '.') }}</p>
                    <p class="text-[10px] text-dark-500">{{ $trx->created_at->diffForHumans() }}</p>
                </div>
            </div>
            @empty
            <p class="text-sm text-dark-500 text-center py-4">Belum ada transaksi</p>
            @endforelse
        </div>
    </div>

    {{-- Low Stock Alert --}}
    <div class="glass-card p-6">
        <h3 class="text-sm font-semibold text-white mb-4 flex items-center gap-2">
            <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
            Stok Rendah
        </h3>
        <div class="space-y-2">
            @forelse($lowStockProducts as $product)
            <div class="flex items-center justify-between p-3 rounded-lg bg-amber-500/5 border border-amber-500/10">
                <div>
                    <p class="text-sm font-medium text-dark-200">{{ $product->name }}</p>
                    <p class="text-[10px] text-dark-500">{{ $product->sku ?? 'No SKU' }}</p>
                </div>
                <span class="badge badge-warning">Stok: {{ $product->stock }}</span>
            </div>
            @empty
            <p class="text-sm text-dark-500 text-center py-4">Semua stok aman 👍</p>
            @endforelse
        </div>
    </div>
</div>

{{-- AI Quick Insight --}}
<div class="mt-6 glass-card p-6 border-indigo-500/20">
    <div class="flex items-center gap-3 mb-3">
        <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
        </div>
        <div>
            <h3 class="text-sm font-semibold text-white">UMKM.AI Quick Insight</h3>
            <p class="text-[10px] text-dark-500">Ringkasan performa bisnis Anda</p>
        </div>
        <a href="{{ route('seller.analytics') }}" class="ml-auto btn-primary text-xs py-1.5 px-3">Analisis Lengkap →</a>
    </div>
    <div class="grid grid-cols-3 gap-4 mt-4">
        <div class="p-3 rounded-lg bg-white/[0.02]">
            <p class="text-xs text-dark-500">Rata-rata Transaksi</p>
            <p class="text-lg font-bold text-white mt-1">Rp {{ number_format($stats['avg_transaction_value'], 0, ',', '.') }}</p>
        </div>
        <div class="p-3 rounded-lg bg-white/[0.02]">
            <p class="text-xs text-dark-500">vs Bulan Lalu</p>
            <p class="text-lg font-bold {{ $stats['revenue_growth_percent'] >= 0 ? 'text-emerald-400' : 'text-red-400' }} mt-1">
                {{ $stats['revenue_growth_percent'] >= 0 ? '+' : '' }}{{ $stats['revenue_growth_percent'] }}%
            </p>
        </div>
        <div class="p-3 rounded-lg bg-white/[0.02]">
            <p class="text-xs text-dark-500">Produk Stok Rendah</p>
            <p class="text-lg font-bold {{ $stats['low_stock_products'] > 0 ? 'text-amber-400' : 'text-emerald-400' }} mt-1">{{ $stats['low_stock_products'] }}</p>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Revenue chart
    const dailyData = @json($dailyRevenue);
    const ctx1 = document.getElementById('revenueChart').getContext('2d');
    const gradient = ctx1.createLinearGradient(0, 0, 0, 180);
    gradient.addColorStop(0, 'rgba(99, 102, 241, 0.3)');
    gradient.addColorStop(1, 'rgba(99, 102, 241, 0)');

    new Chart(ctx1, {
        type: 'line',
        data: {
            labels: dailyData.map(d => d.date),
            datasets: [{
                label: 'Pendapatan',
                data: dailyData.map(d => d.revenue),
                borderColor: '#6366f1',
                backgroundColor: gradient,
                fill: true,
                tension: 0.4,
                pointRadius: 3,
                borderWidth: 2,
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false }, tooltip: { backgroundColor: 'rgba(15,23,42,0.9)', borderColor: 'rgba(99,102,241,0.2)', borderWidth: 1, cornerRadius: 8, callbacks: { label: ctx => 'Rp ' + ctx.parsed.y.toLocaleString('id-ID') } } },
            scales: {
                x: { grid: { color: 'rgba(148,163,184,0.06)' }, ticks: { color: '#64748b', font: { size: 10 }, maxRotation: 45 } },
                y: { grid: { color: 'rgba(148,163,184,0.06)' }, ticks: { color: '#64748b', font: { size: 10 }, callback: v => 'Rp ' + (v/1000).toFixed(0) + 'k' } }
            }
        }
    });

    // Payment chart
    const pmData = @json($paymentMethods);
    const colors = ['#6366f1', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6'];
    new Chart(document.getElementById('paymentChart').getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: pmData.map(d => d.payment_method),
            datasets: [{ data: pmData.map(d => d.total), backgroundColor: colors.slice(0, pmData.length), borderWidth: 0 }]
        },
        options: { responsive: true, plugins: { legend: { display: false } }, cutout: '70%' }
    });

    // Animate stat cards
    anime({ targets: '.stat-card', opacity: [0, 1], translateY: [20, 0], scale: [0.95, 1], delay: anime.stagger(100), duration: 600, easing: 'easeOutCubic' });
});
</script>
@endpush
