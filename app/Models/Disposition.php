<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Model;

class Disposition extends Model
{
    use BelongsToTenant;

    protected $fillable = [
        'name', 'color', 'is_active', 'tenant_id',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function calls()
    {
        return $this->hasMany(Call::class);
    }
}
