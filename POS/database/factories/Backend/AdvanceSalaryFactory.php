<?php

namespace Database\Factories\Backend;

use App\Models\Backend\AdvanceSalary;
use App\Models\Backend\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AdvanceSalary>
 */
class AdvanceSalaryFactory extends Factory
{
    // Tambahkan variabel untuk menyimpan index employee_id
    private static $employeeIndex = 0;
    // Pastikan ada properti untuk menyimpan bulan dan tahun terakhir
    private static $month = null;
    private static $year = null;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $employee_id = $this->fetchEmployeeId();
        $employee = Employee::find($employee_id);

        return [
            'employee_id' => $employee->id, // Menggunakan ID dari employee yang sudah ada
            'month' => self::$month,
            'year' => self::$year,
            'amount' => $this->faker->numberBetween(0, $employee->salary / 100_000) * 100_000,
        ];
    }

    /**
     * Fetch employee ID sequentially based on ID.
     *
     * The method will loop through the employees table and return the ID of the next employee.
     * If there is no more employee, it will reset to the first index.
     * The index is stored in a static variable, so it persists across multiple calls.
     * @return int
     */
    private function fetchEmployeeId(): int
    {
        // Ambil employee secara berurutan berdasarkan ID
        $employee = Employee::orderBy('id')->skip(self::$employeeIndex)->first();

        // Jika tidak ada employee yang tersisa, reset ke index pertama
        if (!$employee) {
            self::$employeeIndex = 0;
            $employee = Employee::orderBy('id')->skip(self::$employeeIndex)->first();
        }

        self::calculateNextMonth($employee->id);

        // Increment index untuk iterasi berikutnya
        self::$employeeIndex++;

        return $employee->id;
    }

    /**
     * Calculate the next month of the given employee.
     *
     * The method will fetch the latest month from the AdvanceSalary table for the given employee,
     * and then increment the month. If the month exceeds 12, it will reset to 1 and increment the year.
     * If there is no data, it will start from the current month.
     * @param int $employee_id
     * @return int
     */
    private function calculateNextMonth($employee_id): int
    {
        // Ambil bulan terbaru dari tabel Salary untuk karyawan tertentu
        $advanceSalary = AdvanceSalary::where('employee_id', $employee_id)
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->first();

        if ($advanceSalary) {
            self::$month = $advanceSalary->month + 1; // Tambah bulan
            self::$year = $advanceSalary->year;

            // Jika bulan lebih dari 12, reset ke 1 dan tambah tahun
            if (self::$month > 12) {
                self::$month = 1;
                self::$year++;
            }
        } else {
            // Jika tidak ada data, mulai dari bulan ini
            self::$month = now()->month;
            self::$year = now()->year;
        }

        return self::$month;
    }
}
