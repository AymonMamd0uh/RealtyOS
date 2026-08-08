<?php

namespace App\Filament\Resources\Properties\Pages;

use App\Filament\Resources\Properties\PropertyResource;
use App\Services\PropertyPdfService;
use Filament\Resources\Pages\ViewRecord;

class ViewProperty extends ViewRecord
{
    protected static string $resource = PropertyResource::class;

    protected string $view = 'filament.resources.properties.pages.view-property';

    public function getTitle(): string
    {
        return '';
    }

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function downloadPdf(PropertyPdfService $pdfService)
    {
        return $pdfService->download($this->record);
    }
}