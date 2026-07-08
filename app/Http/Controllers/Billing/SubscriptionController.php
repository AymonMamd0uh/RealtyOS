<?php

namespace App\Http\Controllers\Billing;

use App\Billing\Actions\CreateSubscriptionCheckoutAction;
use App\Billing\Actions\HandlePaymobWebhookAction;
use App\Billing\Services\PaymobService;
use App\Billing\Services\PaymobWebhookService;
use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function checkout(
        Request $request,
        CreateSubscriptionCheckoutAction $action,
        PaymobService $paymob,
    ) {
        $company = auth()->user()->company;

        $plan = Plan::findOrFail($request->plan);

        $response = $action->execute($company, $plan);

        return redirect()->away(
            $paymob->getCheckoutUrl($response['client_secret'])
        );
    }

    public function success(Request $request)
    {
        logger()->info('Paymob Success Redirect', $request->all());

        return redirect()
            ->route('filament.admin.pages.subscription')
            ->with(
                'success',
                'Your payment is being verified. Your subscription will be activated automatically.'
            );
    }

    public function webhook(
        Request $request,
        HandlePaymobWebhookAction $action,
        PaymobWebhookService $webhookService,
    ) {
        logger()->info('Paymob Webhook', $request->all());

        if (! $webhookService->verify($request->all())) {

            logger()->warning('Invalid Paymob HMAC', $request->all());

            return response()->json([
                'message' => 'Invalid HMAC',
            ], 403);
        }

        $action->execute($request->all());

        return response()->json([
            'success' => true,
        ]);
    }
}