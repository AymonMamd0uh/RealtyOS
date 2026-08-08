<?php

namespace App\Services;

use App\Models\Lead;
use App\Models\User;
use App\Notifications\Lead\LeadAssignedNotification;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Notifications\Lead\LeadReassignedNotification;
use App\Notifications\Lead\LeadWonNotification;
use App\Notifications\Lead\LeadLostNotification;
use App\Enums\NotificationAudience;
use Spatie\Permission\Models\Role;
use App\Notifications\FollowUp\FollowUpCompletedNotification;
use App\Notifications\FollowUp\FollowUpDueNotification;
use App\Notifications\FollowUp\FollowUpOverdueNotification;
use App\Notifications\Property\PropertyAssignedNotification;
use App\Notifications\Property\PropertyCreatedNotification;
use App\Notifications\Property\PropertyUpdatedNotification;
use App\Models\Property;
use App\Notifications\User\UserJoinedNotification;
use App\Models\Subscription;
use App\Notifications\Subscription\SubscriptionRenewedNotification;
use App\Notifications\Subscription\SubscriptionExpiringNotification;
use App\Notifications\Subscription\SubscriptionExpiredNotification;

class NotificationService
{
    /*
    |--------------------------------------------------------------------------
    | Send Notifications
    |--------------------------------------------------------------------------
    */

    public function sendToUser(
        User $user,
        Notification $notification,
    ): void {
        $user->notify($notification);
    }
    public function sendToAudience(
        int $companyId,
        array $audience,
        Notification $notification,
        ?User $agent = null,
    ): void {

        $users = User::query()
            ->where('company_id', $companyId)
            ->get()
            ->filter(function (User $user) use ($audience, $agent) {

                if (
                    in_array(NotificationAudience::AGENT, $audience, true)
                    && $agent
                    && $user->id === $agent->id
                ) {
                    return true;
                }

                if (
                    in_array(NotificationAudience::OWNER, $audience, true)
                    && $user->hasRole('Owner')
                ) {
                    return true;
                }

                if (
                    in_array(NotificationAudience::MANAGER, $audience, true)
                    && $user->hasRole('Manager')
                ) {
                    return true;
                }

                if (
                    in_array(NotificationAudience::PLATFORM_ADMIN, $audience, true)
                    && $user->hasRole('Platform Admin')
                ) {
                    return true;
                }

                return false;
            })
            ->unique('id');

        $this->sendToUsers(
            $users,
            $notification,
        );
    }
    public function sendToUsers(
        EloquentCollection $users,
        Notification $notification,
    ): void {
        foreach ($users as $user) {
            $user->notify(clone $notification);
        }
    }

