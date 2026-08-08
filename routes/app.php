<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyPdfController;

use App\Http\Controllers\PropertyImagesDownloadController;
Route::middleware('auth')->group(function () {

    Route::redirect('/dashboard', '/admin')
        ->name('dashboard');

    Route::get(
        '/properties/{property}/pdf',
        PropertyPdfController::class
    )->name('properties.pdf');

});
Route::get(
    '/properties/{property}/images',
    PropertyImagesDownloadController::class
)->middleware('auth')
 ->name('properties.images');
