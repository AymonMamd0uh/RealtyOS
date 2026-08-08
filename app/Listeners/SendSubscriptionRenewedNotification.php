<?php

namespace App\Listeners;

use App\Events\SubscriptionRenewed;
use App\Services\NotificationService;

class SendSubscriptionRenewedNotification
{
    public function __construct(
        protected NotificationService $notificationService,
    ) {}

    public function handle(SubscriptionRenewed $event): void
    {
        $this->notificationService->subscriptionRenewed(
            $event->subscription,
        );
    }
}