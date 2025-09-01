<?php

namespace App\Filament\Resources\WhitepaperResource\Pages;

use App\Filament\Resources\WhitepaperResource;
use Filament\Resources\Pages\CreateRecord;

class CreateWhitepaper extends CreateRecord
{
    protected static string $resource = WhitepaperResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
