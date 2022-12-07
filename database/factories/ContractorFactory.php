<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contractor>
 */
class ContractorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'company_name' => $this->faker->unique()->company(),
            'nip' => $this->faker->buildingNumber(),
            'street' => $this->faker->streetAddress,
            'locality' => $this->faker->address,
            'post_code' => $this->faker->postcode,
        ];
    }
}


