<?php

namespace Database\Factories\Backend;

use App\Models\Backend\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AdvanceSalary>
 */
class AdvanceSalaryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // fetch a random employee

        $employee = Employee::inRandomOrder()->first();

        return [
            'employee_id' => $employee->id, // Menggunakan ID dari employee yang sudah ada
            'month' => $this->faker->numberBetween(1, 12),
            'year' => $this->faker->year,
            'amount' => $this->faker->numberBetween(0, $employee->salary / 100_000) * 100_000,
        ];
    }
}
