<?php

namespace App\Listeners;

use App\Events\PropertyAssigned;
use App\Services\NotificationService;

class SendPropertyAssignedNotification
{
    public function __construct(
        protected NotificationService $notificationService,
    ) {}

    public function handle(PropertyAssigned $event): void
    {
        $this->notificationService->propertyAssigned(
            $event->property,
            $event->agent,
        );
    }
}