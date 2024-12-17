<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run()
    {
        Admin::create([
            'username' => 'admin1',
            'email' => 'admin1@example.com',
            'password' => bcrypt('password'),
        ]);

        Admin::create([
            'username' => 'admin2',
            'email' => 'admin1@example.com',
            'password' => bcrypt('password'),
        ]);
    }
}