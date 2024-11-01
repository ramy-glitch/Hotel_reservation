<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HotelService;

class HotelServiceSeeder extends Seeder
{
    public function run()
    {
        HotelService::create([
            'hotel_id' => 5,
            'service_id' => 5,
        ]);

        HotelService::create([
            'hotel_id' => 6,
            'service_id' => 6,
        ]);
    }
}