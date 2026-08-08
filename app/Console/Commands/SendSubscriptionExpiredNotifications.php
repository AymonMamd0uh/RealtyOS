<?php

namespace App\Console\Commands;

use App\Models\Subscription;
use App\Services\NotificationService;
use Illuminate\Console\Command;

class SendSubscriptionExpiredNotifications extends Command
{
    protected $signature = 'notifications:subscriptions-expired';

    protected $description = 'Send subscription expired notifications';

    public function handle(
        NotificationService $notificationService,
    ): int {

        $subscriptions = Subscription::query()
            ->where('is_lifetime', false)
            ->whereNotNull('ends_at')
            ->whereNull('subscription_expired_notified_at')
            ->where('ends_at', '<=', now())
            ->get();

        foreach ($subscriptions as $subscription) {

            $notificationService->subscriptionExpired(
                $subscription,
            );

            $subscription->update([
                'subscription_expired_notified_at' => now(),
            ]);
        }

        $this->info(
            "Sent {$subscriptions->count()} subscription expired notifications."
        );

        return self::SUCCESS;
    }
}