<?php

namespace App\Listeners;

use App\Events\SubscriptionExpiring;
use App\Services\NotificationService;

class SendSubscriptionExpiringNotification
{
    public function __construct(
        protected NotificationService $notificationService,
    ) {}

    public function handle(SubscriptionExpiring $event): void
    {
        $this->notificationService->subscriptionExpiring(
            $event->subscription,
        );
    }
}