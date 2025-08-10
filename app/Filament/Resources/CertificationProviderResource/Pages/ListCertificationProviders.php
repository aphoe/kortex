<?php

namespace App\Filament\Resources\CertificationProviderResource\Pages;

use App\Filament\Resources\CertificationProviderResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCertificationProviders extends ListRecords
{
    protected static string $resource = CertificationProviderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
