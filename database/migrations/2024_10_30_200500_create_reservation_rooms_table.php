<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationRoomsTable extends Migration
{
    public function up()
    {
        Schema::create('reservation_rooms', function (Blueprint $table) {
            $table->foreignId('reservation_id')->constrained('reservations')->onDelete('cascade');
            $table->foreignId('room_id')->constrained('rooms')->onDelete('cascade');
            $table->double('room_price');
            $table->primary(['reservation_id', 'room_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('reservation_rooms');
    }
};