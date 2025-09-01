<?php

namespace Database\Factories;

use App\Models\Whitepaper;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class WhitepaperFactory extends Factory
{
    protected $model = Whitepaper::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'url' => $this->faker->url(),
            'abstract' => $this->faker->paragraph(),
            'summary' => $this->faker->paragraph(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
