<?php

namespace App\Filament\Resources\BookmarkResource\Pages;

use App\Filament\Resources\BookmarkResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBookmark extends CreateRecord
{
    protected static string $resource = BookmarkResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
