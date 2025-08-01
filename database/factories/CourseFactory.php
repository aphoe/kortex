<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\CourseProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CourseFactory extends Factory
{
    protected $model = Course::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'description' => $this->faker->text(),
            'level' => $this->faker->word(),
            'duration' => $this->faker->word(),
            'launch_date' => Carbon::now(),
            'has_certificate' => $this->faker->boolean(),
            'pricing_tier_type' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'course_provider_id' => CourseProvider::factory(),
        ];
    }
}
