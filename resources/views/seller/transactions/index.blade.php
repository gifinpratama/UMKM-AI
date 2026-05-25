@extends('layouts.app')
@section('title', 'Transaksi')
@section('page_title', 'Manajemen Transaksi')
@section('page_subtitle', 'Riwayat dan pencatatan transaksi')

@section('content')
<div class="flex items-center justify-between mb-6">
    <form method="GET" class="flex items-center gap-3 flex-wrap">
        <input type="text" name="search" value="{{ request('search') }}" class="form-input w-52" placeholder="Cari kode/pelanggan...">
        <select name="status" class="form-input w-36" onchange="this.form.submit()">
            <option value="">Semua</option>
            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Batal</option>
        </select>
        <input type="date" name="date_from" value="{{ request('date_from') }}" class="form-input w-36" onchange="this.form.submit()">
        <input type="date" name="date_to" value="{{ request('date_to') }}" class="form-input w-36" onchange="this.form.submit()">
    </form>
    <a href="{{ route('seller.transactions.create') }}" class="btn-primary">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
        Transaksi Baru
    </a>
</div>

<div class="card-elevated" style="overflow:hidden;">
    <table class="data-table">
        <thead><tr><th>Kode</th><th>Pelanggan</th><th>Items</th><th>Total</th><th>Bayar</th><th>Status</th><th>Tanggal</th></tr></thead>
        <tbody>
            @forelse($transactions as $trx)
            <tr>
                <td class="font-mono text-indigo-400 text-xs">{{ $trx->transaction_code }}</td>
                <td class="font-medium text-dark-200">{{ $trx->customer_name }}</td>
                <td class="text-xs text-dark-400">{{ count($trx->items) }} item</td>
                <td class="font-semibold text-white">Rp {{ number_format($trx->total, 0, ',', '.') }}</td>
                <td><span class="badge badge-info capitalize">{{ $trx->payment_method }}</span></td>
                <td>
                    <span class="badge {{ $trx->status === 'completed' ? 'badge-success' : ($trx->status === 'pending' ? 'badge-warning' : 'badge-danger') }}">
                        {{ $trx->status === 'completed' ? 'Selesai' : ($trx->status === 'pending' ? 'Pending' : 'Batal') }}
                    </span>
                </td>
                <td class="text-xs text-dark-500">{{ $trx->created_at->format('d M Y H:i') }}</td>
            </tr>
            @empty
            <tr><td colspan="7" class="text-center py-8 text-dark-500">Belum ada transaksi</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $transactions->withQueryString()->links() }}</div>
@endsection
