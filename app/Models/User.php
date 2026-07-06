<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'email',
        'phone',
        'role',
        'password',
        'tenant_id',
        'avatar',
        'status',
        'agent_status',
        'extension_number',
        'last_login_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'last_login_at' => 'datetime',
        ];
    }

    public function getFullNameAttribute()
    {
        return trim(($this->first_name ?? '') . ' ' . ($this->last_name ?? '')) ?: $this->name;
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function calls()
    {
        return $this->hasMany(Call::class, 'agent_id');
    }

    public function ticketsAssigned()
    {
        return $this->hasMany(Ticket::class, 'assigned_to');
    }

    public function ticketsCreated()
    {
        return $this->hasMany(Ticket::class, 'created_by');
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class, 'agent_id');
    }

    public function agentSessions()
    {
        return $this->hasMany(AgentSession::class);
    }

    public function isSuperAdmin()
    {
        return $this->hasRole('super_admin');
    }

    public function isCompanyAdmin()
    {
        return $this->hasRole('company_admin');
    }

    public function isSupervisor()
    {
        return $this->hasRole('supervisor');
    }

    public function isAgent()
    {
        return $this->hasRole('agent');
    }

    public function isQaAnalyst()
    {
        return $this->hasRole('qa_analyst');
    }
}
