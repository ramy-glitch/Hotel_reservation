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
            'hotel_id' => 5,
        ]);

        HotelPhoto::create([
            'photo_url' => 'img3.jpg',
            'hotel_id' => 6,
        ]);

        HotelPhoto::create([
            'photo_url' => 'img4.jpg',
            'hotel_id' => 7,
        ]);

        HotelPhoto::create([
            'photo_url' => 'img5.jpg',
            'hotel_id' => 8,
        ]);

        HotelPhoto::create([
            'photo_url' => 'img6.jpg',
            'hotel_id' => 9,
        ]);

        HotelPhoto::create([
            'photo_url' => 'img7.jpg',
            'hotel_id' => 10,
        ]);

        HotelPhoto::create([
            'photo_url' => 'img8.jpg',
            'hotel_id' => 11,
        ]);

        HotelPhoto::create([
            'photo_url' => 'img9.jpg',
            'hotel_id' => 12,
        ]);

    }
}