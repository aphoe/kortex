<?php

namespace App\Traits;

use App\Enums\PricingTierType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait ModelPricingTier
{
    /*
     * Accessors
     */

    protected function pricingTierTypeString(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => PricingTierType::tryFrom($attributes['pricing_tier_type'])?->label(),
        );
    }

    /*
     * Scopes
     */

    public function scopeByPricingTierType(Builder $query, string $type): Builder
    {
        return $query->where('pricing_tier_type', $type);
    }
}
