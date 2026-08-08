<?php

namespace App\Listeners;

use App\Events\LeadReassigned;
use App\Services\NotificationService;

class SendLeadReassignedNotification
{
    public function __construct(
        protected NotificationService $notificationService,
    ) {}

    public function handle(LeadReassigned $event): void
    {
        $this->notificationService->leadReassigned(
            $event->agent,
            $event->lead,
        );
    }
}