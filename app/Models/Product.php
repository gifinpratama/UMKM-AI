<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = [
        'tenant_id', 'name', 'sku', 'category_id', 'price', 'cost_price',
        'stock', 'description', 'image', 'is_active',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'cost_price' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeTenant($query, $tenantId)
    {
        return $query->where('tenant_id', $tenantId);
    }

    public function getProfitMarginAttribute(): float
    {
        if ($this->cost_price <= 0) return 0;
        return round((($this->price - $this->cost_price) / $this->cost_price) * 100, 2);
    }
}
