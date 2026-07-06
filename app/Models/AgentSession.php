<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Model;

class AgentSession extends Model
{
    use BelongsToTenant;

    protected $fillable = [
        'user_id', 'status', 'started_at', 'ended_at', 'duration', 'tenant_id',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
