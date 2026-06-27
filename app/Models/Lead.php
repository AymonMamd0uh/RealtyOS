<?php

namespace App\Models;

use App\Enums\LeadStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lead extends Model
{
    protected $fillable = [
        'company_id',
        'assigned_to',
        'property_id',

        'budget_min',
        'budget_max',

        'city_id',
        'area_id',
        'compound_id',

        'property_type',

        'bedrooms',
        'bathrooms',

        'min_area',
        'max_area',

        'name',
        'phone',
        'email',

        'source',
        'notes',

        'status',

        'next_follow_up_at',
        'follow_up_completed',
    ];

    protected function casts(): array
    {
        return [
            'status' => LeadStatus::class,

            'budget_min' => 'decimal:2',
            'budget_max' => 'decimal:2',

            'next_follow_up_at' => 'datetime',
            'follow_up_completed' => 'boolean',
        ];
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
    public function activities(): HasMany
    {
        return $this->hasMany(LeadActivity::class);
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
}
