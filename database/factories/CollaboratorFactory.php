<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class CollaboratorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'company_id' => Company::factory(),
            'name'       => $this->faker->firstName,
            'last_name'  => $this->faker->lastName,
            'email'      => $this->faker->unique()->safeEmail,
            'phone'      => $this->faker->numerify('#########'),
        ];
    }
}
