<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hotel;

class HotelSeeder extends Seeder
{
    public function run()
    {
        Hotel::create([
            'hotelname' => 'Hotel California',
            'location' => 'Los Angeles, CA',
            'child_age_limit' => 12,
            'manager_id' => 1,
        ]);

        Hotel::create([
            'hotelname' => 'The Grand Budapest Hotel',
            'location' => 'Budapest, Hungary',
            'child_age_limit' => 10,
            'manager_id' => 2,
        ]);
    }
}
