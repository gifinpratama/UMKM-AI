@extends('layouts.app')
@section('title', 'Detail Transaksi')
@section('page_title', 'Detail Transaksi')
@section('page_subtitle', $transaction->transaction_code)

@section('content')
<div class="max-w-4xl mx-auto">
    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <a href="{{ route('seller.transactions.index') }}" class="btn-secondary text-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali
        </a>
        <span class="badge {{ $transaction->status === 'completed' ? 'badge-success' : ($transaction->status === 'pending' ? 'badge-warning' : 'badge-danger') }}">
            {{ ucfirst($transaction->status) }}
        </span>
    </div>

    {{-- Main Info --}}
    <div class="glass-card p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <p class="text-xs text-dark-500 mb-1">Kode Transaksi</p>
                <p class="text-sm font-mono font-semibold text-white">{{ $transaction->transaction_code }}</p>
            </div>
            <div>
                <p class="text-xs text-dark-500 mb-1">Pelanggan</p>
                <p class="text-sm font-semibold text-white">{{ $transaction->customer_name }}</p>
            </div>
            <div>
                <p class="text-xs text-dark-500 mb-1">Tanggal</p>
                <p class="text-sm font-semibold text-white">{{ $transaction->created_at->format('d M Y, H:i') }}</p>
            </div>
            <div>
                <p class="text-xs text-dark-500 mb-1">Metode Pembayaran</p>
                <p class="text-sm font-semibold text-white capitalize">{{ $transaction->payment_method }}</p>
            </div>
            <div>
                <p class="text-xs text-dark-500 mb-1">Status</p>
                <span class="badge {{ $transaction->status === 'completed' ? 'badge-success' : 'badge-warning' }}">{{ ucfirst($transaction->status) }}</span>
            </div>
            @if($transaction->notes)
            <div>
                <p class="text-xs text-dark-500 mb-1">Catatan</p>
                <p class="text-sm text-dark-300">{{ $transaction->notes }}</p>
            </div>
            @endif
        </div>
    </div>

    {{-- Items Table --}}
    <div class="glass-card p-6 mb-6">
        <h3 class="text-sm font-semibold text-white mb-4">Item Transaksi</h3>
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th class="text-center">Qty</th>
                        <th class="text-right">Harga</th>
                        <th class="text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaction->items as $item)
                    <tr>
                        <td class="font-medium text-dark-200">{{ $item['name'] }}</td>
                        <td class="text-center">{{ $item['quantity'] }}</td>
                        <td class="text-right">Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                        <td class="text-right font-medium text-white">Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Summary --}}
    <div class="glass-card p-6">
        <h3 class="text-sm font-semibold text-white mb-4">Ringkasan Pembayaran</h3>
        <div class="space-y-3">
            <div class="flex items-center justify-between text-sm">
                <span class="text-dark-400">Subtotal</span>
                <span class="text-dark-200">Rp {{ number_format($transaction->subtotal, 0, ',', '.') }}</span>
            </div>
            @if($transaction->discount > 0)
            <div class="flex items-center justify-between text-sm">
                <span class="text-dark-400">Diskon</span>
                <span class="text-red-400">- Rp {{ number_format($transaction->discount, 0, ',', '.') }}</span>
            </div>
            @endif
            @if($transaction->tax > 0)
            <div class="flex items-center justify-between text-sm">
                <span class="text-dark-400">Pajak</span>
                <span class="text-dark-200">+ Rp {{ number_format($transaction->tax, 0, ',', '.') }}</span>
            </div>
            @endif
            <div class="border-t border-white/10 pt-3 flex items-center justify-between">
                <span class="font-semibold text-white">Total</span>
                <span class="text-xl font-bold gradient-text">Rp {{ number_format($transaction->total, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    anime({ targets: '.glass-card', opacity: [0, 1], translateY: [20, 0], delay: anime.stagger(120), duration: 600, easing: 'easeOutCubic' });
});
</script>
@endpush
