<?php

namespace Database\Factories\Backend;

use App\Models\Backend\Employee;
use App\Models\Backend\Salary;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Backend\Salary>
 */
class SalaryFactory extends Factory
{
    // Declare variable to store employee index
    private static $employeeIndex = 0;
    // Declare variable to store month and year
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
            'employee_id' => $employee_id,
            'month' => self::$month,
            'year' => self::$year,
            'paid' => $employee->salary ?? 0,
            'advance' => $employee->advance->amount ?? 0,
            'due' => $employee->salary ?? 0 - $employee->advance->amount ?? 0,
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
     * The method will fetch the latest month from the Salary table for the given employee,
     * and then increment the month. If the month exceeds 12, it will reset to 1 and increment the year.
     * If there is no data, it will start from the current month.
     * @param int $employee_id
     * @return int
     */
    private function calculateNextMonth($employee_id): int
    {
        // Ambil bulan terbaru dari tabel Salary untuk karyawan tertentu
        $salary = Salary::where('employee_id', $employee_id)
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->first();

        if ($salary) {
            self::$month = $salary->month + 1; // Tambah bulan
            self::$year = $salary->year;

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
