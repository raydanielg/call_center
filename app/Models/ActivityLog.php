<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use BelongsToTenant;

    protected $fillable = [
        'user_id', 'action', 'model_type', 'model_id',
        'description', 'ip_address', 'tenant_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
