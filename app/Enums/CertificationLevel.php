<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum CertificationLevel: string
{
    use EnumTrait;

    case FOUNDATIONAL = 'foundational';
    case ASSOCIATE = 'associate';
    case PROFESSIONAL = 'professional';
    case EXPERT = 'expert';

    public function label(): string
    {
        return ucwords(str_replace('_', ' ', $this->value));
    }
}
