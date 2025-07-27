<?php

namespace App\Filament\Resources\CourseProviderResource\Pages;

use App\Filament\Resources\CourseProviderResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCourseProvider extends CreateRecord
{
    protected static string $resource = CourseProviderResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
