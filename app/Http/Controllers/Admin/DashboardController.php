<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Product;
use App\Models\UmkmDatabase;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSellers = User::seller()->count();
        $activeSellers = User::seller()->where('is_active', true)->count();
        $totalDatabases = UmkmDatabase::where('status', 'active')->count();
        $totalTransactions = Transaction::where('status', 'completed')->count();
        $totalRevenue = Transaction::where('status', 'completed')->sum('total');
        $totalProducts = Product::count();

        // Monthly revenue trend
        $monthlyRevenue = Transaction::where('status', 'completed')
            ->where('created_at', '>=', now()->subMonths(6))
            ->selectRaw("strftime('%Y-%m', created_at) as month, SUM(total) as revenue")
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Recent sellers
        $recentSellers = User::seller()
            ->latest()
            ->take(5)
            ->get();

        // Recent activity
        $recentActivity = ActivityLog::with('user')
            ->latest()
            ->take(10)
            ->get();

        // Top sellers by revenue
        $topSellers = User::seller()
            ->get()
            ->map(function ($seller) {
                $seller->total_revenue = Transaction::where('tenant_id', $seller->tenant_id)
                    ->where('status', 'completed')
                    ->sum('total');
                return $seller;
            })
            ->sortByDesc('total_revenue')
            ->take(5);

        return view('admin.dashboard', compact(
            'totalSellers', 'activeSellers', 'totalDatabases', 'totalTransactions',
            'totalRevenue', 'totalProducts', 'monthlyRevenue', 'recentSellers',
            'recentActivity', 'topSellers'
        ));
    }
}
