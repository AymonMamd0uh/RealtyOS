<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Services\PropertyPdfService;

class PropertyPdfController extends Controller
{
    public function __invoke(
        Property $property,
        PropertyPdfService $service
    ) {
        return $service->download($property);
    }
}