<?php

namespace App\Filament\Resources\PromptServiceResource\Pages;

use App\Filament\Resources\PromptServiceResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPromptService extends EditRecord
{
    protected static string $resource = PromptServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
