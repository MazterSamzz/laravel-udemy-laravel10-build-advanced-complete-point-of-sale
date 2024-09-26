<?php

namespace Database\Seeders\Backend;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Backend\Employee::factory()->create([
            'name' => 'John Doe',
            'email' => 'johndoe@local.host',
            'phone' => '0812345678920',
            'address' => 'Jl. Raya No. 1',
            'experience' => 1,
            'salary' => 2_500_000,
        ]);
        \App\Models\Backend\Employee::factory()->create([
            'name' => 'John Die',
            'email' => 'janedie@local.host',
            'phone' => '0812345678921',
            'address' => 'Jl. Raya No. 2',
            'experience' => 2,
            'salary' => 3_000_000,
        ]);
        \App\Models\Backend\Employee::factory()->create([
            'name' => 'John Dee',
            'email' => 'johndee@local.host',
            'phone' => '0812345678922',
            'address' => 'Jl. Raya No. 3',
            'experience' => 3,
            'salary' => 3_500_000,
        ]);
        \App\Models\Backend\Employee::factory()->create([
            'name' => 'Johnny',
            'email' => 'johnny@local.host',
            'phone' => '0812345678923',
            'address' => 'Jl. Raya No. 4',
            'experience' => 4,
            'salary' => 4_000_000,
        ]);
        \App\Models\Backend\Employee::factory()->create([
            'name' => 'John Son',
            'email' => 'johndson@local.host',
            'phone' => '0812345678924',
            'address' => 'Jl. Raya No. 5',
            'experience' => 5,
            'salary' => 5_000_000,
        ]);
    }
}
