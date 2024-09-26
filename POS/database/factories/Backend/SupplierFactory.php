<?php

namespace Database\Factories\Backend;

use App\Helpers\ImageHelper;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Backend\Supplier>
 */
class SupplierFactory extends Factory
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
            'shopname' => $name . ' Shop',
            'type' => $faker->randomElement(['Distributor', 'Whole Seller']),
            'account_holder' => $name,
            'account_number' => $faker->bankAccountNumber,
            'bank_name' => $faker->randomElement(['BCA', 'BNI', 'Mandiri']),
            'bank_branch' => $faker->city,
            'city' => $faker->city,
            'photo' => ImageHelper::getRandomImage(public_path('sample/profile-images'), 'images/supplier-images')
        ];
    }
}
