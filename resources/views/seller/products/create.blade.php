@extends('layouts.app')
@section('title', 'Tambah Produk')
@section('page_title', 'Tambah Produk Baru')

@section('content')
<div class="max-w-2xl">
    <div class="card-elevated" style="padding:32px;">
        @if($errors->any())
        <div class="mb-4 p-3 rounded-lg bg-red-500/10 border border-red-500/20 text-red-400 text-sm">
            <ul class="list-disc list-inside space-y-1">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
        @endif

        <form method="POST" action="{{ route('seller.products.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div><label class="form-label">Nama Produk</label><input type="text" name="name" value="{{ old('name') }}" class="form-input" required></div>
                <div><label class="form-label">SKU</label><input type="text" name="sku" value="{{ old('sku') }}" class="form-input" placeholder="Opsional"></div>
            </div>
            <div>
                <label class="form-label">Kategori</label>
                <select name="category_id" class="form-input">
                    <option value="">Tanpa Kategori</option>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="grid grid-cols-3 gap-4">
                <div><label class="form-label">Harga Jual (Rp)</label><input type="number" name="price" value="{{ old('price') }}" class="form-input" required min="0"></div>
                <div><label class="form-label">Harga Modal (Rp)</label><input type="number" name="cost_price" value="{{ old('cost_price', 0) }}" class="form-input" min="0"></div>
                <div><label class="form-label">Stok</label><input type="number" name="stock" value="{{ old('stock', 0) }}" class="form-input" required min="0"></div>
            </div>
            <div><label class="form-label">Deskripsi</label><textarea name="description" class="form-input" rows="3">{{ old('description') }}</textarea></div>
            <div><label class="form-label">Gambar Produk</label><input type="file" name="image" class="form-input" accept="image/*"></div>
            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-primary">Simpan Produk</button>
                <a href="{{ route('seller.products.index') }}" class="btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
