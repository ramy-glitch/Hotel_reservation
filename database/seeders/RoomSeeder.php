<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    public function run()
    {
        Room::create([
            'room_number' => '101',
            'room_type' => 'Deluxe',
            'standard_capacity' => 2,
            'max_capacity' => 4,
            'adult_price' => 200.00,
            'child_price' => 100.00,
            'availability' => true,
            'hotel_id' => 1,
        ]);

        Room::create([
            'room_number' => '102',
            'room_type' => 'Suite',
            'standard_capacity' => 2,
            'max_capacity' => 4,
            'adult_price' => 300.00,
            'child_price' => 150.00,
            'availability' => true,
            'hotel_id' => 1,
        ]);
    }
}