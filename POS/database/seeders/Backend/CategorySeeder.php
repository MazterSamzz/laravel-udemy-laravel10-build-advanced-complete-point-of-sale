<?php

namespace Database\Seeders\Backend;

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Backend\Category::factory()->create(['name' => 'Besi']);
        \App\Models\Backend\Category::factory()->create(['name' => 'Stainless Steel']);
        \App\Models\Backend\Category::factory()->create(['name' => 'Baja Ringan']);
    }
}
