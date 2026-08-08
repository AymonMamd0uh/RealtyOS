<?php

namespace App\Listeners;

use App\Events\UserJoined;
use App\Services\NotificationService;

class SendUserJoinedNotification
{
    public function __construct(
        protected NotificationService $notificationService,
    ) {}

    public function handle(UserJoined $event): void
    {
        $this->notificationService->userJoined(
            $event->user,
        );
    }
}