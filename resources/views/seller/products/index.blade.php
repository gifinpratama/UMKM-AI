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

<div class="glass-card overflow-hidden">
    <table class="data-table">
        <thead><tr><th>Produk</th><th>Kategori</th><th>Harga</th><th>Stok</th><th>Margin</th><th>Status</th><th>Aksi</th></tr></thead>
        <tbody>
            @forelse($products as $product)
            <tr>
                <td>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-dark-800 flex items-center justify-center text-xs text-dark-400 shrink-0 overflow-hidden">
                            @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover">
                            @else
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                            @endif
                        </div>
                        <div>
                            <p class="font-medium text-dark-200">{{ $product->name }}</p>
                            <p class="text-[10px] text-dark-500">{{ $product->sku ?? '-' }}</p>
                        </div>
                    </div>
                </td>
                <td>{{ $product->category->name ?? '-' }}</td>
                <td class="font-medium text-dark-200">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                <td>
                    <span class="badge {{ $product->stock < 10 ? 'badge-warning' : 'badge-success' }}">{{ $product->stock }}</span>
                </td>
                <td class="text-emerald-400">{{ $product->profit_margin }}%</td>
                <td><span class="badge {{ $product->is_active ? 'badge-success' : 'badge-danger' }}">{{ $product->is_active ? 'Aktif' : 'Nonaktif' }}</span></td>
                <td>
                    <div class="flex items-center gap-1">
                        <a href="{{ route('seller.products.edit', $product) }}" class="p-1.5 rounded-lg hover:bg-white/5 text-dark-400 hover:text-indigo-400 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </a>
                        <form method="POST" action="{{ route('seller.products.destroy', $product) }}" class="inline" onsubmit="return confirm('Hapus produk ini?')">
                            @csrf @method('DELETE')
                            <button class="p-1.5 rounded-lg hover:bg-white/5 text-dark-400 hover:text-red-400 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" class="text-center py-8 text-dark-500">Belum ada produk. <a href="{{ route('seller.products.create') }}" class="text-indigo-400">Tambah sekarang</a></td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $products->links() }}</div>
@endsection
