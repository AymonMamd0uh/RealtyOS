<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PropertyImage extends Model
{
    protected $fillable = [
        'property_id',
        'image',
        'sort_order',
        'is_cover',
    ];

    protected $casts = [
        'is_cover' => 'boolean',
    ];

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    protected static function booted(): void
    {
        static::saving(function (PropertyImage $image) {

            if (! $image->is_cover) {
                return;
            }

            static::query()
                ->where('property_id', $image->property_id)
                ->where('id', '!=', $image->id)
                ->update([
                    'is_cover' => false,
                ]);
        });
    }
}