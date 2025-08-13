<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tool extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'is_saas' => 'boolean',
            'is_self_hosted' => 'boolean',
            'is_open_source' => 'boolean',
            'has_api' => 'boolean',
            'has_free_tier' => 'boolean',
            'has_affiliate' => 'boolean',
        ];
    }

    /*
     * Accessors
     */

    protected function saas(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => array_key_exists('is_saas', $attributes) && $attributes['is_saas'] ? 'Yes' : 'No',
        );
    }

    protected function selfHosted(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => array_key_exists('is_self_hosted', $attributes) && $attributes['is_self_hosted'] ? 'Yes' : 'No',
        );
    }

    protected function openSource(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => array_key_exists('is_open_source', $attributes) && $attributes['is_open_source'] ? 'Yes' : 'No',
        );
    }

    protected function api(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => array_key_exists('has_api', $attributes) && $attributes['has_api'] ? 'Yes' : 'No',
        );
    }

    protected function freeTier(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => array_key_exists('has_free_tier', $attributes) && $attributes['has_free_tier'] ? 'Yes' : 'No',
        );
    }

    protected function affiliate(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => array_key_exists('has_affiliate', $attributes) && $attributes['has_affiliate'] ? 'Yes' : 'No',
        );
    }

    /*
     * Relationships
     */

    public function type(): BelongsTo
    {
        return $this->belongsTo(ToolType::class, 'tool_type_id');
    }
}
