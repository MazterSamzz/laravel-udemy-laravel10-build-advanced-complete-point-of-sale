<?php

namespace Database\Factories\Backend;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Backend\Expense>
 */
class ExpenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Faker untuk data acak
        $faker = \Faker\Factory::create('id_ID');

        // Mendapatkan tanggal acak
        $date = $faker->dateTimeThisMonth();  // Mendapatkan tanggal acak bulan ini
        $year = $date->format('Y');
        $month = $date->format('m');  // Mengambil format 'mm' (2 digit)

        return [
            'details' => $faker->sentence(3), // Detil pengeluaran
            'amount' => $faker->numberBetween(1, 300) * 10_000, // Jumlah pengeluaran acak
            'date' => $date->format('Y-m-d'), // Menggunakan format Y-m-d untuk tanggal
            'year' => $year, // Tahun dari tanggal acak
            'month' => $month, // Bulan dengan format ZEROFILL
        ];
    }
}
