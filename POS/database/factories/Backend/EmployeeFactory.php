<?php

namespace Database\Factories\Backend;

use App\Helpers\ImageHelper;
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
        $faker = \Faker\Factory::create('id_ID'); // Set locale to Indonesia
        $name = $faker->name;
        return [
            'name' => $name,
            'email' => strtolower(str_replace(' ', '.', $name)) . '@example.com',
            'phone' => $faker->regexify('08[1-9]{1}[0-9]{7,10}'),
            'address' => $faker->address,
            'experience' => $faker->numberBetween(1, 30),
            'salary' => $faker->numberBetween(30, 200) * 100_000,
            'leave' => $faker->numberBetween(0, 24) / 2,
            'city' => $faker->city,
            'photo' => ImageHelper::getRandomImage(public_path('sample/profile-images'), 'images/employee-images'),
        ];
    }
}
