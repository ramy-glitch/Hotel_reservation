<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimestampsToTables extends Migration
{
    public function up()
    {
        Schema::table('reservation_rooms', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('hotel_services', function (Blueprint $table) {
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('reservation_rooms', function (Blueprint $table) {
            $table->dropTimestamps();
        });

        Schema::table('hotel_services', function (Blueprint $table) {
            $table->dropTimestamps();
        });
    }
};