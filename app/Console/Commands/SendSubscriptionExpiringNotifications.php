<?php

namespace App\Console\Commands;

use App\Models\Subscription;
use App\Services\NotificationService;
use Illuminate\Console\Command;

class SendSubscriptionExpiringNotifications extends Command
{
    protected $signature = 'notifications:subscriptions-expiring';

    protected $description = 'Send subscription expiring notifications';

    public function handle(
        NotificationService $notificationService,
    ): int {

        $subscriptions = Subscription::query()
            ->where('status', 'active')
            ->where('is_lifetime', false)
            ->whereNotNull('ends_at')
            ->whereNull('subscription_expiring_notified_at')
            ->whereBetween(
                'ends_at',
                [
                    now(),
                    now()->addDays(3),
                ]
            )
            ->get();

        foreach ($subscriptions as $subscription) {

            $notificationService->subscriptionExpiring(
                $subscription,
            );

            $subscription->update([
                'subscription_expiring_notified_at' => now(),
            ]);
        }

        $this->info(
            "Sent {$subscriptions->count()} subscription expiring notifications."
        );

        return self::SUCCESS;
    }
}