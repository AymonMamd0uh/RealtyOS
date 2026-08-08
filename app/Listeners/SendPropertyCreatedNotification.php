<?php

namespace App\Listeners;

use App\Events\PropertyCreated;
use App\Services\NotificationService;

class SendPropertyCreatedNotification
{
    public function __construct(
        protected NotificationService $notificationService,
    ) {}

    public function handle(PropertyCreated $event): void
    {
        $this->notificationService->propertyCreated(
            $event->property,
        );
    }
}