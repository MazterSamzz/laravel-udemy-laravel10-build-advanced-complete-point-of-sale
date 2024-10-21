<?php

namespace Database\Seeders\Backend;

use App\Models\Backend\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['group_name' => 'pos', 'name' => 'pos.menu'],
            ['group_name' => 'employees', 'name' => 'employees.menu'],
            ['group_name' => 'employees', 'name' => 'employees.index'],
            ['group_name' => 'employees', 'name' => 'employees.create'],
            ['group_name' => 'employees', 'name' => 'employees.edit'],
            ['group_name' => 'employees', 'name' => 'employees.destroy'],
            ['group_name' => 'customers', 'name' => 'customers.menu'],
            ['group_name' => 'customers', 'name' => 'customers.index'],
            ['group_name' => 'customers', 'name' => 'customers.create'],
            ['group_name' => 'customers', 'name' => 'customers.edit'],
            ['group_name' => 'customers', 'name' => 'customers.destroy'],
            ['group_name' => 'suppliers', 'name' => 'suppliers.menu'],
            ['group_name' => 'suppliers', 'name' => 'suppliers.index'],
            ['group_name' => 'suppliers', 'name' => 'suppliers.create'],
            ['group_name' => 'suppliers', 'name' => 'suppliers.edit'],
            ['group_name' => 'suppliers', 'name' => 'suppliers.destroy'],
            ['group_name' => 'salaries', 'name' => 'salaries.menu'],
            ['group_name' => 'salaries', 'name' => 'salaries.index'],
            ['group_name' => 'salaries', 'name' => 'salaries.create'],
            ['group_name' => 'salaries', 'name' => 'salaries.show'],
            ['group_name' => 'attendances', 'name' => 'attendances.menu'],
            ['group_name' => 'attendances', 'name' => 'attendances.index'],
            ['group_name' => 'attendances', 'name' => 'attendances.create'],
            ['group_name' => 'attendances', 'name' => 'attendances.edit'],
            ['group_name' => 'attendances', 'name' => 'attendances.destroy'],
            ['group_name' => 'categories', 'name' => 'categories.menu'],
            ['group_name' => 'categories', 'name' => 'categories.index'],
            ['group_name' => 'categories', 'name' => 'categories.create'],
            ['group_name' => 'categories', 'name' => 'categories.edit'],
            ['group_name' => 'categories', 'name' => 'categories.destroy'],
            ['group_name' => 'products', 'name' => 'products.menu'],
            ['group_name' => 'products', 'name' => 'products.index'],
            ['group_name' => 'products', 'name' => 'products.create'],
            ['group_name' => 'products', 'name' => 'products.edit'],
            ['group_name' => 'products', 'name' => 'products.destroy'],
            ['group_name' => 'expenses', 'name' => 'expenses.menu'],
            ['group_name' => 'expenses', 'name' => 'expenses.index'],
            ['group_name' => 'expenses', 'name' => 'expenses.create'],
            ['group_name' => 'expenses', 'name' => 'expenses.edit'],
            ['group_name' => 'expenses', 'name' => 'expenses.destroy'],
            ['group_name' => 'sales', 'name' => 'sales.menu'],
            ['group_name' => 'sales', 'name' => 'sales.index'],
            ['group_name' => 'sales', 'name' => 'sales.complete'],
            ['group_name' => 'stocks', 'name' => 'stocks.menu'],
            ['group_name' => 'roles', 'name' => 'roles.menu'],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
