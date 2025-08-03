<?php

namespace Database\Factories;

use App\Models\BookmarkType;
use App\Models\Note;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class NoteFactory extends Factory
{
    protected $model = Note::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'description' => $this->faker->paragraphs(asText: true),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'bookmark_type_id' => BookmarkType::factory(),
        ];
    }
}
