@extends('layouts.app')
@section('title', 'Detail Seller')
@section('page_title', $seller->business_name ?? $seller->name)
@section('page_subtitle', 'Detail informasi dan statistik seller')

@section('content')
{{-- Seller Info Card --}}
<div class="card-elevated" style="margin-bottom:24px;">
    <div style="display:flex;align-items:flex-start;justify-content:space-between;">
        <div style="display:flex;align-items:center;gap:16px;">
            <div style="width:56px;height:56px;border-radius:10px;background:var(--color-orange);border:3px solid #000;box-shadow:var(--nb-shadow-sm);display:flex;align-items:center;justify-content:center;font-family:var(--font-display);font-weight:800;color:#fff;font-size:20px;">
                {{ strtoupper(substr($seller->name, 0, 1)) }}
            </div>
            <div>
                <h2 style="font-family:var(--font-display);font-size:18px;font-weight:800;color:var(--color-text-primary);margin:0;">{{ $seller->name }}</h2>
                <p style="font-family:var(--font-body);font-size:13px;color:var(--color-text-muted);margin:4px 0 0;">{{ $seller->email }} · {{ $seller->phone ?? '-' }}</p>
                <p style="font-family:var(--font-body);font-size:12px;color:var(--color-text-muted);margin:4px 0 0;">{{ $seller->business_type }} · Tenant: <code style="color:var(--color-orange);">{{ $seller->tenant_id }}</code></p>
            </div>
        </div>
        <span class="badge {{ $seller->is_active ? 'badge-success' : 'badge-danger' }}">{{ $seller->is_active ? 'Aktif' : 'Nonaktif' }}</span>
    </div>
</div>

{{-- Stats --}}
<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:24px;">
    <div class="stat-card"><p style="font-family:var(--font-display);font-size:22px;font-weight:800;color:var(--color-text-primary);margin:0;">{{ $stats['total_products'] }}</p><p style="font-family:var(--font-body);font-size:12px;color:var(--color-text-muted);margin:4px 0 0;">Total Produk</p></div>
    <div class="stat-card"><p style="font-family:var(--font-display);font-size:22px;font-weight:800;color:var(--color-text-primary);margin:0;">{{ $stats['total_transactions'] }}</p><p style="font-family:var(--font-body);font-size:12px;color:var(--color-text-muted);margin:4px 0 0;">Total Transaksi</p></div>
    <div class="stat-card"><p style="font-family:var(--font-display);font-size:22px;font-weight:800;color:var(--color-text-primary);margin:0;">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</p><p style="font-family:var(--font-body);font-size:12px;color:var(--color-text-muted);margin:4px 0 0;">Total Revenue</p></div>
    <div class="stat-card"><p style="font-family:var(--font-display);font-size:22px;font-weight:800;color:var(--color-text-primary);margin:0;">{{ $stats['total_customers'] }}</p><p style="font-family:var(--font-body);font-size:12px;color:var(--color-text-muted);margin:4px 0 0;">Total Pelanggan</p></div>
</div>

{{-- Database Info --}}
@if($seller->umkmDatabase)
<div class="card-elevated" style="margin-bottom:24px;">
    <h3 style="font-family:var(--font-display);font-size:15px;font-weight:800;color:var(--color-text-primary);margin:0 0 12px;">Informasi Database</h3>
    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;">
        <div><p style="font-family:var(--font-body);font-size:12px;color:var(--color-text-muted);margin:0 0 4px;">Nama DB</p><p style="font-family:var(--font-body);font-size:14px;font-weight:600;color:var(--color-text-primary);margin:0;">{{ $seller->umkmDatabase->db_name }}</p></div>
        <div><p style="font-family:var(--font-body);font-size:12px;color:var(--color-text-muted);margin:0 0 4px;">Tenant ID</p><p style="font-family:var(--font-body);font-size:14px;font-weight:600;color:var(--color-orange);margin:0;">{{ $seller->umkmDatabase->tenant_id }}</p></div>
        <div><p style="font-family:var(--font-body);font-size:12px;color:var(--color-text-muted);margin:0 0 4px;">Status</p><span class="badge badge-success">{{ $seller->umkmDatabase->status }}</span></div>
    </div>
</div>
@endif

{{-- Recent Transactions --}}
<div class="card-elevated">
    <h3 style="font-family:var(--font-display);font-size:15px;font-weight:800;color:var(--color-text-primary);margin:0 0 16px;">Transaksi Terbaru</h3>
    <table class="data-table">
        <thead><tr><th>Kode</th><th>Pelanggan</th><th>Total</th><th>Status</th><th>Tanggal</th></tr></thead>
        <tbody>
            @forelse($recentTransactions as $trx)
            <tr>
                <td style="font-family:var(--font-body);font-size:12px;color:var(--color-orange);">{{ $trx->transaction_code }}</td>
                <td>{{ $trx->customer_name }}</td>
                <td style="font-weight:700;">Rp {{ number_format($trx->total, 0, ',', '.') }}</td>
                <td><span class="badge {{ $trx->status === 'completed' ? 'badge-success' : 'badge-warning' }}">{{ ucfirst($trx->status) }}</span></td>
                <td style="font-family:var(--font-body);font-size:12px;color:var(--color-text-muted);">{{ $trx->created_at->format('d M Y H:i') }}</td>
            </tr>
            @empty
            <tr><td colspan="5" style="text-align:center;color:var(--color-text-muted);padding:24px;">Belum ada transaksi</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    <a href="{{ route('admin.sellers.index') }}" class="btn-secondary">← Kembali</a>
</div>
@endsection
