<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run()
    {
        Admin::create([
            'username' => 'admin8',
            'email' => 'admin8@example.com',
            'password' => bcrypt('password'),
        ]);

        Admin::create([
            'username' => 'admin9',
            'email' => 'admin9@example.com',
            'password' => bcrypt('password'),
        ]);
    }
}