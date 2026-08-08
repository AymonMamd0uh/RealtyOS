<?php

namespace App\Listeners;

use App\Events\SubscriptionExpired;
use App\Services\NotificationService;

class SendSubscriptionExpiredNotification
{
    public function __construct(
        protected NotificationService $notificationService,
    ) {}

    public function handle(SubscriptionExpired $event): void
    {
        $this->notificationService->subscriptionExpired(
            $event->subscription,
        );
    }
}