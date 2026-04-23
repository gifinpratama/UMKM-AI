@extends('layouts.app')
@section('title', 'Edit Produk')
@section('page_title', 'Edit Produk: ' . $product->name)

@section('content')
<div class="max-w-2xl">
    <div class="glass-card p-8">
        @if($errors->any())
        <div class="mb-4 p-3 rounded-lg bg-red-500/10 border border-red-500/20 text-red-400 text-sm">
            <ul class="list-disc list-inside space-y-1">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
        @endif

        <form method="POST" action="{{ route('seller.products.update', $product) }}" enctype="multipart/form-data" class="space-y-4">
            @csrf @method('PUT')
            <div class="grid grid-cols-2 gap-4">
                <div><label class="form-label">Nama Produk</label><input type="text" name="name" value="{{ old('name', $product->name) }}" class="form-input" required></div>
                <div><label class="form-label">SKU</label><input type="text" name="sku" value="{{ old('sku', $product->sku) }}" class="form-input"></div>
            </div>
            <div>
                <label class="form-label">Kategori</label>
                <select name="category_id" class="form-input">
                    <option value="">Tanpa Kategori</option>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="grid grid-cols-3 gap-4">
                <div><label class="form-label">Harga Jual (Rp)</label><input type="number" name="price" value="{{ old('price', $product->price) }}" class="form-input" required min="0"></div>
                <div><label class="form-label">Harga Modal (Rp)</label><input type="number" name="cost_price" value="{{ old('cost_price', $product->cost_price) }}" class="form-input" min="0"></div>
                <div><label class="form-label">Stok</label><input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="form-input" required min="0"></div>
            </div>
            <div><label class="form-label">Deskripsi</label><textarea name="description" class="form-input" rows="3">{{ old('description', $product->description) }}</textarea></div>
            <div><label class="form-label">Gambar Produk</label><input type="file" name="image" class="form-input" accept="image/*">
                @if($product->image)<p class="text-xs text-dark-500 mt-1">Saat ini: {{ $product->image }}</p>@endif
            </div>
            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-primary">Simpan Perubahan</button>
                <a href="{{ route('seller.products.index') }}" class="btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
