<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HotelService;

class HotelServiceSeeder extends Seeder
{
    public function run()
    {
        HotelService::create([
            'hotel_id' => 1,
            'service_id' => 1,
        ]);

        HotelService::create([
            'hotel_id' => 2,
            'service_id' => 2,
        ]);
    }
}