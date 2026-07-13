<?php

namespace App\Billing\Actions;

use App\Models\PaymentTransaction;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HandlePaymobWebhookAction
{
    public function execute(array $payload): void
    {
        DB::transaction(function () use ($payload) {

            $merchantOrderId = data_get($payload, 'merchant_order_id');

            if (! $merchantOrderId) {
                return;
            }

            $transactionId = (string) data_get($payload, 'id');

            /*
            |--------------------------------------------------------------------------
            | Idempotency
            |--------------------------------------------------------------------------
            | لو الـ Webhook وصل مرتين لن يتم تنفيذه مرة أخرى
            */

            if (
                PaymentTransaction::where(
                    'provider_transaction_id',
                    $transactionId
                )->exists()
            ) {
                return;
            }

            $subscription = Subscription::where(
                'merchant_order_id',
                $merchantOrderId
            )->first();

            if (! $subscription) {
                return;
            }

            $success = filter_var(
                data_get($payload, 'success'),
                FILTER_VALIDATE_BOOLEAN
            );

            $pending = filter_var(
                data_get($payload, 'pending'),
                FILTER_VALIDATE_BOOLEAN
            );

            $paidAt = data_get($payload, 'created_at')
                ? Carbon::parse(data_get($payload, 'created_at'))
                : now();

            PaymentTransaction::create([

                'company_id' => $subscription->company_id,

                'subscription_id' => $subscription->id,

                'provider' => 'paymob',

                'provider_transaction_id' => $transactionId,

                'provider_order_id' => data_get($payload, 'order'),

                'merchant_order_id' => $merchantOrderId,

                'amount' => data_get($payload, 'amount_cents', 0) / 100,

                'currency' => data_get($payload, 'currency', 'EGP'),

                'status' => $success
                    ? 'success'
                    : 'failed',

                'payload' => $payload,

                'paid_at' => $paidAt,

            ]);

            /*
            |--------------------------------------------------------------------------
            | لو العملية فشلت أو مازالت Pending
            |--------------------------------------------------------------------------
            */

            if (! $success || $pending) {
                return;
            }

            /*
            |--------------------------------------------------------------------------
            | Activate Subscription
            |--------------------------------------------------------------------------
            */

            $subscription->update([

                'plan_id' => $subscription->pending_plan_id,

                'pending_plan_id' => null,

                'status' => 'active',

                'provider' => 'paymob',

                'provider_transaction_id' => $transactionId,

                'provider_order_id' => data_get($payload, 'order'),

                'paid_amount' => data_get($payload, 'amount_cents', 0) / 100,

                'paid_currency' => data_get($payload, 'currency', 'EGP'),

                'paid_at' => $paidAt,

                'starts_at' => $subscription->starts_at ?: now(),

                'ends_at' => $subscription->ends_at &&
                    $subscription->ends_at->isFuture()
                    ? $subscription->ends_at->copy()->addMonth()
                    : now()->addMonth(),

            ]);
        });
    }
}
