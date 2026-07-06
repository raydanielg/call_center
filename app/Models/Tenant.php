<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tenant extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'slug', 'email', 'phone', 'logo', 'address',
        'country', 'status', 'trial_ends_at',
    ];

    protected $casts = [
        'trial_ends_at' => 'datetime',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function subscription()
    {
        return $this->hasOne(Subscription::class)->latestOfMany();
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function calls()
    {
        return $this->hasMany(Call::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function campaigns()
    {
        return $this->hasMany(Campaign::class);
    }

    public function queues()
    {
        return $this->hasMany(Queue::class);
    }

    public function dispositions()
    {
        return $this->hasMany(Disposition::class);
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }

    public function settings()
    {
        return $this->hasMany(Setting::class);
    }

    public function isActive()
    {
        return $this->status === 'active';
    }

    public function plan()
    {
        return $this->subscription?->plan;
    }
}
