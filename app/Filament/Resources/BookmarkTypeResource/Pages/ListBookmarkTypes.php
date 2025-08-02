<?php

namespace App\Filament\Resources\BookmarkTypeResource\Pages;

use App\Filament\Resources\BookmarkTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBookmarkTypes extends ListRecords
{
    protected static string $resource = BookmarkTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
