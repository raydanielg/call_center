<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'tenant_id', 'key', 'value',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public static function get($key, $tenantId = null, $default = null)
    {
        $setting = static::where('key', $key)
            ->where(function ($q) use ($tenantId) {
                $q->where('tenant_id', $tenantId)->orWhereNull('tenant_id');
            })
            ->first();

        return $setting?->value ?? $default;
    }

    public static function set($key, $value, $tenantId = null)
    {
        return static::updateOrCreate(
            ['key' => $key, 'tenant_id' => $tenantId],
            ['value' => $value]
        );
    }
}
