<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HotelPhoto;

class HotelPhotoSeeder extends Seeder
{
    public function run()
    {
        HotelPhoto::create([
            'photo_url' => 'https://example.com/hotel1/photo1.jpg',
            'hotel_id' => 5,
        ]);

        HotelPhoto::create([
            'photo_url' => 'https://example.com/hotel2/photo1.jpg',
            'hotel_id' => 6,
        ]);
    }
}