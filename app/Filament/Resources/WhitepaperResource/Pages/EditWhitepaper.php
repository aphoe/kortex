<?php

namespace App\Filament\Resources\WhitepaperResource\Pages;

use App\Filament\Resources\WhitepaperResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditWhitepaper extends EditRecord
{
    protected static string $resource = WhitepaperResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
