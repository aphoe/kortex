<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum NavigationGroup: string
{
    use EnumTrait;

    case BOOKMARKS = 'bookmarks';

    case CERTIFICATIONS = 'certifications';
    case COURSES = 'courses';

    case MISC = 'miscellaneous';
    case RESOURCES = 'resources';
    case USERS = 'users';

    public function label(): string
    {
        return ucwords(str_replace('_', ' ', $this->value));
    }
}
