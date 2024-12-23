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
            'hotel_id' => 1,
        ]);

        Service::create([
            'servicename' => 'Laundry',
            'description' => 'Laundry service',
            'availability' => true,
            'cost' => 20.00,
            'hotel_id' => 1,
        ]);

        Service::create([
            'servicename' => 'Airport Transfer',
            'description' => 'Airport transfer service',
            'availability' => true,
            'cost' => 100.00,
            'hotel_id' => 1,
        ]);

        Service::create([
            'servicename' => 'Spa',
            'description' => 'Spa service',
            'availability' => true,
            'cost' => 150.00,
            'hotel_id' => 1,
        ]);
    }
}