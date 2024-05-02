<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EarthEon>
 */
class EarthEonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'eon' => $this->faker->word,
            'era' => $this->faker->word,
            'period' => $this->faker->word,
            'subperiod' => $this->faker->word,
            'epoch' => $this->faker->word,
            'age' => $this->faker->word,
            'base' => $this->faker->randomFloat(2, 0, 100),
            'duration' => $this->faker->randomFloat(2, 0, 100),
            'eon_desc' => $this->faker->word
        ];
    }
}
