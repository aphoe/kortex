<?php

namespace App\Filament\Resources\ToolResource\Pages;

use App\Filament\Resources\ToolResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Parallax\FilamentComments\Actions\CommentsAction;

class ViewTool extends ViewRecord
{
    protected static string $resource = ToolResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CommentsAction::make(),
        ];
    }
}
