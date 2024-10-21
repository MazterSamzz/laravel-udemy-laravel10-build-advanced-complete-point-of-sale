<?php

namespace Database\Factories\Backend;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\=Backend\Permission>
 */
class PermissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create('id_ID');
        return [
            'name' => $faker->name,
            'group_name' => $faker->randomElement([
                'pos',
                'employees',
                'customers',
                'suppliers',
                'salaries',
                'attendaces',
                'categories',
                'products',
                'expenses',
                'sales',
                'stocks',
                'roles'
            ]),
            'guard_name' => 'web',
        ];
    }
}
