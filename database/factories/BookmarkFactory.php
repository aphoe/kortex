<?php

namespace Database\Factories;

use App\Models\Bookmark;
use App\Models\BookmarkType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class BookmarkFactory extends Factory
{
    protected $model = Bookmark::class;

    public function definition(): array
    {
        return [
            'url' => $this->faker->url(),
            'title' => $this->faker->word(),
            'description' => $this->faker->text(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'bookmark_type_id' => BookmarkType::factory(),
        ];
    }
}
