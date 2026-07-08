<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Company extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'company_code',
        'email',
        'phone',
        'website',
        'logo',
        'primary_color',
        'address',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function properties(): HasMany
    {
        return $this->hasMany(Property::class);
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    public function activeSubscription(): HasOne
    {
        return $this->hasOne(Subscription::class)->latestOfMany();
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    public function isOnTrial(): bool
    {
        $subscription = $this->activeSubscription;

        return $subscription
            && $subscription->status === 'trial'
            && $subscription->trial_ends_at?->isFuture();
    }

    public function hasActiveSubscription(): bool
    {
        $subscription = $this->activeSubscription;

        return $subscription
            && $subscription->status === 'active'
            && (
                $subscription->ends_at === null ||
                $subscription->ends_at->isFuture()
            );
    }

    public function currentPlan(): ?Plan
    {
        return $this->activeSubscription?->plan;
    }

    public function canCreateUser(): bool
    {
        $plan = $this->currentPlan();

        if (! $plan) {
            return false;
        }

        if ($plan->max_users === -1) {
            return true;
        }

        return $this->users()->count() < $plan->max_users;
    }

    public function canCreateProperty(): bool
    {
        $plan = $this->currentPlan();

        if (! $plan) {
            return false;
        }

        if ($plan->max_properties === -1) {
            return true;
        }

        return $this->properties()->count() < $plan->max_properties;
    }
    public function paymentTransactions()
{
    return $this->hasMany(PaymentTransaction::class);
}
}