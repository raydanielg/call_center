<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CampaignContact extends Model
{
    protected $fillable = [
        'campaign_id', 'contact_id', 'assigned_agent_id',
        'status', 'attempts', 'last_called_at',
    ];

    protected $casts = [
        'last_called_at' => 'datetime',
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    public function agent()
    {
        return $this->belongsTo(User::class, 'assigned_agent_id');
    }
}
