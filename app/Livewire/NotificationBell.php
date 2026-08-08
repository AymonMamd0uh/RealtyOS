<?php

namespace App\Livewire;

use App\Services\NotificationService;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class NotificationBell extends Component
{
    protected NotificationService $notificationService;

    public function boot(NotificationService $notificationService): void
    {
        $this->notificationService = $notificationService;
    }

    /**
     * Number of unread notifications.
     */
    public function getUnreadCountProperty(): int
    {
        return $this->notificationService
            ->getUnreadCount(Auth::user());
    }

    /**
     * Latest notifications for the dropdown.
     */
    public function getNotificationsProperty()
    {
        return $this->notificationService
            ->getRecentNotifications(Auth::user());
    }

    /**
     * Open notification.
     */
    public function openNotification(string $id)
    {
        $url = $this->notificationService
            ->open(Auth::user(), $id);

        $this->dispatch('$refresh');

        if ($url) {
            return redirect()->to($url);
        }
    }

    /**
     * Mark all notifications as read.
     */
    public function markAllAsRead(): void
    {
        $this->notificationService
            ->markAllAsRead(Auth::user());

        $this->dispatch('$refresh');
    }

    /**
     * Delete all read notifications.
     */
    public function clearRead(): void
    {
        $this->notificationService
            ->clearRead(Auth::user());

        $this->dispatch('$refresh');
    }

    /**
     * Delete a single notification.
     */
    public function deleteNotification(string $id): void
    {
        $this->notificationService
            ->deleteNotification(Auth::user(), $id);

        $this->dispatch('$refresh');
    }

    #[On('refreshNotifications')]
    public function refreshNotifications(): void
    {
        $this->dispatch('$refresh');
    }
    public function realtimeNotification(): void
    {
        $this->dispatch('$refresh');
    }
    public function render()
    {
        return view('livewire.notification-bell');
    }
}
