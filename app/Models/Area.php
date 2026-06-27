<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Area extends Model
{
    protected $fillable = [
        'city_id',
        'name',
        'slug',
        'is_active',
    ];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
    public function compounds(): HasMany
    {
        return $this->hasMany(Compound::class);
    }
}
