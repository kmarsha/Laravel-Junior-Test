<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'fName' => $this->faker->firstName(),
            'lName' => $this->faker->lastName(),
            'company_id' => rand(1,2),
            'email' => $this->faker->unique()->email(),
            'phone' => $this->faker->phoneNumber(),
        ];
    }
}
