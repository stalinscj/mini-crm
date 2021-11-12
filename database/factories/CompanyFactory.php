<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'    => $this->faker->unique()->name,
            'email'   => $this->faker->unique()->safeEmail,
            'website' => $this->faker->unique()->url,
        ];
    }
}
