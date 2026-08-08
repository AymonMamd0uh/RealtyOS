<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Enums\PropertyType;
use App\Enums\ListingType;
use App\Enums\PropertyStatus;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Property extends Model
{
    protected $fillable = [
        'company_id',
        'user_id',

        'reference_number',

        'title',
        'description',
        'owner_name',
        'owner_phone',
        'owner_email',
        'property_type',
        'listing_type',

        'city_id',
        'area_id',
        'compound_id',
        'stage_id',
        'group_name',
        'building_number',
        'unit_number',
        'price',

        'built_area',
        'land_area',

        'bedrooms',
        'bathrooms',

        'floor_number',

        'is_furnished',

        'status',
        'internal_notes',
    ];
    protected function casts(): array
    {
        return [
            'property_type' => PropertyType::class,
            'listing_type' => ListingType::class,
            'status' => PropertyStatus::class,

            'is_furnished' => 'boolean',
        ];
    }
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }

    public function compound(): BelongsTo
    {
        return $this->belongsTo(Compound::class);
    }

    public function stage(): BelongsTo
    {
        return $this->belongsTo(Stage::class);
    }
    public function images(): HasMany
    {
        return $this->hasMany(PropertyImage::class)
            ->orderBy('sort_order');
    }
    public function coverImage(): HasOne
    {
        return $this->hasOne(PropertyImage::class)
            ->where('is_cover', true);
    }
    public function features(): BelongsToMany
    {
        return $this->belongsToMany(Feature::class);
    }
    public function canViewInternalInformation($user): bool
    {
        if (! $user) {
            return false;
        }

        if ($user->hasRole('Platform Admin')) {
            return true;
        }

        if (
            $user->hasRole('Owner') ||
            $user->hasRole('Super Admin')
        ) {
            return $user->company_id === $this->company_id;
        }

        if ($user->hasRole('Manager')) {
            return $user->company_id === $this->company_id;
        }

        if ($user->hasRole('Agent')) {
            return $this->user_id === $user->id;
        }

        return false;
    }
}
