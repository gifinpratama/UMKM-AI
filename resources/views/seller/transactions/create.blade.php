@extends('layouts.app')
@section('title', 'Transaksi Baru')
@section('page_title', 'Catat Transaksi Baru')

@section('content')
<div class="max-w-4xl">
    <div class="card-elevated" style="padding:32px;">
        @if($errors->any())
        <div class="mb-4 p-3 rounded-lg bg-red-500/10 border border-red-500/20 text-red-400 text-sm">
            <ul class="list-disc list-inside">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
        @endif

        <form method="POST" action="{{ route('seller.transactions.store') }}" id="transactionForm">
            @csrf

            {{-- Customer --}}
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="form-label">Pelanggan</label>
                    <select name="customer_id" class="form-input" id="customerSelect">
                        <option value="">Walk-in Customer</option>
                        @foreach($customers as $cust)
                        <option value="{{ $cust->id }}">{{ $cust->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="form-label">Nama Pelanggan (Manual)</label>
                    <input type="text" name="customer_name" class="form-input" placeholder="Opsional jika pilih dari list">
                </div>
            </div>

            {{-- Items --}}
            <div class="mb-6">
                <div class="flex items-center justify-between mb-3">
                    <label class="form-label mb-0">Item Produk</label>
                    <button type="button" onclick="addItem()" class="btn-secondary text-xs py-1.5 px-3">+ Tambah Item</button>
                </div>
                <div id="items-container" class="space-y-3">
                    <div class="item-row grid grid-cols-12 gap-3 items-end p-3 rounded-lg bg-white/[0.02] border border-white/5">
                        <div class="col-span-5">
                            <label class="text-xs text-dark-500">Produk</label>
                            <select name="items[0][product_id]" class="form-input product-select" onchange="updatePrice(this)" required>
                                <option value="">Pilih produk</option>
                                @foreach($products as $p)
                                <option value="{{ $p->id }}" data-price="{{ $p->price }}">{{ $p->name }} (Stok: {{ $p->stock }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-2">
                            <label class="text-xs text-dark-500">Qty</label>
                            <input type="number" name="items[0][quantity]" class="form-input item-qty" value="1" min="1" required onchange="calcTotal()">
                        </div>
                        <div class="col-span-3">
                            <label class="text-xs text-dark-500">Harga</label>
                            <input type="number" name="items[0][price]" class="form-input item-price" value="0" min="0" required onchange="calcTotal()">
                        </div>
                        <div class="col-span-2 flex items-end gap-2">
                            <p class="text-sm font-semibold text-white item-subtotal pb-2.5">Rp 0</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Payment Details --}}
            <div class="grid grid-cols-3 gap-4 mb-6">
                <div>
                    <label class="form-label">Diskon (Rp)</label>
                    <input type="number" name="discount" value="0" class="form-input" min="0" id="discount" onchange="calcTotal()">
                </div>
                <div>
                    <label class="form-label">Pajak (Rp)</label>
                    <input type="number" name="tax" value="0" class="form-input" min="0" id="tax" onchange="calcTotal()">
                </div>
                <div>
                    <label class="form-label">Metode Bayar</label>
                    <select name="payment_method" class="form-input" required>
                        <option value="cash">Cash</option>
                        <option value="transfer">Transfer</option>
                        <option value="ewallet">E-Wallet</option>
                        <option value="qris">QRIS</option>
                        <option value="other">Lainnya</option>
                    </select>
                </div>
            </div>

            <div class="mb-6">
                <label class="form-label">Catatan</label>
                <textarea name="notes" class="form-input" rows="2" placeholder="Opsional"></textarea>
            </div>

            {{-- Total --}}
            <div class="p-4 rounded-xl bg-indigo-500/10 border border-indigo-500/20 mb-6 flex items-center justify-between">
                <span class="text-sm text-dark-300">Total Pembayaran</span>
                <span class="text-2xl font-bold gradient-text" id="grandTotal">Rp 0</span>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Simpan Transaksi
                </button>
                <a href="{{ route('seller.transactions.index') }}" class="btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
let itemIndex = 1;
const productsData = @json($products);

function addItem() {
    const container = document.getElementById('items-container');
    const html = `
    <div class="item-row grid grid-cols-12 gap-3 items-end p-3 rounded-lg bg-white/[0.02] border border-white/5">
        <div class="col-span-5">
            <select name="items[${itemIndex}][product_id]" class="form-input product-select" onchange="updatePrice(this)" required>
                <option value="">Pilih produk</option>
                ${productsData.map(p => `<option value="${p.id}" data-price="${p.price}">${p.name} (Stok: ${p.stock})</option>`).join('')}
            </select>
        </div>
        <div class="col-span-2"><input type="number" name="items[${itemIndex}][quantity]" class="form-input item-qty" value="1" min="1" required onchange="calcTotal()"></div>
        <div class="col-span-3"><input type="number" name="items[${itemIndex}][price]" class="form-input item-price" value="0" min="0" required onchange="calcTotal()"></div>
        <div class="col-span-2 flex items-end gap-2">
            <p class="text-sm font-semibold text-white item-subtotal pb-2.5">Rp 0</p>
            <button type="button" onclick="this.closest('.item-row').remove(); calcTotal();" class="p-1.5 rounded text-red-400 hover:bg-red-500/10 mb-1.5">✕</button>
        </div>
    </div>`;
    container.insertAdjacentHTML('beforeend', html);
    itemIndex++;
    anime({ targets: container.lastElementChild, opacity: [0, 1], translateY: [10, 0], duration: 300, easing: 'easeOutCubic' });
}

function updatePrice(select) {
    const row = select.closest('.item-row');
    const option = select.options[select.selectedIndex];
    const price = option.dataset.price || 0;
    row.querySelector('.item-price').value = price;
    calcTotal();
}

function calcTotal() {
    let subtotal = 0;
    document.querySelectorAll('.item-row').forEach(row => {
        const qty = parseFloat(row.querySelector('.item-qty').value) || 0;
        const price = parseFloat(row.querySelector('.item-price').value) || 0;
        const rowTotal = qty * price;
        row.querySelector('.item-subtotal').textContent = 'Rp ' + rowTotal.toLocaleString('id-ID');
        subtotal += rowTotal;
    });
    const discount = parseFloat(document.getElementById('discount').value) || 0;
    const tax = parseFloat(document.getElementById('tax').value) || 0;
    const grand = subtotal - discount + tax;
    document.getElementById('grandTotal').textContent = 'Rp ' + grand.toLocaleString('id-ID');
}
</script>
@endpush
