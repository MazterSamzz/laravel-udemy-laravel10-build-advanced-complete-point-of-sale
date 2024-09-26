<?php

namespace Database\Seeders\Backend;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $products = [
            1 => ['Beton 10 Polos', 'Beton 10 Ulir', 'Beton 12 Polos', 'Beton 12 Ulir'],
            2 => ['Stainless Steel 20 x 40 / 0,8mm', 'Stainless Steel 20 x 40 / 1mm', 'Stainless Steel 40 x 40 / 1mm'],
            3 => ['Baja Ringan C75 x 0,75', 'Baja Ringan C75 x 0,70', 'Baja Ringan C75 x 0,65'],
        ];

        foreach ($products as $category_id => $productNames) {
            foreach ($productNames as $name) {
                \App\Models\Backend\Product::factory()->create([
                    'category_id' => $category_id,
                    'name' => $name,
                ]);
            }
        }
    }
}
