<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
            'name' => $this->faker->company,
            'companyName' => $this->faker->unique()->company(),
            'nip' => $this->faker->unique()->creditCardNumber,
            'street' => $this->faker->streetAddress,
            'town' => $this->faker->address,
            'post_code' => $this->faker->postcode,
        ];
    }
}
