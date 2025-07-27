<?php

namespace App\Filament\Resources\ResourceCategoryResource\Pages;

use App\Filament\Resources\ResourceCategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListResourceCategories extends ListRecords
{
    protected static string $resource = ResourceCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
