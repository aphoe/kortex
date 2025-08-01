<?php

namespace Database\Factories;

use App\Enums\CourseProviderType;
use App\Models\CourseProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CourseProviderFactory extends Factory
{
    protected $model = CourseProvider::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'type' => CourseProviderType::fakerChoice(),
            'url' => $this->faker->url(),
            'email' => $this->faker->unique()->safeEmail(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
