<?php

namespace Database\Factories\Backend;

use App\Helpers\ImageHelper;
use App\Models\Backend\Category;
use App\Models\Backend\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Backend\Product>
 */
class ProductFactory extends Factory
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
            'name' => $faker->unique()->word(), // Nama produk yang unik
            'category_id' => Category::inRandomOrder()->first()->id,
            'supplier_id' => Supplier::inRandomOrder()->first()->id,
            'code' => $faker->unique()->optional()->regexify('[A-Z0-9]{10}'), // Kode produk acak
            'garage' => $faker->optional()->word(),
            'store' => $faker->optional()->word(),
            'buying_date' => now(),
            'expire_date' => now(),
            'buying_price' => $faker->numberBetween(20, 2_000) * 500,
            'selling_price' => $faker->numberBetween(20, 2_000) * 500,
            'image' => ImageHelper::getRandomImage(public_path('sample/product-images'), 'images/product-images'),
        ];
    }
}
