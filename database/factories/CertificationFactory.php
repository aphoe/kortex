<?php

namespace Database\Factories;

use App\Models\Certification;
use App\Models\CertificationProvider;
use App\Models\CertificationType;
use App\Models\Currency;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CertificationFactory extends Factory
{
    protected $model = Certification::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'validity' => $this->faker->randomNumber(),
            'level' => $this->faker->word(),
            'renewal_rules' => $this->faker->word(),
            'accreditation_body' => $this->faker->word(),
            'requires_recertification_exam' => $this->faker->boolean(),
            'renewal_fee' => $this->faker->randomFloat(),
            'prerequisite' => $this->faker->word(),
            'expiry_years' => $this->faker->randomNumber(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'certification_provider_id' => CertificationProvider::factory(),
            'certification_type_id' => CertificationType::factory(),
            'currency_id' => Currency::factory(),
        ];
    }
}
