<?php

namespace Database\Factories\Backend;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'experience' => $this->faker->numberBetween(1, 10),
            'salary' => $this->faker->numberBetween(3000000, 15000000),
            'leave' => $this->faker->randomFloat(1, 1, 12),
            'city' => $this->faker->city,
        ];
    }
}