    public function leadAssigned(
        User $agent,
        Lead $lead,
    ): void {

        $this->sendToAudience(
            $lead->company_id,
            [
                NotificationAudience::AGENT,
            ],
            new LeadAssignedNotification($lead),
            $agent,
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Read Notifications
    |--------------------------------------------------------------------------
    */

    public function getNotifications(
        User $user,
        int $limit = 10,
    ) {
        return $user->notifications()
            ->latest()
            ->limit($limit)
            ->get();
    }

    public function getUnreadCount(
        User $user,
    ): int {
        return $user->unreadNotifications()
            ->count();
    }

    /*
    |--------------------------------------------------------------------------
    | Actions
    |--------------------------------------------------------------------------
    */

    public function markAsRead(
        User $user,
        string $notificationId,
    ): void {

        $notification = $user
            ->notifications()
            ->find($notificationId);

        if ($notification && ! $notification->read_at) {
            $notification->markAsRead();
        }
    }

    public function markAllAsRead(
        User $user,
    ): void {

        $user->unreadNotifications
            ->markAsRead();
    }

    public function clearRead(
        User $user,
    ): void {

        $user->notifications()
            ->whereNotNull('read_at')
            ->delete();
    }

    public function deleteNotification(
        User $user,
        string $notificationId,
    ): void {

        $user->notifications()
            ->whereKey($notificationId)
            ->delete();
    }

    public function deleteAll(
        User $user,
    ): void {

        $user->notifications()
            ->delete();
    }
    /**
     * Find a notification for a user.
     */
    public function find(
        User $user,
        string $notificationId,
    ): ?DatabaseNotification {

        return $user
            ->notifications()
            ->find($notificationId);
    }

    /**
     * Open notification.
     */
    public function open(
        User $user,
        string $notificationId,
    ): ?string {

        $notification = $this->find(
            $user,
            $notificationId,
        );

        if (! $notification) {
            return null;
        }

        if (! $notification->read_at) {
            $notification->markAsRead();
        }

        return $notification->data['url'] ?? null;
    }
    /**
     * Paginate notifications with filters and search.
     */
    public function paginate(
        User $user,
        string $filter = 'all',
        string $search = '',
        int $perPage = 15,
    ): LengthAwarePaginator {

        $query = $user
            ->notifications()
            ->latest();

        match ($filter) {

            'read' => $query->whereNotNull('read_at'),

            'unread' => $query->whereNull('read_at'),

            default => null,
        };

        if (filled($search)) {

            $query->where(function ($q) use ($search) {

                $q->where('data->title', 'ILIKE', "%{$search}%")
                    ->orWhere('data->body', 'ILIKE', "%{$search}%");
            });
        }

        return $query->paginate($perPage);
    }
    /**
     * Get notification statistics.
     */
    public function counts(User $user): array
    {
        return [

            'all' => $user->notifications()->count(),

            'read' => $user->notifications()
                ->whereNotNull('read_at')
                ->count(),

            'unread' => $user->notifications()
                ->whereNull('read_at')
                ->count(),

        ];
    }
    /**
     * Latest notifications for the bell.
     */
    public function getRecentNotifications(
        User $user,
        int $limit = 5,
    ): EloquentCollection {

        return $user
            ->notifications()
            ->latest()
            ->take($limit)
            ->get();
    }

    public function leadReassigned(
        User $agent,
        Lead $lead,
    ): void {

        $this->sendToAudience(
            $lead->company_id,
            [
                NotificationAudience::AGENT,
            ],
            new LeadReassignedNotification($lead),
            $agent,
        );
    }
    public function leadWon(
        Lead $lead,
    ): void {

        $this->sendToAudience(
            $lead->company_id,
            [
                NotificationAudience::AGENT,
                NotificationAudience::MANAGER,
                NotificationAudience::OWNER,
            ],
            new LeadWonNotification($lead),
            $lead->assignedTo,
        );
    }
    public function leadLost(
        Lead $lead,
    ): void {

        $this->sendToAudience(
            $lead->company_id,
            [
                NotificationAudience::MANAGER,
                NotificationAudience::OWNER,
            ],
            new LeadLostNotification($lead),
            $lead->assignedTo,
        );
    }
    public function followUpCompleted(
        Lead $lead,
    ): void {

        $this->sendToAudience(
            $lead->company_id,
            [
                NotificationAudience::MANAGER,
                NotificationAudience::OWNER,
            ],
            new FollowUpCompletedNotification($lead),
            $lead->assignedTo,
        );
    }
    public function followUpDue(
        Lead $lead,
    ): void {

        $this->sendToAudience(
            $lead->company_id,
            [
                NotificationAudience::AGENT,
            ],
            new FollowUpDueNotification($lead),
            $lead->assignedTo,
        );
    }
    public function followUpOverdue(
        Lead $lead,
    ): void {

        $this->sendToAudience(
            $lead->company_id,
            [
                NotificationAudience::AGENT,
                NotificationAudience::MANAGER,
                NotificationAudience::OWNER,
            ],
            new FollowUpOverdueNotification($lead),
            $lead->assignedTo,
        );
    }
    public function propertyCreated(
        Property $property,
    ): void {

        $this->sendToAudience(
            $property->company_id,
            [
                NotificationAudience::OWNER,
                NotificationAudience::MANAGER,
            ],
            new PropertyCreatedNotification($property),
        );
    }
    public function propertyUpdated(
        Property $property,
    ): void {

        $this->sendToAudience(
            $property->company_id,
            [
                NotificationAudience::OWNER,
                NotificationAudience::MANAGER,
            ],
            new PropertyUpdatedNotification($property),
        );
    }
    public function propertyAssigned(
        Property $property,
        User $agent,
    ): void {

        $this->sendToAudience(
            $property->company_id,
            [
                NotificationAudience::AGENT,
            ],
            new PropertyAssignedNotification($property),
            $agent,
        );
    }
    public function userJoined(
        User $user,
    ): void {

        if (! $user->company_id) {
            return;
        }

        $this->sendToAudience(
            $user->company_id,
            [
                NotificationAudience::OWNER,
                NotificationAudience::MANAGER,
            ],
            new UserJoinedNotification($user),
        );
    }
    public function subscriptionRenewed(
        Subscription $subscription,
    ): void {

        $this->sendToAudience(
            $subscription->company_id,
            [
                NotificationAudience::OWNER,
            ],
            new SubscriptionRenewedNotification($subscription),
        );
    }
    public function subscriptionExpiring(
        Subscription $subscription,
    ): void {

        $this->sendToAudience(
            $subscription->company_id,
            [
                NotificationAudience::OWNER,
            ],
            new SubscriptionExpiringNotification($subscription),
        );
    }
    public function subscriptionExpired(
        Subscription $subscription,
    ): void {

        $this->sendToAudience(
            $subscription->company_id,
            [
                NotificationAudience::OWNER,
            ],
            new SubscriptionExpiredNotification($subscription),
        );
    }
}
