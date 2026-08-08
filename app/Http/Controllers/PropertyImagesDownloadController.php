<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Support\Facades\File;
use ZipArchive;

class PropertyImagesDownloadController extends Controller
{
    public function __invoke(Property $property)
    {
        $directory = storage_path('app/temp');

        if (! File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        $zipName = 'Property-' .
            $property->reference_number .
            '-Images.zip';

        $zipPath = $directory . '/' . $zipName;

        if (File::exists($zipPath)) {
            File::delete($zipPath);
        }

        $zip = new ZipArchive();

        if ($zip->open($zipPath, ZipArchive::CREATE) !== true) {
            abort(500, 'Unable to create ZIP file.');
        }

        foreach ($property->images as $image) {

            $path = storage_path(
                'app/public/' . $image->image
            );

            if (File::exists($path)) {

                $extension = pathinfo($path, PATHINFO_EXTENSION);

                $zip->addFile(
                    $path,
                    'Image-' .
                    str_pad($image->id, 3, '0', STR_PAD_LEFT)
                    . '.' .
                    $extension
                );
            }
        }

        $zip->close();

        return response()->download($zipPath)
            ->deleteFileAfterSend(true);
    }
}