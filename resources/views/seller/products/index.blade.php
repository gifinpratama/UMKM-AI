@extends('layouts.app')
@section('title', 'Produk')
@section('page_title', 'Manajemen Produk')
@section('page_subtitle', 'Kelola semua produk bisnis Anda')

@section('content')
<div class="flex items-center justify-between mb-6">
    <form method="GET" class="flex items-center gap-3">
        <input type="text" name="search" value="{{ request('search') }}" class="form-input w-64" placeholder="Cari produk...">
        <select name="category" class="form-input w-40" onchange="this.form.submit()">
            <option value="">Semua Kategori</option>
            @foreach($categories as $cat)
            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
            @endforeach
        </select>
    </form>
    <a href="{{ route('seller.products.create') }}" class="btn-primary">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
        Tambah Produk
    </a>
</div>

<div class="card-elevated" style="overflow:hidden;">
    <table class="data-table">
        <thead><tr><th>Produk</th><th>Kategori</th><th>Harga</th><th>Stok</th><th>Margin</th><th>Status</th><th>Aksi</th></tr></thead>
        <tbody>
            @forelse($products as $product)
            <tr>
                <td>
                    <div class="flex items-center gap-3">
                        <div style="width:40px;height:40px;border-radius:8px;background:var(--color-surface-soft);border:1px solid var(--color-border);display:flex;align-items:center;justify-content:center;color:var(--color-text-muted);flex-shrink:0;overflow:hidden;">
                            @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover">
                            @else
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                            @endif
                        </div>
                        <div>
                            <p style="font-family:var(--font-body);font-size:14px;font-weight:600;color:var(--color-text-primary);margin:0;">{{ $product->name }}</p>
                            <p style="font-family:var(--font-body);font-size:11px;color:var(--color-text-muted);margin:0;">{{ $product->sku ?? '-' }}</p>
                        </div>
                    </div>
                </td>
                <td>{{ $product->category->name ?? '-' }}</td>
                <td style="font-weight:600;color:var(--color-orange);">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                <td>
                    <span class="badge {{ $product->stock < 10 ? 'badge-warning' : 'badge-success' }}">{{ $product->stock }}</span>
                </td>
                <td style="font-weight:600;color:var(--color-success);">{{ $product->profit_margin }}%</td>
                <td><span class="badge {{ $product->is_active ? 'badge-success' : 'badge-danger' }}">{{ $product->is_active ? 'Aktif' : 'Nonaktif' }}</span></td>
                <td>
                    <div class="flex items-center gap-1">
                        <a href="{{ route('seller.products.edit', $product) }}" style="width:32px;height:32px;border-radius:6px;border:1px solid var(--color-border);display:inline-flex;align-items:center;justify-content:center;color:var(--color-text-muted);transition:all 0.2s;" onmouseover="this.style.background='var(--color-teal)';this.style.color='var(--color-text-primary)'" onmouseout="this.style.background='transparent';this.style.color='var(--color-text-muted)'">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </a>
                        <form method="POST" action="{{ route('seller.products.destroy', $product) }}" class="inline" onsubmit="return confirm('Hapus produk ini?')">
                            @csrf @method('DELETE')
                            <button style="width:32px;height:32px;border-radius:6px;border:1px solid var(--color-border);background:transparent;cursor:pointer;display:inline-flex;align-items:center;justify-content:center;color:var(--color-text-muted);transition:all 0.2s;" onmouseover="this.style.background='rgba(229,62,62,0.08)';this.style.color='var(--color-danger)'" onmouseout="this.style.background='transparent';this.style.color='var(--color-text-muted)'">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" style="text-align:center;padding:32px;color:var(--color-text-muted);">Belum ada produk. <a href="{{ route('seller.products.create') }}" style="color:var(--color-orange);">Tambah sekarang</a></td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $products->links() }}</div>
@endsection
