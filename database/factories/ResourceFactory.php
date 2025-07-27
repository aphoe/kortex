<?php

namespace Database\Factories;

use App\Enums\ResourceType;
use App\Models\Company;
use App\Models\Resource;
use App\Models\ResourceCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ResourceFactory extends Factory
{
    protected $model = Resource::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'url' => $this->faker->url(),
            'type' => ResourceType::fakerChoice(),
            'is_open_source' => $this->faker->boolean(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'company_id' => Company::factory(),
            'resource_category_id' => ResourceCategory::factory(),
        ];
    }
}
