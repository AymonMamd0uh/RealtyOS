<?php

namespace App\Events;

use App\Models\Property;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PropertyUpdated
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public Property $property,
    ) {}
}