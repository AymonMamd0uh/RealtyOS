<?php

namespace App\Observers;

use App\Events\LeadAssigned;
use App\Events\LeadReassigned;
use App\Models\Lead;
use App\Events\LeadStatusChanged;
use App\Events\FollowUpCompleted;

class LeadObserver
{
    /**
     * Handle the Lead "created" event.
     */
    public function created(Lead $lead): void
    {
        if ($lead->assignedTo) {
            LeadAssigned::dispatch(
                $lead,
                $lead->assignedTo,
            );
        }
    }

    /**
     * Handle the Lead "updated" event.
     */
    public function updated(Lead $lead): void
    {
        if ($lead->wasChanged('assigned_to') && $lead->assignedTo) {

            LeadReassigned::dispatch(
                $lead,
                $lead->assignedTo,
            );
        }

        if ($lead->wasChanged('status')) {

            LeadStatusChanged::dispatch($lead);
        }
        if (
            $lead->wasChanged('follow_up_completed')
            && $lead->follow_up_completed
        ) {

            FollowUpCompleted::dispatch($lead);
        }
        if ($lead->wasChanged('next_follow_up_at')) {

            $lead->updateQuietly([

                'follow_up_completed' => false,

                'follow_up_due_notified_at' => null,

                'follow_up_overdue_notified_at' => null,

            ]);
        }
    }

    public function deleted(Lead $lead): void
    {
        //
    }

    public function restored(Lead $lead): void
    {
        //
    }

    public function forceDeleted(Lead $lead): void
    {
        //
    }
}
