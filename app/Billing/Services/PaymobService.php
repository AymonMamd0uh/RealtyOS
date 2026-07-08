<?php

namespace App\Billing\Services;

use Illuminate\Support\Facades\Http;

class PaymobService
{
    protected string $baseUrl;

    protected string $secretKey;

    protected string $publicKey;

    protected int $integrationId;

    public function __construct()
    {
        $this->baseUrl = config(
            'services.paymob.base_url',
            'https://accept.paymob.com/v1'
        );

        $this->secretKey = config('services.paymob.secret_key');

        $this->publicKey = config('services.paymob.public_key');

        $this->integrationId = (int) config(
            'services.paymob.card_integration_id'
        );
    }

    protected function client()
    {
        return Http::acceptJson()

            ->timeout(30)

            ->retry(3, 500)

            ->withHeaders([

                'Authorization' => 'Token ' . $this->secretKey,

                'Content-Type' => 'application/json',

            ]);
    }

    public function createIntention(array $payload): array
    {
        return $this->client()

            ->post(
                "{$this->baseUrl}/intention/",
                $payload
            )

            ->throw()

            ->json();
    }

    public function getCheckoutUrl(string $clientSecret): string
    {
        return sprintf(
            'https://accept.paymob.com/unifiedcheckout/?publicKey=%s&clientSecret=%s',
            $this->publicKey,
            urlencode($clientSecret)
        );
    }

    public function getPublicKey(): string
    {
        return $this->publicKey;
    }

    public function getIntegrationId(): int
    {
        return $this->integrationId;
    }
}