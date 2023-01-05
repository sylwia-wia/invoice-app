<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Unit;
use App\Models\VatRate;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            'name' => $this->faker->word,
            'unit_is' => Unit::factory(),
           'vat_rate_id' => VatRate::factory(),
            'vat' => $this->faker->unique()->randomDigit(),
            'price' => $this->faker->randomFloat(2),
        ];
    }
}
