<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Unit extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
    ];

    public function nodes(): BelongsToMany
    {
        return $this->belongsToMany(PerformanceNode::class, 'node_units', 'unit_id', 'node_id');
    }
}
