<?php

namespace App\Models;

use App\Traits\ModelCourseProviderType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CourseProvider extends Model
{
    use HasFactory;
    use ModelCourseProviderType;

    protected $guarded = [];

    /*
     * Relationships
     */

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }
}
