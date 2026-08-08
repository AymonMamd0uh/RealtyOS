<?php

namespace App\Listeners;

use App\Events\PropertyUpdated;
use App\Services\NotificationService;

class SendPropertyUpdatedNotification
{
    public function __construct(
        protected NotificationService $notificationService,
    ) {}

    public function handle(PropertyUpdated $event): void
    {
        $this->notificationService->propertyUpdated(
            $event->property,
        );
    }
}