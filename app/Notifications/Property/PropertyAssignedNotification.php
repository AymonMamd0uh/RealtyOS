<?php

namespace App\Notifications\Property;

use App\Enums\NotificationPriority;
use App\Enums\NotificationType;
use App\Models\Property;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

class PropertyAssignedNotification extends Notification
{
    use Queueable;

    public function __construct(
        protected Property $property,
    ) {}

    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type' => NotificationType::PROPERTY_ASSIGNED->value,

            'title' => 'Property Assigned',

            'body' => $this->property->title,

            'url' => route(
                'filament.admin.resources.properties.edit',
                $this->property,
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