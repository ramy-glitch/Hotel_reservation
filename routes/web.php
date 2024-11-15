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
})->name('welcome');

// Authentication Routes
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::view('register', "auth.register")->name('register');

// Customer registration Route
Route::resource ('customers', CustomerController::class) ->only(['store']);




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

    // Custom routes for AdminController methods
    Route::post('customers/{customer_id}/update', [AdminController::class, 'updateCustomerAccount'])->name('customers.update');
    Route::delete('customers/{customer_id}', [AdminController::class, 'deleteCustomerAccount'])->name('customers.delete');
    Route::post('hotel-managers/create', [AdminController::class, 'createHotelManagerAccount'])->name('hotel_managers.create');
    Route::post('hotel-managers/{managerId}/update', [AdminController::class, 'updateHotelManagerAccount'])->name('hotel_managers.update');
    Route::delete('hotel-managers/{managerId}', [AdminController::class, 'deleteHotelManagerAccount'])->name('hotel_managers.delete');
});

// Hotel Manager Routes
Route::middleware('auth:hotel_manager')->group(function () {
    Route::resource('hotel-managers', HotelManagerController::class);
    Route::resource('reservations', ReservationController::class);
    Route::resource('reservation-rooms', ReservationRoomController::class);
    Route::resource('hotel-photos', HotelPhotoController::class);
    Route::resource('room-photos', RoomPhotoController::class);

    // Custom routes for HotelManagerController methods
    Route::get('hotels', [HotelManagerController::class, 'index'])->name('hotels.index');
    Route::get('hotels/create', [HotelManagerController::class, 'create'])->name('hotels.create');
    Route::post('hotels', [HotelManagerController::class, 'store'])->name('hotels.store');
    Route::get('hotels/{id}', [HotelManagerController::class, 'show'])->name('hotels.show');
    Route::get('hotels/{id}/edit', [HotelManagerController::class, 'edit'])->name('hotels.edit');
    Route::put('hotels/{id}', [HotelManagerController::class, 'update'])->name('hotels.update');
    Route::delete('hotels/{id}', [HotelManagerController::class, 'destroy'])->name('hotels.destroy');
    Route::post('hotels/{id}/photos', [HotelController::class, 'addPhoto'])->name('hotels.photos.store');

    // Custom routes for room management by HotelManagerController
    Route::get('hotels/{hotelId}/rooms', [HotelManagerController::class, 'listRooms'])->name('hotels.rooms.index');
    Route::post('hotels/{hotelId}/rooms', [HotelManagerController::class, 'addRoom'])->name('hotels.rooms.store');
    Route::put('rooms/{roomId}', [HotelManagerController::class, 'updateRoom'])->name('rooms.update');
    Route::delete('rooms/{roomId}', [HotelManagerController::class, 'deleteRoom'])->name('rooms.destroy');

    // Custom routes for service management by HotelManagerController
    Route::post('hotels/{hotelId}/services', [HotelManagerController::class, 'addService'])->name('hotels.services.store');
    Route::put('services/{serviceId}', [HotelManagerController::class, 'updateService'])->name('services.update');
    Route::delete('services/{serviceId}', [HotelManagerController::class, 'deleteService'])->name('services.destroy');
});

// Customer Routes
Route::middleware('auth:customer')->group(function () {
    Route::resource('reservations', ReservationController::class);
    Route::resource('rooms', RoomController::class);
    Route::resource('reviews', ReviewController::class);
    Route::resource('notifications', NotificationController::class);
});

// Hotel Routes
Route::resource('hotels', HotelController::class);
Route::get('hotels/{id}/details', [HotelController::class, 'getHotelDetails'])->name('hotels.details');
Route::get('hotels/{id}/rooms', [HotelController::class, 'getRooms'])->name('hotels.rooms');
Route::get('hotels/{id}/services', [HotelController::class, 'getServices'])->name('hotels.services');
Route::get('hotels/{id}/reviews', [HotelController::class, 'getReviews'])->name('hotels.reviews');
