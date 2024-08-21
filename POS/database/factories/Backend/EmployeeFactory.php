<?php

namespace Database\Factories\Backend;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;

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

        return [
            'name' => $faker->name,
            'email' => $faker->unique()->safeEmail,
            'phone' => $faker->regexify('0[1-9][0-9]{7,12}'),
            'address' => $faker->address,
            'experience' => $faker->numberBetween(1, 30),
            'salary' => $faker->numberBetween(30, 200) * 100_000,
            'leave' => $faker->numberBetween(0, 24) / 2,
            'city' => $faker->city,
            'photo' => UploadedFile::fake()->image('photo.jpg'),
        ];
    }
}
