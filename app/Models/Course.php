<?php

namespace App\Models;

use App\Traits\ModelLevel;
use App\Traits\ModelPricingTier;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Parallax\FilamentComments\Models\Traits\HasFilamentComments;
use Spatie\Tags\HasTags;

class Course extends Model
{
    use HasFactory;
    use HasFilamentComments;
    use HasTags;
    use ModelPricingTier;
    use ModelLevel;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'launch_date' => 'date',
            'has_certificate' => 'boolean',
        ];
    }

    /*
     * Relationships
     */

    public function courseProvider(): BelongsTo
    {
        return $this->belongsTo(CourseProvider::class);
    }
}
