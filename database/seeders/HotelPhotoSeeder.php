<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HotelPhoto;

class HotelPhotoSeeder extends Seeder
{
    public function run()
    {
        HotelPhoto::create([
            'photo_url' => 'img2.jpg',
            'hotel_id' => 1,
        ]);

        HotelPhoto::create([
            'photo_url' => 'img3.jpg',
            'hotel_id' => 1,
        ]);

        HotelPhoto::create([
            'photo_url' => 'img4.jpg',
            'hotel_id' => 1,
        ]);

        HotelPhoto::create([
            'photo_url' => 'img5.jpg',
            'hotel_id' => 1,
        ]);

    }
}