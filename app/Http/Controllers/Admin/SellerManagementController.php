<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UmkmDatabase;
use App\Models\ActivityLog;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SellerManagementController extends Controller
{
    public function index(Request $request)
    {
        $query = User::seller()->with('umkmDatabase');
        
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                  ->orWhere('business_name', 'like', "%{$request->search}%")
                  ->orWhere('email', 'like', "%{$request->search}%");
            });
        }

        if ($request->status === 'active') {
            $query->where('is_active', true);
        } elseif ($request->status === 'inactive') {
            $query->where('is_active', false);
        }

        $sellers = $query->latest()->paginate(10);

        return view('admin.sellers.index', compact('sellers'));
    }

    public function create()
    {
        return view('admin.sellers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'business_name' => 'required|string|max:255',
            'business_type' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'db_name' => 'required|string|max:255',
            'db_description' => 'nullable|string',
        ]);

        $tenantId = 'tenant_' . Str::random(12);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'seller',
            'tenant_id' => $tenantId,
            'business_name' => $request->business_name,
            'business_type' => $request->business_type,
            'phone' => $request->phone,
            'address' => $request->address,
            'is_active' => true,
        ]);

        UmkmDatabase::create([
            'user_id' => $user->id,
            'tenant_id' => $tenantId,
            'db_name' => $request->db_name,
            'db_description' => $request->db_description,
            'status' => 'active',
            'created_by' => auth()->id(),
        ]);

        ActivityLog::log('create_seller', "Admin membuat seller baru: {$user->business_name}", [
            'seller_id' => $user->id,
            'tenant_id' => $tenantId,
        ]);

        return redirect()->route('admin.sellers.index')->with('success', 'Seller dan database baru berhasil dibuat!');
    }

    public function show(User $seller)
    {
        $seller->load('umkmDatabase');
        
        $stats = [
            'total_products' => \App\Models\Product::where('tenant_id', $seller->tenant_id)->count(),
            'total_transactions' => Transaction::where('tenant_id', $seller->tenant_id)->count(),
            'total_revenue' => Transaction::where('tenant_id', $seller->tenant_id)->where('status', 'completed')->sum('total'),
            'total_customers' => \App\Models\Customer::where('tenant_id', $seller->tenant_id)->count(),
        ];

        $recentTransactions = Transaction::where('tenant_id', $seller->tenant_id)
            ->latest()
            ->take(10)
            ->get();

        return view('admin.sellers.show', compact('seller', 'stats', 'recentTransactions'));
    }

    public function toggleStatus(User $seller)
    {
        $seller->update(['is_active' => !$seller->is_active]);
        $status = $seller->is_active ? 'diaktifkan' : 'dinonaktifkan';
        
        ActivityLog::log('toggle_seller', "Seller {$seller->business_name} {$status}");

        return back()->with('success', "Seller berhasil {$status}!");
    }

    public function destroy(User $seller)
    {
        $businessName = $seller->business_name;
        $seller->delete();
        
        ActivityLog::log('delete_seller', "Seller {$businessName} dihapus");

        return redirect()->route('admin.sellers.index')->with('success', 'Seller berhasil dihapus!');
    }
}
