<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ToolType extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the tools for the tool type.
     */
    public function tools(): HasMany
    {
        return $this->hasMany(Tool::class);
    }
}
