<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Compound extends Model
{
    protected $fillable = [
        'area_id',
        'name',
        'slug',
        'is_active',
    ];

    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }
    public function stages(): HasMany
    {
        return $this->hasMany(Stage::class);
    }
}
