<?php

namespace App\Events;

use App\Models\Property;
use App\Models\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PropertyAssigned
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public Property $property,
        public User $agent,
    ) {}
}