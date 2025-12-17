<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class PerformanceNode extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'code',
        'title',
        'level_type',
        'parent_id',
        'status',
        'note',
        'source_page'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(PerformanceNode::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(PerformanceNode::class, 'parent_id');
    }

    public function indicators(): HasMany
    {
        return $this->hasMany(PerformanceIndicator::class, 'node_id');
    }

    public function units(): BelongsToMany
    {
        return $this->belongsToMany(Unit::class, 'node_units', 'node_id', 'unit_id');
    }
}
