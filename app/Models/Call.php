<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Model;

class Call extends Model
{
    use BelongsToTenant;

    protected $fillable = [
        'contact_id', 'agent_id', 'queue_id', 'campaign_id',
        'direction', 'phone_number', 'status', 'started_at',
        'answered_at', 'ended_at', 'duration', 'wait_time',
        'recording_url', 'disposition_id', 'notes',
        'provider_call_id', 'tenant_id',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'answered_at' => 'datetime',
        'ended_at' => 'datetime',
    ];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

    public function queue()
    {
        return $this->belongsTo(Queue::class);
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function disposition()
    {
        return $this->belongsTo(Disposition::class);
    }

    public function evaluation()
    {
        return $this->hasOne(Evaluation::class);
    }

    public function callbacks()
    {
        return $this->hasMany(Callback::class);
    }
}
