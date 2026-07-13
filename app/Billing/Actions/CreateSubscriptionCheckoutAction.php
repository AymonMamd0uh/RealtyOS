<?php

namespace App\Billing\Actions;

use App\Billing\Services\PaymobService;
use App\Models\Company;
use App\Models\Plan;
use Illuminate\Support\Str;

class CreateSubscriptionCheckoutAction
{
    public function __construct(
        protected PaymobService $paymob,
    ) {}

    public function execute(
        Company $company,
        Plan $plan,
    ): array {

        $user = $company->users()->first();

        $subscription = $company->activeSubscription;

        if (! $subscription) {
            abort(404, 'Subscription not found.');
        }

        $merchantOrderId = (string) Str::uuid();

        $subscription->update([
            'pending_plan_id' => $plan->id,
            'merchant_order_id' => $merchantOrderId,
        ]);

        $response = $this->paymob->createIntention([

            'amount' => (int) ($plan->price * 100),

            'currency' => 'EGP',

            'payment_methods' => [
                $this->paymob->getIntegrationId(),
            ],

            'items' => [
                [
                    'name' => $plan->name,

                    'amount' => (int) ($plan->price * 100),

                    'description' => "{$plan->name} Subscription",

                    'quantity' => 1,
                ],
            ],

            'billing_data' => [

                'apartment' => 'NA',

                'first_name' => $user->name,

                'last_name' => 'User',

                'street' => 'NA',

                'building' => 'NA',

                'phone_number' => $company->phone ?: '+201000000000',

                'city' => 'Cairo',

                'country' => 'EG',

                'email' => $user->email,

                'floor' => 'NA',

                'state' => 'Cairo',

            ],

            'extras' => [

                'company_id' => $company->id,

                'plan_id' => $plan->id,

            ],

            'special_reference' => $merchantOrderId,

            'expiration' => 3600,

            'notification_url' => route('paymob.webhook'),

            'redirection_url' => route('subscription.success'),

        ]);

        $subscription->update([

            'provider_intention_id' => $response['id'] ?? null,

            'provider_order_id' => $response['intention_order_id'] ?? null,

        ]);

        return $response;
    }
}
