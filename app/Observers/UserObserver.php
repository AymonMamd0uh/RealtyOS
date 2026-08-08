<?php

namespace App\Observers;

use App\Events\UserJoined;
use App\Models\User;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        // Only notify users belonging to a company.
        if ($user->company_id) {
            UserJoined::dispatch($user);
        }
    }

    public function updated(User $user): void
    {
        //
    }

    public function deleted(User $user): void
    {
        //
    }

    public function restored(User $user): void
    {
        //
    }

    public function forceDeleted(User $user): void
    {
        //
    }
}