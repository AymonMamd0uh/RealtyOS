<?php

namespace App\Notifications\Subscription;

use App\Enums\NotificationPriority;
use App\Enums\NotificationType;
use App\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

class SubscriptionExpiringNotification extends Notification
{
    use Queueable;

    public function __construct(
        protected Subscription $subscription,
    ) {}

    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type' => NotificationType::SUBSCRIPTION_EXPIRING->value,
            'title' => 'Subscription Expiring',
            'body' => 'Your subscription is expiring soon.',
            'url' => route('filament.admin.pages.subscription'),
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