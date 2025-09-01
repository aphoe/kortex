<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Parallax\FilamentComments\Models\Traits\HasFilamentComments;
use Spatie\Tags\HasTags;

class Whitepaper extends Model
{
    use HasFactory;
    use HasFilamentComments;
    use HasTags;

    protected $guarded = [];
}
