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
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Authentication Routes
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::view('register', "auth.register")->name('register');

// Admin Routes
Route::middleware('auth:admin')->group(function () {
    Route::resource('admins', AdminController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('hotels', HotelController::class);
    Route::resource('rooms', RoomController::class);
    Route::resource('reviews', ReviewController::class);
    Route::resource('notifications', NotificationController::class);
    Route::resource('hotel-photos', HotelPhotoController::class);
    Route::resource('room-photos', RoomPhotoController::class);
});

// Hotel Manager Routes
Route::middleware('auth:hotel_manager')->group(function () {
    Route::resource('hotel-managers', HotelManagerController::class);
    Route::resource('reservations', ReservationController::class);
    Route::resource('reservation-rooms', ReservationRoomController::class);
    Route::resource('hotel-photos', HotelPhotoController::class);
    Route::resource('room-photos', RoomPhotoController::class);
});

// Customer Routes
Route::middleware('auth:customer')->group(function () {
    Route::resource('reservations', ReservationController::class);
    Route::resource('rooms', RoomController::class);
    Route::resource('reviews', ReviewController::class);
    Route::resource('notifications', NotificationController::class);
});

