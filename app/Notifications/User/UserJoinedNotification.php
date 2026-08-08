<?php

namespace App\Notifications\User;

use App\Enums\NotificationPriority;
use App\Enums\NotificationType;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

class UserJoinedNotification extends Notification
{
    use Queueable;

    public function __construct(
        protected User $user,
    ) {}

    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type' => NotificationType::USER_JOINED->value,

            'title' => 'New Team Member',

            'body' => "{$this->user->name} joined your company.",

            'url' => route(
                'filament.admin.resources.users.edit',
                $this->user,
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