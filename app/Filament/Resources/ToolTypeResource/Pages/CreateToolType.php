<?php

namespace App\Filament\Resources\ToolTypeResource\Pages;

use App\Filament\Resources\ToolTypeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateToolType extends CreateRecord
{
    protected static string $resource = ToolTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
