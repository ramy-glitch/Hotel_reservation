<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        Service::create([
            'servicename' => 'Room Service',
            'description' => '24/7 room service',
            'availability' => true,
            'cost' => 50.00,
        ]);

        Service::create([
            'servicename' => 'Laundry',
            'description' => 'Laundry service',
            'availability' => true,
            'cost' => 20.00,
        ]);
    }
}