<?php

namespace App\Traits;

use App\Enums\ResourceType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait ModelResourceType
{
    /*
     * Accessors
     */

    protected function typeString(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => ResourceType::tryFrom($attributes['type'])?->label(),
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
