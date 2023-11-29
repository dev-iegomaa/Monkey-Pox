<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CountryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->country,
            'iso' => $this->faker->unique()->iso8601(),
            'code' => $this->faker->unique()->numberBetween(1, 60000)
        ];
    }
}
