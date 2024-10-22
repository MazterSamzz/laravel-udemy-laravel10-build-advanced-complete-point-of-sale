<?php

namespace Database\Seeders\Backend;

use App\Models\Backend\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['Super Admin', 'Admin', 'Account', 'Manager'];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }
    }
}
