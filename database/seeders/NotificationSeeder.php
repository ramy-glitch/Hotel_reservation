<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Notification;

class NotificationSeeder extends Seeder
{
    public function run()
    {
        Notification::create([
            'message' => 'Your reservation is confirmed.',
            'customer_id' => 1,
        ]);

        Notification::create([
            'message' => 'Your room is ready.',
            'customer_id' => 2,
        ]);
    }
}