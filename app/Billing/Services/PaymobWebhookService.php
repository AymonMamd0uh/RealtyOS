<?php

namespace App\Billing\Services;

class PaymobWebhookService
{
    public function verify(array $payload): bool
    {
        $receivedHmac = $payload['hmac'] ?? null;

        if (! $receivedHmac) {
            return false;
        }

        $secret = config('services.paymob.hmac');

        if (! $secret) {
            logger()->warning('PAYMOB_HMAC is not configured.');

            return false;
        }

        /*
        |--------------------------------------------------------------------------
        | ترتيب الحقول طبقاً لتوثيق Paymob
        |--------------------------------------------------------------------------
        */

        $fields = [

            'amount_cents',
            'created_at',
            'currency',
            'error_occured',
            'has_parent_transaction',
            'id',
            'integration_id',
            'is_3d_secure',
            'is_auth',
            'is_capture',
            'is_refunded',
            'is_standalone_payment',
            'is_voided',
            'order',
            'owner',
            'pending',
            'source_data_pan',
            'source_data_sub_type',
            'source_data_type',
            'success',

        ];

        $data = '';

        foreach ($fields as $field) {

            $data .= data_get($payload, $field, '');

        }

        $calculated = hash_hmac(
            'sha512',
            $data,
            $secret
        );

        return hash_equals(
            $calculated,
            $receivedHmac
        );
    }
}