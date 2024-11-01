<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HotelManagerController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReservationRoomController;
use App\Http\Controllers\HotelPhotoController;
use App\Http\Controllers\RoomPhotoController;
use App\Http\Controllers\HotelServiceController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('admins', AdminController::class);
Route::resource('hotel-managers', HotelManagerController::class);
Route::resource('customers', CustomerController::class);
Route::resource('services', ServiceController::class);
Route::resource('hotels', HotelController::class);
Route::resource('rooms', RoomController::class);
Route::resource('reviews', ReviewController::class);
Route::resource('notifications', NotificationController::class);
Route::resource('reservations', ReservationController::class);
Route::resource('reservation-rooms', ReservationRoomController::class);
Route::resource('hotel-photos', HotelPhotoController::class);
Route::resource('room-photos', RoomPhotoController::class);
Route::resource('hotel-services', HotelServiceController::class);
