@extends('layouts.app')
@section('title', 'Detail Seller')
@section('page_title', $seller->business_name ?? $seller->name)
@section('page_subtitle', 'Detail informasi dan statistik seller')

@section('content')
{{-- Seller Info Card --}}
<div class="glass-card p-6 mb-6">
    <div class="flex items-start justify-between">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white text-xl font-bold">
                {{ strtoupper(substr($seller->name, 0, 1)) }}
            </div>
            <div>
                <h2 class="text-lg font-bold text-white">{{ $seller->name }}</h2>
                <p class="text-sm text-dark-400">{{ $seller->email }} · {{ $seller->phone ?? '-' }}</p>
                <p class="text-xs text-dark-500 mt-1">{{ $seller->business_type }} · Tenant: <code class="text-indigo-400">{{ $seller->tenant_id }}</code></p>
            </div>
        </div>
        <span class="badge {{ $seller->is_active ? 'badge-success' : 'badge-danger' }}">{{ $seller->is_active ? 'Aktif' : 'Nonaktif' }}</span>
    </div>
</div>

{{-- Stats --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <div class="stat-card"><p class="text-2xl font-bold text-white">{{ $stats['total_products'] }}</p><p class="text-xs text-dark-500 mt-1">Total Produk</p></div>
    <div class="stat-card"><p class="text-2xl font-bold text-white">{{ $stats['total_transactions'] }}</p><p class="text-xs text-dark-500 mt-1">Total Transaksi</p></div>
    <div class="stat-card"><p class="text-2xl font-bold text-white">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</p><p class="text-xs text-dark-500 mt-1">Total Revenue</p></div>
    <div class="stat-card"><p class="text-2xl font-bold text-white">{{ $stats['total_customers'] }}</p><p class="text-xs text-dark-500 mt-1">Total Pelanggan</p></div>
</div>

{{-- Database Info --}}
@if($seller->umkmDatabase)
<div class="glass-card p-6 mb-6">
    <h3 class="text-sm font-semibold text-white mb-3">Informasi Database</h3>
    <div class="grid grid-cols-3 gap-4">
        <div><p class="text-xs text-dark-500">Nama DB</p><p class="text-sm text-dark-200 font-medium">{{ $seller->umkmDatabase->db_name }}</p></div>
        <div><p class="text-xs text-dark-500">Tenant ID</p><p class="text-sm text-indigo-400 font-mono">{{ $seller->umkmDatabase->tenant_id }}</p></div>
        <div><p class="text-xs text-dark-500">Status</p><span class="badge badge-success">{{ $seller->umkmDatabase->status }}</span></div>
    </div>
</div>
@endif

{{-- Recent Transactions --}}
<div class="glass-card p-6">
    <h3 class="text-sm font-semibold text-white mb-4">Transaksi Terbaru</h3>
    <table class="data-table">
        <thead><tr><th>Kode</th><th>Pelanggan</th><th>Total</th><th>Status</th><th>Tanggal</th></tr></thead>
        <tbody>
            @forelse($recentTransactions as $trx)
            <tr>
                <td class="font-mono text-indigo-400 text-xs">{{ $trx->transaction_code }}</td>
                <td>{{ $trx->customer_name }}</td>
                <td class="font-medium text-dark-200">Rp {{ number_format($trx->total, 0, ',', '.') }}</td>
                <td><span class="badge {{ $trx->status === 'completed' ? 'badge-success' : 'badge-warning' }}">{{ ucfirst($trx->status) }}</span></td>
                <td class="text-xs text-dark-500">{{ $trx->created_at->format('d M Y H:i') }}</td>
            </tr>
            @empty
            <tr><td colspan="5" class="text-center text-dark-500">Belum ada transaksi</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    <a href="{{ route('admin.sellers.index') }}" class="btn-secondary">← Kembali</a>
</div>
@endsection
