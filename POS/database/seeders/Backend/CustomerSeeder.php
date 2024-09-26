<?php

namespace Database\Seeders\Backend;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Backend\Customer::factory()->create([
            'name' => 'Michael Scofield',
            'email' => 'michaelscofield@local.host',
            'phone' => '0812345678930',
            'address' => 'Jl. Customer Raya No. 1',
            'shopname' => 'Michael Shop',
            'account_holder' => 'Michael Scofield',
            'account_number' => '0091234567',
            'bank_name' => 'BCA',
            'bank_branch' => 'Jakarta',
            'city' => 'Jakarta',
        ]);
        \App\Models\Backend\Customer::factory()->create([
            'name' => 'Lincoln Burrows',
            'email' => 'Lincolnburrows@local.host',
            'phone' => '0812345678931',
            'address' => 'Jl. Customer Raya No. 2',
            'shopname' => 'Burrows Shop',
            'account_holder' => 'Lincoln Burrows',
            'account_number' => '0091234567',
            'bank_name' => 'BCA',
            'bank_branch' => 'Jakarta',
            'city' => 'Jakarta',
        ]);
        \App\Models\Backend\Customer::factory()->create([
            'name' => 'John Abrazzi',
            'email' => 'johnabrazzi@local.host',
            'phone' => '0812345678930',
            'address' => 'Jl. Customer Raya No. 3',
            'shopname' => 'John Abrazzi Shop',
            'account_holder' => 'John Abrazzi',
            'account_number' => '0091234567',
            'bank_name' => 'BCA',
            'bank_branch' => 'Jakarta',
            'city' => 'Jakarta',
        ]);
    }
}
