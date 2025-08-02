<?php

namespace App\Models;

use App\Traits\ModelResourceType;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Parallax\FilamentComments\Models\Traits\HasFilamentComments;
use Spatie\Tags\HasTags;

class Resource extends Model
{
    use HasFactory;
    use HasFilamentComments;
    use HasTags;
    use ModelResourceType;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'is_open_source' => 'boolean',
        ];
    }

    /*
     * Attributes
     */

    public function openSource(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => array_key_exists('is_open_source', $attributes) && $attributes['is_open_source'] ? 'Yes' : 'No',
        );
    }

    /*
     * Relationships
     */

    public function category(): BelongsTo
    {
        return $this->belongsTo(ResourceCategory::class, 'resource_category_id');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function resourceCategory(): BelongsTo
    {
        return $this->belongsTo(ResourceCategory::class);
    }
}
