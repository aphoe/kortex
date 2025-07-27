<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum Level: string
{
    use EnumTrait;

    case BEGINNER = 'beginner';
    case INTERMEDIATE = 'intermediate';
    case ADVANCED = 'advanced';
    case EXPERT = 'expert';

    public function label(): string
    {
        return ucwords(str_replace('_', ' ', $this->value));
    }
}
