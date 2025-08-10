<?php

namespace App\Filament\Resources\CertificationTypeResource\Pages;

use App\Filament\Resources\CertificationTypeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCertificationType extends CreateRecord
{
    protected static string $resource = CertificationTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
