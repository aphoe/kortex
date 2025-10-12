<?php

namespace Database\Factories;

use App\Models\Prompt;
use App\Models\PromptService;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PromptFactory extends Factory
{
    protected $model = Prompt::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'prompt' => $this->faker->text(),
            'description' => $this->faker->text(),
            'before' => $this->faker->word(),
            'after' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'prompt_service_id' => PromptService::factory(),
        ];
    }
}
