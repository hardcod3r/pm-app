<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Country;
use PHPUnit\Framework\Constraint\Count;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        //get random country
        $country = Country::all()->random();
        return [
            'name' => $this->faker->company,
            'address' => $this->faker->address,
            'country_id' => $country->id,
            'vat_id' => $this->generateVatNumber($country->cca2),
            'logo' => 'https://via.placeholder.com/150',
            'website' => $this->faker->url,

        ];
    }

    public function country($country): static
    {
        $country = Country::where('name', $country)->first();
        return $this->state(fn (array $attributes) => [
            'country_id' => $country->id,
            'vat_id' => $this->generateVatNumber($country->cca2),
        ]);
    }

    private function generateVatNumber($code)
    {
        $randomNumbers = $this->faker->regexify('[0-9]{9}'); // Generate 9 digits
        return $code . $randomNumbers; // Combine for a VAT-like format
    }
}
