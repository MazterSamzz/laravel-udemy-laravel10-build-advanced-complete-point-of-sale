<?php

namespace Database\Seeders;

use App\Models\Backend\Sale;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            Backend\UserSeeder::class,
            Backend\EmployeeSeeder::class,
            Backend\CustomerSeeder::class,
            Backend\SupplierSeeder::class,
        ]);

        for ($i = 0; $i < 3; $i++) {
            $this->call(Backend\AdvanceSalarySeeder::class);
        }

        for ($i = 0; $i < 3; $i++) {
            $this->call(Backend\SalarySeeder::class);
        }

        for ($i = 0; $i < 2; $i++) {
            $this->call(Backend\AttendanceSeeder::class);
        }

        $this->call([
            Backend\CategorySeeder::class,
            Backend\ProductSeeder::class,
        ]);

        $paymentStatus = 1;
        for ($i = 0; $i < 7; $i++) {
            for ($j = 3; $j < 6; $j++) {

                Sale::factory()->withDetails($j)->create([
                    'date' => date('Y-m-d'),
                    'payment_status' => $paymentStatus
                ]);

                if ($paymentStatus == 9)
                    $paymentStatus = 1;
                else
                    $paymentStatus++;
            }
        }
    }
}
