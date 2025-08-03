<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('user');
});

Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index'])
    ->middleware(\Filament\Http\Middleware\Authenticate::class);
