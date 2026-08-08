<?php

namespace App\Services;

use App\Models\Property;
use Spatie\Browsershot\Browsershot;

class PropertyPdfService
{
    public function download(Property $property)
    {
        $property->load([
            'coverImage',
            'images',
            'city',
            'area',
            'compound',
            'stage',
            'company',
            'user',
            'features',
        ]);

        $html = view('pdf.property', [
            'record' => $property,
        ])->render();

        $tempDirectory = storage_path('app/temp');

        if (! is_dir($tempDirectory)) {
            mkdir($tempDirectory, 0755, true);
        }

        $fileName = $tempDirectory . DIRECTORY_SEPARATOR .
            'property-' . $property->id . '.pdf';
        $tempDirectory = storage_path('app/temp');

        if (! is_dir($tempDirectory)) {
            mkdir($tempDirectory, 0755, true);
        }

        $fileName = $tempDirectory . DIRECTORY_SEPARATOR .
            'property-' . $property->id . '.pdf';
        Browsershot::html($html)
            ->setChromePath('C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe')
            ->setNodeBinary('C:\\Program Files\\nodejs\\node.exe')
            ->showBackground()
            ->format('A4')
            ->margins(10, 10, 10, 10)
            ->save($fileName);

        return response()->download(
            $fileName,
            'Property-' . $property->reference_number . '.pdf'
        )->deleteFileAfterSend();
    }
}
