<?php

namespace App\Models;

use App\Traits\ModelCertificationLevel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Parallax\FilamentComments\Models\Traits\HasFilamentComments;
use Spatie\Tags\HasTags;

class Certification extends Model
{
    use HasFactory;
    use HasFilamentComments;
    use HasTags;
    use ModelCertificationLevel;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'requires_recertification_exam' => 'boolean',
        ];
    }

    /*
     * Accessors
     */

    protected function requiresRecertification(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => array_key_exists('requires_recertification_exam', $attributes) && $attributes['requires_recertification_exam'] ? 'Yes' : 'No',
        );
    }

    /*
     * Relationships
     */

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(CertificationProvider::class, 'certification_provider_id');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(CertificationType::class, 'certification_type_id');
    }

    public function fee(): BelongsTo
    {
        return $this->belongsTo(\double::class, 'fee');
    }
}
