<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Services\AIAnalyticsService;
use App\Models\Transaction;
use App\Models\Product;
use App\Models\Customer;
use App\Models\ActivityLog;

class DashboardController extends Controller
{
    public function index(AIAnalyticsService $ai)
    {
        $tenantId = auth()->user()->tenant_id;
        $stats = $ai->getQuickStats($tenantId);

        // Recent transactions
        $recentTransactions = Transaction::tenant($tenantId)
            ->latest()
            ->take(5)
            ->get();

        // Low stock products
        $lowStockProducts = Product::tenant($tenantId)
            ->where('stock', '<', 10)
            ->where('is_active', true)
            ->get();

        // Daily revenue for chart (last 14 days)
        $dailyRevenue = Transaction::tenant($tenantId)
            ->where('status', 'completed')
            ->where('created_at', '>=', now()->subDays(14))
            ->selectRaw("DATE(created_at) as date, SUM(total) as revenue")
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Payment method distribution
        $paymentMethods = Transaction::tenant($tenantId)
            ->where('status', 'completed')
            ->whereMonth('created_at', now()->month)
            ->selectRaw("payment_method, COUNT(*) as count, SUM(total) as total")
            ->groupBy('payment_method')
            ->get();

        return view('seller.dashboard', compact(
            'stats', 'recentTransactions', 'lowStockProducts',
            'dailyRevenue', 'paymentMethods'
        ));
    }
}
