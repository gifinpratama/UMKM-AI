<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Product;
use App\Models\UmkmDatabase;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function index()
    {
        // Cache dashboard stats for 5 minutes
        $stats = Cache::remember('admin_dashboard_stats', 300, function () {
            return [
                'totalSellers' => User::seller()->count(),
                'activeSellers' => User::seller()->where('is_active', true)->count(),
                'totalDatabases' => UmkmDatabase::where('status', 'active')->count(),
                'totalTransactions' => Transaction::where('status', 'completed')->count(),
                'totalRevenue' => Transaction::where('status', 'completed')->sum('total'),
                'totalProducts' => Product::count(),
            ];
        });

        // Cache monthly revenue for 10 minutes
        $monthlyRevenue = Cache::remember('admin_monthly_revenue', 600, function () {
            return Transaction::where('status', 'completed')
                ->where('created_at', '>=', now()->subMonths(6))
                ->selectRaw("strftime('%Y-%m', created_at) as month, SUM(total) as revenue")
                ->groupBy('month')
                ->orderBy('month')
                ->get();
        });

        // Recent sellers — no cache (needs to be fresh)
        $recentSellers = User::seller()
            ->latest()
            ->take(5)
            ->get();

        // Recent activity — no cache
        $recentActivity = ActivityLog::with('user')
            ->latest()
            ->take(10)
            ->get();

        // Top sellers — fixed N+1 query with single subquery + cache
        $topSellers = Cache::remember('admin_top_sellers', 600, function () {
            return User::seller()
                ->select('users.*')
                ->selectSub(
                    Transaction::selectRaw('COALESCE(SUM(total), 0)')
                        ->whereColumn('transactions.tenant_id', 'users.tenant_id')
                        ->where('status', 'completed'),
                    'total_revenue'
                )
                ->orderByDesc('total_revenue')
                ->take(5)
                ->get();
        });

        // Extract stats for view
        extract($stats);

        return view('admin.dashboard', compact(
            'totalSellers', 'activeSellers', 'totalDatabases', 'totalTransactions',
            'totalRevenue', 'totalProducts', 'monthlyRevenue', 'recentSellers',
            'recentActivity', 'topSellers'
        ));
    }
}
