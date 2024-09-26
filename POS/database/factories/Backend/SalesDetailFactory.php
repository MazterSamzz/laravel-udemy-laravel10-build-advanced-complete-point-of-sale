<?php

namespace Database\Factories\Backend;

use App\Models\Backend\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SalesDetail>
 */
class SalesDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $product = Product::inRandomOrder()->first();
        $qty = $this->faker->numberBetween(1, 1000);
        $price = number_format($product->selling_price, 2, '.', '');

        return [
            'product_id' => $product->id,
            'qty' => $qty,
            'cogs' => $product->buying_price,
            'price' => $price,
            'total_price' => bcmul($qty, $price, 2),
        ];
    }
}
