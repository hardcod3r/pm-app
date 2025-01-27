<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Country>
 */
class CountryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $random_prefix = $this->faker->randomNumber(3);
        return [
            'name' => $random_prefix.$this->faker->country,
            'cca2' => $random_prefix.$this->faker->countryCode,
        ];
    }
}
