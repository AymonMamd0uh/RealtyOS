<?php

namespace App\Notifications\Lead;

use App\Models\Lead;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;
use App\Enums\NotificationPriority;
use App\Enums\NotificationType;

class LeadAssignedNotification extends Notification
{
    use Queueable;

    public function __construct(
        protected Lead $lead,
    ) {}

    /**
     * Delivery Channels
     */
    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }

    /**
     * Database Notification
     */
    public function toArray(object $notifiable): array
    {
        return [
            'type' => NotificationType::LEAD_ASSIGNED->value,

            'title' => 'New Lead Assigned',

            'body' => $this->lead->name,

            'url' => route(
                'filament.admin.resources.leads.edit',
                $this->lead
            ),

            'priority' => NotificationPriority::HIGH->value,
        ];
    }

    /**
     * Realtime Notification
     */
    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage(
            $this->toArray($notifiable)
        );
    }
}