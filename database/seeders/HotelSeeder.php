<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hotel;

class HotelSeeder extends Seeder
{
    public function run()
    {

        Hotel::create([
            'hotelname' => 'The Overlook Hotel',
            'location' => 'Estes Park, CO',
            'child_age_limit' => 14,
            'manager_id' => 3,
        ]);

        Hotel::create([
            'hotelname' => 'The Great Northern Hotel',
            'location' => 'Twin Peaks, WA',
            'child_age_limit' => 12,
            'manager_id' => 3,
        ]);

        Hotel::create([
            'hotelname' => 'The Bates Motel',
            'location' => 'Fairvale, CA',
            'child_age_limit' => 16,
            'manager_id' => 3,
        ]);

        Hotel::create([
            'hotelname' => 'The Shining Hotel',
            'location' => 'Estes Park, CO',
            'child_age_limit' => 14,
            'manager_id' => 3,
        ]);

        Hotel::create([
            'hotelname' => 'The Plaza Hotel',
            'location' => 'New York, NY',
            'child_age_limit' => 12,
            'manager_id' => 3,
        ]);

        Hotel::create([
            'hotelname' => 'The Grand Hotel',
            'location' => 'Mackinac Island, MI',
            'child_age_limit' => 10,
            'manager_id' => 3,
        ]);

        Hotel::create([
            'hotelname' => 'The Hotel Cortez',
            'location' => 'Los Angeles, CA',
            'child_age_limit' => 16,
            'manager_id' => 3,
        ]);

        Hotel::create([
            'hotelname' => 'The Dolphin Hotel',
            'location' => 'New York, NY',
            'child_age_limit' => 14,
            'manager_id' => 3,
        ]);


    }
}
