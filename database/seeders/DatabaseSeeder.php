<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            AdminSeeder::class,
            HotelManagerSeeder::class,
            CustomerSeeder::class,
            ServiceSeeder::class,
            HotelSeeder::class,
            RoomSeeder::class,
            ReviewSeeder::class,
            NotificationSeeder::class,
            ReservationSeeder::class,
            ReservationRoomSeeder::class,
            HotelPhotoSeeder::class,
            RoomPhotoSeeder::class,
            HotelServiceSeeder::class,
        ]);
    }
}