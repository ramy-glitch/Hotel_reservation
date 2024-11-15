<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        Customer::create([
            'username' => 'customer00',
            'email' => 'customer00@example.com',
            'password' => bcrypt('123456'),
            'birth_date' => '1990-01-01',
        ]);

    }
}

