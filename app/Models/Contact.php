<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use BelongsToTenant, SoftDeletes;

    protected $fillable = [
        'name', 'phone', 'email', 'company', 'address',
        'tags', 'notes', 'source', 'created_by', 'tenant_id',
    ];

    protected $casts = [
        'tags' => 'array',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function calls()
    {
        return $this->hasMany(Call::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function callbacks()
    {
        return $this->hasMany(Callback::class);
    }

    public function campaignContacts()
    {
        return $this->hasMany(CampaignContact::class);
    }
}
