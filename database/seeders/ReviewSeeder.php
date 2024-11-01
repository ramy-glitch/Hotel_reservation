<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;

class ReviewSeeder extends Seeder
{
    public function run()
    {
        Review::create([
            'rating' => 5,
            'review_comment' => 'Excellent service!',
            'customer_id' => 7,
            'hotel_id' => 5,
        ]);

        Review::create([
            'rating' => 4,
            'review_comment' => 'Very good experience.',
            'customer_id' => 8,
            'hotel_id' => 6,
        ]);
    }
}
