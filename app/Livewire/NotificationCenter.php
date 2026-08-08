<?php

namespace App\Livewire;

use App\Services\NotificationService;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class NotificationCenter extends Component
{
    use WithPagination;

    protected NotificationService $notificationService;

    #[Url]
    public string $search = '';

    #[Url]
    public string $filter = 'all';

    public int $perPage = 15;

    public function boot(NotificationService $notificationService): void
    {
        $this->notificationService = $notificationService;
    }

    /**
     * Reset pagination when search changes.
     */
    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    /**
     * Reset pagination when filter changes.
     */
    public function updatedFilter(): void
    {
        $this->resetPage();
    }

    /**
     * Unread count.
     */
    public function getUnreadCountProperty(): int
    {
        return $this->notificationService
            ->getUnreadCount(Auth::user());
    }
    /**
     * Notifications list.
     */
    public function getNotificationsProperty()
    {
        return $this->notificationService->paginate(
            Auth::user(),
            $this->filter,
            $this->search,
            $this->perPage,
        );
    }
    /**
     * Open notification.
     */
    public function openNotification(string $id)
    {
        $url = $this->notificationService
            ->open(Auth::user(), $id);

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
     * Delete one notification.
     */
    public function deleteNotification(string $id): void
    {
        $this->notificationService
            ->deleteNotification(Auth::user(), $id);

        $this->dispatch('$refresh');
    }

    public function render()
    {
        return view('livewire.notification-center', [

            'notifications' => $this->notifications,

        ]);
    }
    public function getCountsProperty(): array
    {
        return $this->notificationService
            ->counts(Auth::user());
    }
}
