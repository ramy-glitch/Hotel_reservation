<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RoomPhoto;

class RoomPhotoSeeder extends Seeder
{
    public function run()
    {
        RoomPhoto::create([
            'photo_url' => 'https://example.com/room1/photo1.jpg',
            'room_id' => 3,
        ]);

        RoomPhoto::create([
            'photo_url' => 'https://example.com/room2/photo1.jpg',
            'room_id' => 4,
        ]);
    }
}