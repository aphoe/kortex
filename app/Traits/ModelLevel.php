<?php

namespace App\Traits;

use App\Enums\Level;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait ModelLevel
{
    /*
     * Accessors
     */

    protected function levelString(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => Level::tryFrom($attributes['level'])?->label(),
        );
    }

    /*
     * Scopes
     */

    public function scopeByLevel(Builder $query, string $level): Builder
    {
        return $query->where('level', $level);
    }
}
