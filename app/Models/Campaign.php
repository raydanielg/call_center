<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campaign extends Model
{
    use BelongsToTenant, SoftDeletes;

    protected $fillable = [
        'name', 'description', 'type', 'script', 'starts_at',
        'ends_at', 'status', 'created_by', 'tenant_id',
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function contacts()
    {
        return $this->hasMany(CampaignContact::class);
    }

    public function calls()
    {
        return $this->hasMany(Call::class);
    }
}
