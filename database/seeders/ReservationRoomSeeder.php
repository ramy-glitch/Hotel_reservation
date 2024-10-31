<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ReservationRoom;

class ReservationRoomSeeder extends Seeder
{
    public function run()
    {
        ReservationRoom::create([
            'reservation_id' => 1,
            'room_id' => 1,
            'room_price' => 200.00,
        ]);

        ReservationRoom::create([
            'reservation_id' => 2,
            'room_id' => 2,
            'room_price' => 300.00,
        ]);
    }
}