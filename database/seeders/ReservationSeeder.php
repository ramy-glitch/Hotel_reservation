<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reservation;

class ReservationSeeder extends Seeder
{
    public function run()
    {
        Reservation::create([
            'check_in_date' => '2023-12-01',
            'check_out_date' => '2023-12-10',
            'customer_id' => 7,
            'hotel_id' => 6,
            'status' => 'confirmed',
            'number_of_adults' => 2,
            'number_of_children' => 1,
        ]);

        Reservation::create([
            'check_in_date' => '2023-12-15',
            'check_out_date' => '2023-12-20',
            'customer_id' => 8,
            'hotel_id' => 5,
            'status' => 'confirmed',
            'number_of_adults' => 2,
            'number_of_children' => 0,
        ]);
    }
}