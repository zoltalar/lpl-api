<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AdminFactory extends Factory
{
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'username' => fake()->userName(),
            'email' => fake()->email(),
            'phone' => fake()->phoneNumber(),
            'password' => fake()->password(8),
            'active' => rand(0, 1)
        ];
    }
}
