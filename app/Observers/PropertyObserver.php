<?php

namespace App\Observers;

use App\Events\PropertyAssigned;
use App\Events\PropertyCreated;
use App\Events\PropertyUpdated;
use App\Models\Property;

class PropertyObserver
{
    /**
     * Handle the Property "created" event.
     */
    public function created(Property $property): void
    {
        // Notify Owner + Manager
        PropertyCreated::dispatch($property);

        // If the property was created with an assigned agent
        if ($property->user_id && $property->user) {
            PropertyAssigned::dispatch(
                $property,
                $property->user,
            );
        }
    }

    /**
     * Handle the Property "updated" event.
     */
    public function updated(Property $property): void
    {
        // Notify Owner + Manager about property updates
        PropertyUpdated::dispatch($property);

        // Notify the new assigned agent only when assignment changes
        if (
            $property->wasChanged('user_id')
            && $property->user
        ) {
            PropertyAssigned::dispatch(
                $property,
                $property->user,
            );
        }
    }

    public function deleted(Property $property): void
    {
        //
    }

    public function restored(Property $property): void
    {
        //
    }

    public function forceDeleted(Property $property): void
    {
        //
    }
}