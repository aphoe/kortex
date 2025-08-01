<?php

namespace App\Filament\Resources\CourseProviderResource\Pages;

use App\Filament\Resources\CourseProviderResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCourseProvider extends EditRecord
{
    protected static string $resource = CourseProviderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
