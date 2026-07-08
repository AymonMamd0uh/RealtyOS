<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaymentTransaction extends Model
{
    protected $fillable = [

        'company_id',

        'subscription_id',

        'provider',

        'provider_transaction_id',

        'provider_order_id',

        'merchant_order_id',

        'amount',

        'currency',

        'status',

        'payload',

        'paid_at',

    ];

    protected $casts = [

        'payload' => 'array',

        'paid_at' => 'datetime',

    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function subscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class);
    }
}