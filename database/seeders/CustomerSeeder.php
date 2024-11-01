<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        Customer::create([
            'username' => 'customer7',
            'email' => 'customer7@example.com',
            'password' => bcrypt('password'),
            'birth_date' => '1990-01-01',
        ]);

        Customer::create([
            'username' => 'customer8',
            'email' => 'customer8@example.com',
            'password' => bcrypt('password'),
            'birth_date' => '1992-02-02',
        ]);
    }
}

