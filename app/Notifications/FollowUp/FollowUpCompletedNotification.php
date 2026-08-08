<?php

namespace App\Notifications\FollowUp;

use App\Enums\NotificationPriority;
use App\Enums\NotificationType;
use App\Models\Lead;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

class FollowUpCompletedNotification extends Notification
{
    use Queueable;

    public function __construct(
        protected Lead $lead,
    ) {}

    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type' => NotificationType::FOLLOW_UP_COMPLETED->value,

            'title' => 'Follow Up Completed',

            'body' => "{$this->lead->assignedTo->name} completed the follow up for {$this->lead->name}.",

            'url' => route(
                'filament.admin.resources.leads.edit',
                $this->lead,
            ),

            'priority' => NotificationPriority::NORMAL->value,
        ];
    }

    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage(
            $this->toArray($notifiable)
        );
    }
}