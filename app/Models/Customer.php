<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    protected $fillable = [
        'tenant_id', 'name', 'email', 'phone', 'address',
        'total_purchases', 'total_transactions', 'last_purchase_at',
    ];

    protected function casts(): array
    {
        return [
            'total_purchases' => 'decimal:2',
            'last_purchase_at' => 'datetime',
        ];
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function scopeTenant($query, $tenantId)
    {
        return $query->where('tenant_id', $tenantId);
    }
}
