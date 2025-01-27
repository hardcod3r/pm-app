<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\ProjectPhase;
use App\Enums\ProjectType;
use App\Models\Project;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph,
            'company_id' => \App\Models\Company::factory(),
            'phase' => ProjectPhase::getRandomValue(),
            'project_type' => ProjectType::getRandomValue(),
        ];


    }

    private function buildTimeline()
    {
        $startDate = $this->faker->dateTimeBetween('-1 year', 'now');
        $endDate = $this->faker->dateTimeBetween($startDate, strtotime('+1 year'));
        return [
            'start_date' => $startDate,
            'end_date' => $endDate,
        ];
    }

    public function standard(): static
    {
        return $this->state(fn (array $attributes) => [
            'project_type' => ProjectType::Standard(),
        ]);
    }

    public function complex(): static
    {
        return $this->state(fn (array $attributes) => [
            'project_type' => ProjectType::Complex(),
            'budget' => $this->faker->randomFloat(2, 1000, 100000),
            'timeline' => $this->buildTimeline(),
        ]);
    }
}
