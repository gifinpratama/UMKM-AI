@extends('layouts.app')
@section('title', 'Tambah Seller & Database')
@section('page_title', 'Tambah Seller & Database Baru')
@section('page_subtitle', 'Buat akun seller UMKM dan database terpisah')

@section('content')
<div class="max-w-3xl">
    <div class="glass-card p-8">
        @if($errors->any())
        <div class="mb-6 p-4 rounded-lg bg-red-500/10 border border-red-500/20 text-red-400 text-sm">
            <ul class="list-disc list-inside space-y-1">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
        @endif

        <form method="POST" action="{{ route('admin.sellers.store') }}" class="space-y-6">
            @csrf

            {{-- Informasi Seller --}}
            <div>
                <h3 class="text-sm font-semibold text-white mb-4 flex items-center gap-2">
                    <div class="w-6 h-6 rounded-md bg-indigo-500/20 flex items-center justify-center"><span class="text-xs text-indigo-400 font-bold">1</span></div>
                    Informasi Seller
                </h3>
                <div class="grid grid-cols-2 gap-4">
                    <div><label class="form-label">Nama Lengkap</label><input type="text" name="name" value="{{ old('name') }}" class="form-input" required></div>
                    <div><label class="form-label">Email</label><input type="email" name="email" value="{{ old('email') }}" class="form-input" required></div>
                    <div><label class="form-label">Password</label><input type="password" name="password" class="form-input" required></div>
                    <div><label class="form-label">No. Telepon</label><input type="text" name="phone" value="{{ old('phone') }}" class="form-input"></div>
                </div>
            </div>

            <hr class="border-white/5">

            {{-- Informasi Bisnis --}}
            <div>
                <h3 class="text-sm font-semibold text-white mb-4 flex items-center gap-2">
                    <div class="w-6 h-6 rounded-md bg-emerald-500/20 flex items-center justify-center"><span class="text-xs text-emerald-400 font-bold">2</span></div>
                    Informasi Bisnis UMKM
                </h3>
                <div class="grid grid-cols-2 gap-4">
                    <div><label class="form-label">Nama Bisnis</label><input type="text" name="business_name" value="{{ old('business_name') }}" class="form-input" required></div>
                    <div>
                        <label class="form-label">Jenis Bisnis</label>
                        <select name="business_type" class="form-input" required>
                            <option value="">Pilih jenis</option>
                            <option value="Makanan & Minuman">Makanan & Minuman</option>
                            <option value="Fashion">Fashion</option>
                            <option value="Elektronik">Elektronik</option>
                            <option value="Kerajinan">Kerajinan</option>
                            <option value="Jasa">Jasa</option>
                            <option value="Pertanian">Pertanian</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div class="col-span-2"><label class="form-label">Alamat</label><textarea name="address" class="form-input" rows="2">{{ old('address') }}</textarea></div>
                </div>
            </div>

            <hr class="border-white/5">

            {{-- Database Configuration --}}
            <div>
                <h3 class="text-sm font-semibold text-white mb-4 flex items-center gap-2">
                    <div class="w-6 h-6 rounded-md bg-purple-500/20 flex items-center justify-center"><span class="text-xs text-purple-400 font-bold">3</span></div>
                    Konfigurasi Database
                </h3>
                <div class="grid grid-cols-2 gap-4">
                    <div><label class="form-label">Nama Database</label><input type="text" name="db_name" value="{{ old('db_name') }}" class="form-input" placeholder="DB-TOKOJAYA" required></div>
                    <div><label class="form-label">Deskripsi (Opsional)</label><input type="text" name="db_description" value="{{ old('db_description') }}" class="form-input" placeholder="Database utama toko"></div>
                </div>
                <div class="mt-3 p-3 rounded-lg bg-indigo-500/5 border border-indigo-500/10">
                    <p class="text-xs text-dark-400">
                        <svg class="w-4 h-4 inline text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Database akan dibuat secara otomatis dengan tenant ID unik. Data seller akan terisolasi dan aman.
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                    Buat Seller & Database
                </button>
                <a href="{{ route('admin.sellers.index') }}" class="btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
