<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{

    protected $fillable = [
        'name', 'price', 'billing_cycle', 'max_agents',
        'max_calls_per_month', 'max_storage_mb', 'features', 'is_active',
    ];

    protected $casts = [
        'features' => 'array',
        'price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function tenants()
    {
        return $this->hasManyThrough(Tenant::class, Subscription::class);
    }
}
