<?php

namespace Database\Factories;

use App\Models\Tool;
use App\Models\ToolType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ToolFactory extends Factory
{
    protected $model = Tool::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'url' => $this->faker->url(),
            'git_repo_url' => $this->faker->url(),
            'is_saas' => $this->faker->boolean(),
            'is_self_hosted' => $this->faker->boolean(),
            'is_open_source' => $this->faker->boolean(),
            'has_api' => $this->faker->boolean(),
            'has_free_tier' => $this->faker->boolean(),
            'has_affiliate' => $this->faker->boolean(),
            'description' => $this->faker->text(),
            'features' => $this->faker->word(),
            'pricing' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'tool_type_id' => ToolType::factory(),
        ];
    }
}
