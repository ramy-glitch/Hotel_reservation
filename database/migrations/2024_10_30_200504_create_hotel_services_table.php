<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelServicesTable extends Migration
{
    public function up()
    {
        Schema::create('hotel_services', function (Blueprint $table) {
            $table->foreignId('hotel_id')->constrained('hotels');
            $table->foreignId('service_id')->constrained('services');
            $table->primary(['hotel_id', 'service_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('hotel_services');
    }
};

