<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum CourseProviderType: string
{
    use EnumTrait;

    case ONLINE = 'online';
    case MOOC = 'MOOC';
    case UNIVERSITY = 'university';
    case BOOTCAMP = 'bootcamp';
    case CORPORATE = 'corporate';
    case INDEPENDENT = 'independent';
    case OFFLINE = 'offline';

    public function label(): string
    {
        return match ($this) {
            self::MOOC => 'MOOC',
            default => ucwords(str_replace('_', ' ', $this->value)),
        };
    }
}
