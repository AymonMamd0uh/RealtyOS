<?php

namespace App\Listeners;

use App\Events\LeadAssigned;
use App\Services\NotificationService;

class SendLeadAssignedNotification
{
    public function __construct(
        protected NotificationService $notificationService,
    ) {}

    public function handle(LeadAssigned $event): void
    {
        $this->notificationService->leadAssigned(
            $event->agent,
            $event->lead,
        );
    }
}