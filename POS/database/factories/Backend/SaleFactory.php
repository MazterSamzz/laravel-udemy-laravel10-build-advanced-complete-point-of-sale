<?php

namespace Database\Factories\Backend;

use App\Enums\DeliveryStatus;
use App\Enums\PaymentStatus;
use App\Models\Backend\Customer;
use App\Models\Backend\SalesDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Backend\Sale>
 */
class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => Customer::inRandomOrder()->first()->id,
            'date' => $this->faker->date(),
            'status' => 1,
            'total_products' => 0, // Default to 0, will be calculated based on SalesDetails
            'vat' => 0, // Default to 0, will be calculated based on SalesDetails
            'total' => 0, // Default to 0, will be calculated based on SalesDetails
            'payment_status' => PaymentStatus::cases()[array_rand([PaymentStatus::Unpaid, PaymentStatus::NotYet])],
            'paid' => 0, // Default to 0, will be calculated based on SalesDetails
            'recieveables' => 0, // Will be calculated after total is set
        ];
    }

    public function withDetails(int $detailCount = 3)
    {
        return $this->afterCreating(function ($sale) use ($detailCount) {
            $details = SalesDetail::factory()->count($detailCount)->create([
                'sale_id' => $sale->id,
            ]);

            // Recalculate total_products and total from SalesDetails
            $totalPrice = $details->sum('total_price');
            $total = bcmul($totalPrice, 1.11, 2);
            $paid = $this->faker->randomFloat(2, 1, $total / 1000) * 1000;

            $sale->update([
                'total_products' => $totalPrice,
                'vat' => bcmul($totalPrice, 0.11, 2),
                'total' => $total,
                'paid' => $paid,
                'recieveables' => bcsub($total, $paid, 2)
            ]);
        });
    }
}
