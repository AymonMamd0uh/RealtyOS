<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageOptimizationService
{
    public function optimize(UploadedFile $file): string
    {
        $manager = ImageManager::withDriver(new Driver());

        $image = $manager->read($file);

        $image->scaleDown(width: 1920);

        $filename = Str::uuid() . '.jpg';

        $path = 'properties/' . $filename;

        Storage::disk('public')->put(
            $path,
            (string) $image->toJpeg(82)
        );

        return $path;
    }
}