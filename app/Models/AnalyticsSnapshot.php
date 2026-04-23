<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnalyticsSnapshot extends Model
{
    protected $fillable = [
        'tenant_id', 'type', 'data', 'insights', 'ai_response', 'generated_at',
    ];

    protected function casts(): array
    {
        return [
            'data' => 'array',
            'insights' => 'array',
            'ai_response' => 'array',
            'generated_at' => 'datetime',
        ];
    }

    public function scopeTenant($query, $tenantId)
    {
        return $query->where('tenant_id', $tenantId);
    }
}
