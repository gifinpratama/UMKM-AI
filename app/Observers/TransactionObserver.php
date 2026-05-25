<?php

namespace App\Observers;

use App\Models\Transaction;
use Illuminate\Support\Facades\Cache;

class TransactionObserver
{
    /**
     * Clear relevant caches when a transaction is created/updated/deleted.
     */
    public function created(Transaction $transaction): void
    {
        $this->clearCache($transaction);
    }

    public function updated(Transaction $transaction): void
    {
        $this->clearCache($transaction);
    }

    public function deleted(Transaction $transaction): void
    {
        $this->clearCache($transaction);
    }

    protected function clearCache(Transaction $transaction): void
    {
        $tenantId = $transaction->tenant_id;

        // Clear seller dashboard caches
        Cache::forget("seller_stats_{$tenantId}");
        Cache::forget("seller_daily_revenue_{$tenantId}");
        Cache::forget("seller_payment_{$tenantId}");

        // Clear admin dashboard caches
        Cache::forget('admin_dashboard_stats');
        Cache::forget('admin_monthly_revenue');
        Cache::forget('admin_top_sellers');
    }
}
