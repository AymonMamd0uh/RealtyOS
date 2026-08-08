<?php

namespace App\Listeners;

use App\Events\FollowUpCompleted;
use App\Services\NotificationService;

class SendFollowUpCompletedNotification
{
    public function __construct(
        protected NotificationService $notificationService,
    ) {}

    public function handle(FollowUpCompleted $event): void
    {
        $this->notificationService
            ->followUpCompleted($event->lead);
    }
}