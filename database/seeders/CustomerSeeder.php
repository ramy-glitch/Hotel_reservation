<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        Customer::create([
            'username' => 'customer1',
            'email' => 'customer1@example.com',
            'password' => bcrypt('password'),
            'birth_date' => '1990-01-01',
        ]);

        Customer::create([
            'username' => 'customer2',
            'email' => 'customer2@example.com',
            'password' => bcrypt('password'),
            'birth_date' => '1991-01-01',
        ]);

    }
}

