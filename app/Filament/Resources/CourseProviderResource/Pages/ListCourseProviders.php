<?php

namespace App\Filament\Resources\CourseProviderResource\Pages;

use App\Filament\Resources\CourseProviderResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCourseProviders extends ListRecords
{
    protected static string $resource = CourseProviderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
