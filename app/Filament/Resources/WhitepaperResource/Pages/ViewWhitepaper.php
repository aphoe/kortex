<?php

namespace App\Filament\Resources\WhitepaperResource\Pages;

use App\Filament\Resources\WhitepaperResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Parallax\FilamentComments\Actions\CommentsAction;

class ViewWhitepaper extends ViewRecord
{
    protected static string $resource = WhitepaperResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CommentsAction::make(),
        ];
    }
}
