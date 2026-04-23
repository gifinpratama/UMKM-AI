<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role', 'tenant_id', 'business_name', 'business_type', 'phone', 'address', 'avatar', 'is_active'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isSeller(): bool
    {
        return $this->role === 'seller';
    }

    public function scopeAdmin($query)
    {
        return $query->where('role', 'admin');
    }

    public function scopeSeller($query)
    {
        return $query->where('role', 'seller');
    }

    public function umkmDatabase(): HasOne
    {
        return $this->hasOne(UmkmDatabase::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'tenant_id', 'tenant_id');
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'tenant_id', 'tenant_id');
    }

    public function customers(): HasMany
    {
        return $this->hasMany(Customer::class, 'tenant_id', 'tenant_id');
    }

    public function activityLogs(): HasMany
    {
        return $this->hasMany(ActivityLog::class);
    }
}
