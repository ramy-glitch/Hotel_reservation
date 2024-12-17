<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HotelPhoto;

class HotelPhotoSeeder extends Seeder
{
    public function run()
    {
        HotelPhoto::create([
            'photo_url' => 'img1.jpg',
            'hotel_id' => 1,
        ]);

        HotelPhoto::create([
            'photo_url' => 'img1.jpg',
            'hotel_id' => 2,
        ]);
    }
}