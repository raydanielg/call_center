<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use BelongsToTenant, SoftDeletes;

    protected $fillable = [
        'ticket_number', 'contact_id', 'assigned_to', 'created_by',
        'subject', 'description', 'category', 'priority', 'status',
        'sla_due_at', 'resolved_at', 'closed_at', 'tenant_id',
    ];

    protected $casts = [
        'sla_due_at' => 'datetime',
        'resolved_at' => 'datetime',
        'closed_at' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($ticket) {
            $year = now()->year;
            $count = static::whereYear('created_at', $year)->max('id') + 1;
            $ticket->ticket_number = 'TKT-' . $year . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);
        });
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function replies()
    {
        return $this->hasMany(TicketReply::class);
    }
}
