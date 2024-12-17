<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HotelManager;

class HotelManagerSeeder extends Seeder
{
    public function run()
    {
        HotelManager::create([
            'username' => 'manager1',
            'email' => 'manager1@example.com',
            'password' => bcrypt('password'),
        ]);

        HotelManager::create([
            'username' => 'manager2',
            'email' => 'manager2@example.com',
            'password' => bcrypt('password'),
        ]);
    }
}
