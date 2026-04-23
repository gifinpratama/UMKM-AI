<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    protected $fillable = [
        'tenant_id', 'transaction_code', 'customer_id', 'customer_name',
        'items', 'subtotal', 'discount', 'tax', 'total',
        'payment_method', 'status', 'notes',
    ];

    protected function casts(): array
    {
        return [
            'items' => 'array',
            'subtotal' => 'decimal:2',
            'discount' => 'decimal:2',
            'tax' => 'decimal:2',
            'total' => 'decimal:2',
        ];
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function scopeTenant($query, $tenantId)
    {
        return $query->where('tenant_id', $tenantId);
    }

    public static function generateCode($tenantId): string
    {
        $prefix = strtoupper(substr($tenantId, 0, 4));
        $date = now()->format('Ymd');
        $count = static::where('tenant_id', $tenantId)->whereDate('created_at', today())->count() + 1;
        return "TRX-{$prefix}-{$date}-" . str_pad($count, 4, '0', STR_PAD_LEFT);
    }
}
