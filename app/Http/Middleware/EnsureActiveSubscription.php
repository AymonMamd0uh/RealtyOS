<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\SubscriptionService;

class EnsureActiveSubscription
{
    public function __construct(
        protected SubscriptionService $subscriptionService
    ) {}

    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if (! $user) {
            return redirect()->route('login');
        }

        if ($user->hasRole('Platform Admin')) {
            return $next($request);
        }

        if (! $this->subscriptionService->hasAccess($user->company)) {
            return redirect()->route('subscription.expired');
        }

        return $next($request);
    }
}
