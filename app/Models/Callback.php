<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Model;

class Callback extends Model
{
    use BelongsToTenant;

    protected $fillable = [
        'contact_id', 'agent_id', 'call_id', 'scheduled_at',
        'status', 'notes', 'tenant_id',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
    ];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

    public function call()
    {
        return $this->belongsTo(Call::class);
    }
}
