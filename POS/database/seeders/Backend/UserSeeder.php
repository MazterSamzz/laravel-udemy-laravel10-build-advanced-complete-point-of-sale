<?php

namespace Database\Seeders\Backend;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!User::where('name', 'root')->first()) {
            User::factory()->create([
                'name' => 'root',
                'email' => 'root@local.host',
                'phone' => '0812345678910',
                'password' => 'Rahasia1234.'
            ]);
        }
    }
}
