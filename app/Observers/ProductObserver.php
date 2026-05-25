<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class ProductObserver
{
    public function created(Product $product): void
    {
        $this->clearCache($product);
    }

    public function updated(Product $product): void
    {
        $this->clearCache($product);
    }

    public function deleted(Product $product): void
    {
        $this->clearCache($product);
    }

    protected function clearCache(Product $product): void
    {
        $tenantId = $product->tenant_id;

        // Clear seller caches
        Cache::forget("seller_stats_{$tenantId}");
        Cache::forget("seller_lowstock_{$tenantId}");

        // Clear admin caches
        Cache::forget('admin_dashboard_stats');
    }
}
