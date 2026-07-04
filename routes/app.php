<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    Route::redirect('/dashboard', '/admin')
        ->name('dashboard');

});