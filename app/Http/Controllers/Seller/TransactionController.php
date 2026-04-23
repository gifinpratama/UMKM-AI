<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Product;
use App\Models\Customer;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $tenantId = auth()->user()->tenant_id;
        $query = Transaction::tenant($tenantId);

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('transaction_code', 'like', "%{$request->search}%")
                  ->orWhere('customer_name', 'like', "%{$request->search}%");
            });
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->date_from) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->date_to) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $transactions = $query->latest()->paginate(10);

        return view('seller.transactions.index', compact('transactions'));
    }

    public function create()
    {
        $tenantId = auth()->user()->tenant_id;
        $products = Product::tenant($tenantId)->where('is_active', true)->where('stock', '>', 0)->get();
        $customers = Customer::tenant($tenantId)->get();

        return view('seller.transactions.create', compact('products', 'customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
            'customer_id' => 'nullable|exists:customers,id',
            'customer_name' => 'nullable|string|max:255',
            'discount' => 'nullable|numeric|min:0',
            'tax' => 'nullable|numeric|min:0',
            'payment_method' => 'required|in:cash,transfer,ewallet,qris,other',
            'notes' => 'nullable|string',
        ]);

        $tenantId = auth()->user()->tenant_id;
        
        // Calculate totals
        $items = collect($request->items)->map(function ($item) {
            $product = Product::find($item['product_id']);
            return [
                'product_id' => $item['product_id'],
                'name' => $product->name,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'subtotal' => $item['quantity'] * $item['price'],
            ];
        });

        $subtotal = $items->sum('subtotal');
        $discount = $request->discount ?? 0;
        $tax = $request->tax ?? 0;
        $total = $subtotal - $discount + $tax;

        $transaction = Transaction::create([
            'tenant_id' => $tenantId,
            'transaction_code' => Transaction::generateCode($tenantId),
            'customer_id' => $request->customer_id,
            'customer_name' => $request->customer_name ?? Customer::find($request->customer_id)?->name ?? 'Walk-in',
            'items' => $items->toArray(),
            'subtotal' => $subtotal,
            'discount' => $discount,
            'tax' => $tax,
            'total' => $total,
            'payment_method' => $request->payment_method,
            'status' => 'completed',
            'notes' => $request->notes,
        ]);

        // Update stock
        foreach ($request->items as $item) {
            Product::where('id', $item['product_id'])->decrement('stock', $item['quantity']);
        }

        // Update customer stats
        if ($request->customer_id) {
            $customer = Customer::find($request->customer_id);
            $customer->increment('total_purchases', $total);
            $customer->increment('total_transactions');
            $customer->update(['last_purchase_at' => now()]);
        }

        ActivityLog::log('create_transaction', "Transaksi baru: {$transaction->transaction_code}");

        return redirect()->route('seller.transactions.index')->with('success', 'Transaksi berhasil dicatat!');
    }

    public function show(Transaction $transaction)
    {
        if ($transaction->tenant_id !== auth()->user()->tenant_id) {
            abort(403);
        }
        return view('seller.transactions.show', compact('transaction'));
    }
}
