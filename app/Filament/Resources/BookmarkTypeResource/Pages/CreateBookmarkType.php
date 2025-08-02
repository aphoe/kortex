<?php

namespace App\Filament\Resources\BookmarkTypeResource\Pages;

use App\Filament\Resources\BookmarkTypeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBookmarkType extends CreateRecord
{
    protected static string $resource = BookmarkTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
