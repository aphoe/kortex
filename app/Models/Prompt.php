<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Parallax\FilamentComments\Models\Traits\HasFilamentComments;
use Spatie\Tags\HasTags;

class Prompt extends Model
{
    use HasFactory;
    use HasFilamentComments;
    use HasTags;

    protected $guarded = [];

    /*
     * Relationships
     */

    public function promptService(): BelongsTo
    {
        return $this->belongsTo(PromptService::class);
    }
}
