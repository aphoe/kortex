<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Parallax\FilamentComments\Models\FilamentComment;

/*Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');*/

Schedule::command('model:prune', [
    '--model' => [FilamentComment::class],
])->daily();
