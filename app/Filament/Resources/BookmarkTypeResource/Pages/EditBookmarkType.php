<?php

namespace App\Filament\Resources\BookmarkTypeResource\Pages;

use App\Filament\Resources\BookmarkTypeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBookmarkType extends EditRecord
{
    protected static string $resource = BookmarkTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
