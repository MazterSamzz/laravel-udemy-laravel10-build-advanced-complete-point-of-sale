<?php

namespace Database\Factories\Backend;

use App\Models\Backend\Attendance;
use App\Models\Backend\Employee;
use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Backend\Attendance>
 */
class AttendanceFactory extends Factory
{
    // Declare variable to store employee index
    private static $employeeIndex = 0;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $employee_id = $this->fetchEmployeeId();

        return [
            'employee_id' => $employee_id,
            'date' => $this->getDate($employee_id),
            'status' => $this->faker->randomElement(['Present', 'Leave', 'Absent']),
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

        // Increment index untuk iterasi berikutnya
        self::$employeeIndex++;

        return $employee->id;
    }


    /**
     * Calculate the next date for the given employee.
     *
     * The method will fetch the latest date from the Attendance table for the given employee,
     * and then increment the date.
     * @param int $employee_id
     * @return int
     */
    private function getDate($employee_id)
    {
        // Ambil bulan terbaru dari tabel Salary untuk karyawan tertentu
        $attendance = Attendance::where('employee_id', $employee_id)
            ->orderBy('date', 'desc')->first();

        // Jika tidak ada catatan kehadiran sebelumnya, mulai dari tanggal hari ini
        if (!$attendance) {
            return now()->format('Y-m-d'); // Jika tidak ada attendance, kembalikan tanggal hari ini
        }
        $date = new DateTime($attendance->date);
        $date->modify('+1 day');

        return $date->format('Y-m-d');
    }
}
