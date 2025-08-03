<?php

namespace App\Filament\Resources\NoteResource\Pages;

use App\Filament\Resources\NoteResource;
use Filament\Resources\Pages\CreateRecord;

class CreateNote extends CreateRecord
{
    protected static string $resource = NoteResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
