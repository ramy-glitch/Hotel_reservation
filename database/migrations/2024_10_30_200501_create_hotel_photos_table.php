<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelPhotosTable extends Migration
{
    public function up()
    {
        Schema::create('hotel_photos', function (Blueprint $table) {
            $table->id();
            $table->text('photo_url');
            $table->foreignId('hotel_id')->constrained('hotels');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hotel_photos');
    }
};