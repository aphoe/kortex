<?php

namespace App\Filament\Resources\CertificationProviderResource\Pages;

use App\Filament\Resources\CertificationProviderResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCertificationProvider extends EditRecord
{
    protected static string $resource = CertificationProviderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
