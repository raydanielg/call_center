<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use BelongsToTenant;

    protected $fillable = [
        'call_id', 'agent_id', 'evaluator_id',
        'greeting_score', 'communication_score', 'problem_solving_score',
        'compliance_score', 'closing_score', 'total_score',
        'comments', 'status', 'tenant_id',
    ];

    public function call()
    {
        return $this->belongsTo(Call::class);
    }

    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

    public function evaluator()
    {
        return $this->belongsTo(User::class, 'evaluator_id');
    }
}
