<?php

namespace App\Notifications\FollowUp;

use App\Enums\NotificationPriority;
use App\Enums\NotificationType;
use App\Models\Lead;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

class FollowUpDueNotification extends Notification
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

            'type' => NotificationType::FOLLOW_UP_DUE->value,

            'title' => 'Follow Up Due',

            'body' => "You have a follow up due today for {$this->lead->name}.",

            'url' => route(
                'filament.admin.resources.leads.edit',
                $this->lead,
            ),

            'priority' => NotificationPriority::HIGH->value,

        ];
    }
    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage(
            $this->toArray($notifiable)
        );
    }
}
