<?php

namespace App\Notifications\Lead;

use App\Enums\NotificationPriority;
use App\Enums\NotificationType;
use App\Models\Lead;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

class LeadReassignedNotification extends Notification
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
            'type' => NotificationType::LEAD_REASSIGNED->value,

            'title' => 'Lead Reassigned',

            'body' => $this->lead->name,

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