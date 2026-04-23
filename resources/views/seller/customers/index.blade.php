@extends('layouts.app')
@section('title', 'Pelanggan')
@section('page_title', 'Manajemen Pelanggan')

@section('content')
<div class="flex items-center justify-between mb-6">
    <form method="GET"><input type="text" name="search" value="{{ request('search') }}" class="form-input w-64" placeholder="Cari pelanggan..."></form>
    <button onclick="document.getElementById('addModal').classList.remove('hidden')" class="btn-primary">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
        Tambah Pelanggan
    </button>
</div>

<div class="glass-card overflow-hidden">
    <table class="data-table">
        <thead><tr><th>Pelanggan</th><th>Kontak</th><th>Total Belanja</th><th>Transaksi</th><th>Terakhir Beli</th><th>Aksi</th></tr></thead>
        <tbody>
            @forelse($customers as $cust)
            <tr>
                <td>
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center text-white text-sm font-bold shrink-0">
                            {{ strtoupper(substr($cust->name, 0, 1)) }}
                        </div>
                        <div>
                            <p class="font-medium text-dark-200">{{ $cust->name }}</p>
                            <p class="text-xs text-dark-500">{{ $cust->address ?? '-' }}</p>
                        </div>
                    </div>
                </td>
                <td>
                    <p class="text-sm text-dark-300">{{ $cust->email ?? '-' }}</p>
                    <p class="text-xs text-dark-500">{{ $cust->phone ?? '-' }}</p>
                </td>
                <td class="font-medium text-dark-200">Rp {{ number_format($cust->total_purchases, 0, ',', '.') }}</td>
                <td class="text-center"><span class="badge badge-info">{{ $cust->total_transactions }}</span></td>
                <td class="text-xs text-dark-500">{{ $cust->last_purchase_at ? $cust->last_purchase_at->format('d M Y') : '-' }}</td>
                <td>
                    <form method="POST" action="{{ route('seller.customers.destroy', $cust) }}" class="inline" onsubmit="return confirm('Hapus pelanggan?')">
                        @csrf @method('DELETE')
                        <button class="p-1.5 rounded-lg hover:bg-white/5 text-dark-400 hover:text-red-400 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="text-center py-8 text-dark-500">Belum ada pelanggan</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $customers->links() }}</div>

{{-- Add Customer Modal --}}
<div id="addModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
    <div class="absolute inset-0 bg-black/60" onclick="document.getElementById('addModal').classList.add('hidden')"></div>
    <div class="glass-card p-8 w-full max-w-md relative z-10">
        <h3 class="text-lg font-semibold text-white mb-4">Tambah Pelanggan Baru</h3>
        <form method="POST" action="{{ route('seller.customers.store') }}" class="space-y-4">
            @csrf
            <div><label class="form-label">Nama</label><input type="text" name="name" class="form-input" required></div>
            <div><label class="form-label">Email</label><input type="email" name="email" class="form-input"></div>
            <div><label class="form-label">Telepon</label><input type="text" name="phone" class="form-input"></div>
            <div><label class="form-label">Alamat</label><textarea name="address" class="form-input" rows="2"></textarea></div>
            <div class="flex gap-3">
                <button type="submit" class="btn-primary">Simpan</button>
                <button type="button" onclick="document.getElementById('addModal').classList.add('hidden')" class="btn-secondary">Batal</button>
            </div>
        </form>
    </div>
</div>
@endsection
