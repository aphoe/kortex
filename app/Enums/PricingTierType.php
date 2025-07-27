<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum PricingTierType: string
{
    use EnumTrait;

    case FREE = 'free';
    case FREEMIUM = 'freemium';
    case SUBSCRIPTION = 'subscription';
    case ONE_TIME = 'one-time';
    case PAY_WHAT_YOU_WANT = 'pay_what_you_want';


    public function label(): string
    {
        return match ($this) {
            self::ONE_TIME => 'One-time',
            default => ucwords(str_replace('_', ' ', $this->value)),
        };
    }
}
