<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $tenantId = auth()->user()->tenant_id;
        $query = Customer::tenant($tenantId);

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                  ->orWhere('email', 'like', "%{$request->search}%")
                  ->orWhere('phone', 'like', "%{$request->search}%");
            });
        }

        $customers = $query->latest()->paginate(10);

        return view('seller.customers.index', compact('customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        Customer::create([
            'tenant_id' => auth()->user()->tenant_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        ActivityLog::log('create_customer', "Pelanggan baru: {$request->name}");

        return back()->with('success', 'Pelanggan berhasil ditambahkan!');
    }

    public function update(Request $request, Customer $customer)
    {
        if ($customer->tenant_id !== auth()->user()->tenant_id) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        $customer->update($request->only('name', 'email', 'phone', 'address'));
        ActivityLog::log('update_customer', "Pelanggan diupdate: {$customer->name}");

        return back()->with('success', 'Pelanggan berhasil diperbarui!');
    }

    public function destroy(Customer $customer)
    {
        if ($customer->tenant_id !== auth()->user()->tenant_id) {
            abort(403);
        }

        $name = $customer->name;
        $customer->delete();
        ActivityLog::log('delete_customer', "Pelanggan dihapus: {$name}");

        return back()->with('success', 'Pelanggan berhasil dihapus!');
    }
}
