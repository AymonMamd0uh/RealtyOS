<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Plan extends Model
{
    protected $fillable = [

        'name',

        'price',

        'max_users',

        'max_properties',

        'trial_days',

        'is_active',

        'stripe_price_id',

        'paymob_plan_id',

        'sort_order',
    ];

    protected $casts = [

        'price' => 'decimal:2',

        'is_active' => 'boolean',
    ];

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }
}
