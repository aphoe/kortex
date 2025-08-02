<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BookmarkType extends Model
{
    use HasFactory;

    protected $guarded = [];

    /*
     * Relationships
     */

    public function bookmarks(): HasMany
    {
        return $this->hasMany(Bookmark::class);
    }
}
