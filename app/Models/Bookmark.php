<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Tags\HasTags;

class Bookmark extends Model
{
    use HasFactory;
    use HasTags;

    protected $guarded = [];

    /*
     * Relationships
     */

    public function bookmarkType(): BelongsTo
    {
        return $this->belongsTo(BookmarkType::class);
    }
}
