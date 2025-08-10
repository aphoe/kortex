<?php

namespace App\Filament\Resources\CertificationResource\Pages;

use App\Filament\Resources\CertificationResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Parallax\FilamentComments\Actions\CommentsAction;

class ViewCertification extends ViewRecord
{
    protected static string $resource = CertificationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CommentsAction::make(),
        ];
    }
}
