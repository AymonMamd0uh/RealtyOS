<?php

namespace App\Services;

use App\Models\Company;

class SubscriptionService
{
    public function hasAccess(Company $company): bool
    {
        if ($company->activeSubscription?->is_lifetime) {
            return true;
        }

        if ($company->isOnTrial()) {
            return true;
        }

        if ($company->hasActiveSubscription()) {
            return true;
        }

        return false;
    }
}