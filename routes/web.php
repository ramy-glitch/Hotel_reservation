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

    Route::get('admin', [AdminController::class, 'index'])->name('admins.index');
    Route::post('admins/{id}/update-username', [AdminController::class, 'updateUsername'])->name('admin.updateUsername');
    Route::post('admins/{id}/update-password', [AdminController::class, 'updatePassword'])->name('admin.updatePassword');
    Route::delete('admins/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');


});

// Hotel Manager Routes
Route::middleware('auth:hotel_manager')->group(function () {
    Route::get('hotel-managers', [HotelManagerController::class, 'index'])->name('hotelManager.index');
    Route::post('hotel-managers/{id}/update-username', [HotelManagerController::class, 'updateUsername'])->name('hotelManager.updateUsername');
    Route::post('hotel-managers/{id}/update-password', [HotelManagerController::class, 'updatePassword'])->name('hotelManager.updatePassword');
    Route::delete('hotel-managers/{id}', [HotelManagerController::class, 'destroy'])->name('hotelManager.destroy');

});

// Customer Routes
Route::middleware('auth:customer')->group(function () {
    Route::get('dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard');
    Route::get('hotels', [HotelController::class, 'index'])->name('hotels.index');
    Route::post('customers/{id}/update-username-birthday', [CustomerController::class, 'updateUsernameBirthday'])->name('customer.updateUsernameBirthday');
    Route::post('customers/{id}/update-password', [CustomerController::class, 'updatePassword'])->name('customer.updatePassword');
    Route::delete('customers/{id}', [CustomerController::class, 'destroy'])->name('customer.destroy');
    Route::get('hotels/search', [HotelController::class, 'search'])->name('hotels.search');
});
