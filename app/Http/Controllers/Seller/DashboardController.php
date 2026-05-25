<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Services\AIAnalyticsService;
use App\Models\Transaction;
use App\Models\Product;
use App\Models\Customer;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function index(AIAnalyticsService $ai)
    {
        $tenantId = auth()->user()->tenant_id;

        // Cache quick stats for 5 minutes per tenant
        $stats = Cache::remember("seller_stats_{$tenantId}", 300, function () use ($ai, $tenantId) {
            return $ai->getQuickStats($tenantId);
        });

        // Recent transactions — fresh data
        $recentTransactions = Transaction::tenant($tenantId)
            ->latest()
            ->take(5)
            ->get();

        // Low stock products — cache 3 minutes
        $lowStockProducts = Cache::remember("seller_lowstock_{$tenantId}", 180, function () use ($tenantId) {
            return Product::tenant($tenantId)
                ->where('stock', '<', 10)
                ->where('is_active', true)
                ->get();
        });

        // Daily revenue chart — cache 10 minutes
        $dailyRevenue = Cache::remember("seller_daily_revenue_{$tenantId}", 600, function () use ($tenantId) {
            return Transaction::tenant($tenantId)
                ->where('status', 'completed')
                ->where('created_at', '>=', now()->subDays(14))
                ->selectRaw("DATE(created_at) as date, SUM(total) as revenue")
                ->groupBy('date')
                ->orderBy('date')
                ->get();
        });

        // Payment method distribution — cache 10 minutes
        $paymentMethods = Cache::remember("seller_payment_{$tenantId}", 600, function () use ($tenantId) {
            return Transaction::tenant($tenantId)
                ->where('status', 'completed')
                ->whereMonth('created_at', now()->month)
                ->selectRaw("payment_method, COUNT(*) as count, SUM(total) as total")
                ->groupBy('payment_method')
                ->get();
        });

        return view('seller.dashboard', compact(
            'stats', 'recentTransactions', 'lowStockProducts',
            'dailyRevenue', 'paymentMethods'
        ));
    }
}
