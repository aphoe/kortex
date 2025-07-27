<?php

namespace App\Filament\Resources\ResourceCategoryResource\Pages;

use App\Filament\Resources\ResourceCategoryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditResourceCategory extends EditRecord
{
    protected static string $resource = ResourceCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
