<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HotelManager;

class HotelManagerSeeder extends Seeder
{
    public function run()
    {
        HotelManager::create([
            'username' => 'manager7',
            'email' => 'manager7@example.com',
            'password' => bcrypt('password'),
        ]);

        HotelManager::create([
            'username' => 'manager8',
            'email' => 'manager8@example.com',
            'password' => bcrypt('password'),
        ]);
    }
}
