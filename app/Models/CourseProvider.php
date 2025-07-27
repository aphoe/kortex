<?php

namespace App\Models;

use App\Traits\ModelCourseProviderType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseProvider extends Model
{
    use HasFactory;
    use ModelCourseProviderType;

    protected $guarded = [];
}
