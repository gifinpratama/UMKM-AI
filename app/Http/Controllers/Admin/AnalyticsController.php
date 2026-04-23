<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function index()
    {
        // Global stats
        $totalRevenue = Transaction::where('status', 'completed')->sum('total');
        $totalTransactions = Transaction::where('status', 'completed')->count();
        $totalProducts = Product::count();
        $totalCustomers = Customer::count();

        // Monthly revenue trend (last 6 months)
        $monthlyRevenue = Transaction::where('status', 'completed')
            ->where('created_at', '>=', now()->subMonths(6))
            ->selectRaw("strftime('%Y-%m', created_at) as month, SUM(total) as revenue, COUNT(*) as count")
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Revenue by seller
        $sellerRevenue = User::seller()
            ->where('is_active', true)
            ->get()
            ->map(function ($seller) {
                $revenue = Transaction::where('tenant_id', $seller->tenant_id)
                    ->where('status', 'completed')
                    ->sum('total');
                $transactions = Transaction::where('tenant_id', $seller->tenant_id)
                    ->where('status', 'completed')
                    ->count();
                return [
                    'name' => $seller->business_name,
                    'revenue' => $revenue,
                    'transactions' => $transactions,
                ];
            })
            ->sortByDesc('revenue')
            ->values();

        // Business type distribution
        $businessTypes = User::seller()
            ->selectRaw('business_type, COUNT(*) as count')
            ->groupBy('business_type')
            ->get();

        // Daily transactions this month
        $dailyTransactions = Transaction::where('status', 'completed')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->selectRaw("strftime('%Y-%m-%d', created_at) as date, SUM(total) as revenue, COUNT(*) as count")
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Payment method distribution (global)
        $paymentMethods = Transaction::where('status', 'completed')
            ->whereMonth('created_at', now()->month)
            ->selectRaw('payment_method, COUNT(*) as count, SUM(total) as total')
            ->groupBy('payment_method')
            ->get();

        // This month vs last month
        $revenueThisMonth = Transaction::where('status', 'completed')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total');

        $revenueLastMonth = Transaction::where('status', 'completed')
            ->whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->sum('total');

        $growthPercent = $revenueLastMonth > 0
            ? round((($revenueThisMonth - $revenueLastMonth) / $revenueLastMonth) * 100, 2)
            : 0;

        return view('admin.analytics', compact(
            'totalRevenue', 'totalTransactions', 'totalProducts', 'totalCustomers',
            'monthlyRevenue', 'sellerRevenue', 'businessTypes',
            'dailyTransactions', 'paymentMethods',
            'revenueThisMonth', 'revenueLastMonth', 'growthPercent'
        ));
    }
}
