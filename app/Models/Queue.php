<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    use BelongsToTenant;

    protected $fillable = [
        'name', 'description', 'strategy', 'max_wait_time',
        'greeting_audio', 'is_active', 'tenant_id',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function agents()
    {
        return $this->belongsToMany(User::class, 'queue_agent')->withPivot('priority')->withTimestamps();
    }

    public function calls()
    {
        return $this->hasMany(Call::class);
    }
}
