<?php

namespace Database\Factories\Backend;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
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
            'shopname' => $faker->company,
            'account_holder' => $faker->name,
            'account_number' => $faker->bankAccountNumber,
            'bank_name' => $faker->randomElement(['BCA', 'BNI', 'Mandiri']),
            'bank_branch' => $faker->city,
            'city' => $faker->city,
            'photo' => UploadedFile::fake()->image('photo.jpg')
        ];
    }
}
