<?php

namespace App\Filament\Resources\PromptServiceResource\Pages;

use App\Filament\Resources\PromptServiceResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePromptService extends CreateRecord
{
    protected static string $resource = PromptServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
