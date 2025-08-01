<?php

namespace App\Traits;

use App\Enums\CourseProviderType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait ModelCourseProviderType
{

    /*
     * Accessors
     */

    protected function typeString(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => CourseProviderType::tryFrom($attributes['type'])?->label(),
        );
    }

    /*
     * Scopes
     */

    public function scopeByType(Builder $query, string $type): Builder
    {
        return $query->where('type', $type);
    }
}
