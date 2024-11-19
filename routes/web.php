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
    $hotels = App\Models\Hotel::all();
    $reviews = App\Models\Review::all();
    $rooms = App\Models\Room::all();

    return view('welcome',compact('hotels','reviews','rooms'));
})->name('welcome');

// Authentication Routes
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::view('register', "auth.register")->name('register');

// Customer registration Route
Route::resource('customers', CustomerController::class)->only(['store']);

// Admin Routes
Route::middleware('auth:admin')->group(function () {


    // Custom routes for AdminController methods
    Route::post('customers/{customer_id}/update', [AdminController::class, 'updateCustomerAccount'])->name('customers.update');
    Route::delete('customers/{customer_id}', [AdminController::class, 'deleteCustomerAccount'])->name('customers.delete');
    Route::post('hotel-managers/create', [AdminController::class, 'createHotelManagerAccount'])->name('hotel_managers.create');
    Route::post('hotel-managers/{managerId}/update', [AdminController::class, 'updateHotelManagerAccount'])->name('hotel_managers.update');
    Route::delete('hotel-managers/{managerId}', [AdminController::class, 'deleteHotelManagerAccount'])->name('hotel_managers.delete');
});

// Hotel Manager Routes
Route::middleware('auth:hotel_manager')->group(function () {


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
    Route::get('dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard');
    Route::get('hotels', [HotelController::class, 'index'])->name('hotels.index');
});
