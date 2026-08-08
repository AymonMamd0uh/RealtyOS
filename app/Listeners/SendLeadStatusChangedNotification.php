<?php

namespace App\Listeners;

use App\Enums\LeadStatus;
use App\Events\LeadStatusChanged;
use App\Services\NotificationService;

class SendLeadStatusChangedNotification
{
    public function __construct(
        protected NotificationService $notificationService,
    ) {}

    public function handle(LeadStatusChanged $event): void
    {
        match ($event->lead->status) {

            LeadStatus::WON => $this->notificationService
                ->leadWon($event->lead),

            LeadStatus::LOST => $this->notificationService
                ->leadLost($event->lead),

            default => null,

        };
    }
}