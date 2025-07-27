<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum ResourceType: string
{
    use EnumTrait;

    case API = 'api';
    case APP = 'app';
    case DATASET = 'dataset';
    case FRAMEWORK = 'framework';
    case LLM = 'llm';
    case MODEL = 'model';
    case RESEARCH = 'research';
    case TOOL = 'tool';
    case OTHER = 'other';

    public function label(): string
    {
        return match ($this) {
            self::API => 'API',
            self::LLM => 'LLM',
            default => ucwords(str_replace('_', ' ', $this->value)),
        };
    }
}
