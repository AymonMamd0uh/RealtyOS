<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stage extends Model
{
    protected $fillable = [
        'compound_id',
        'name',
        'slug',
        'is_active',
    ];

    public function compound(): BelongsTo
    {
        return $this->belongsTo(Compound::class);
    }
}