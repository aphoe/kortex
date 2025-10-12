<?php

namespace App\Filament\Resources\PromptServiceResource\Pages;

use App\Filament\Resources\PromptServiceResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPromptServices extends ListRecords
{
    protected static string $resource = PromptServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
