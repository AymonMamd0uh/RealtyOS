<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subscription extends Model
{
   protected $fillable = [

    'company_id',

    'plan_id',

    'status',

    'trial_ends_at',

    'starts_at',

    'ends_at',

    'cancelled_at',

    'provider',

    'provider_subscription_id',

    'merchant_order_id',

    'provider_transaction_id',

    'provider_order_id',

    'provider_intention_id',

    'paid_amount',

    'paid_currency',

    'paid_at',

    'is_lifetime',

    'notes',

];

    protected $casts = [

        'trial_ends_at' => 'datetime',

        'starts_at' => 'datetime',

        'ends_at' => 'datetime',

        'cancelled_at' => 'datetime',
        'is_lifetime' => 'boolean',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }
public function paymentTransactions(): HasMany
{
    return $this->hasMany(PaymentTransaction::class);
}
}
