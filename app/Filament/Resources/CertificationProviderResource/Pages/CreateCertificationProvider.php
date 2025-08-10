<?php

namespace App\Filament\Resources\CertificationProviderResource\Pages;

use App\Filament\Resources\CertificationProviderResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCertificationProvider extends CreateRecord
{
    protected static string $resource = CertificationProviderResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
