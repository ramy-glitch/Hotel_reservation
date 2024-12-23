<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\HotelManager;
use App\Models\Room;
use App\Models\Review;
use App\Models\HotelPhoto;
use App\Models\Service;
use App\Models\Reservation;


class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotelname',
        'location',
        'child_age_limit',
        'manager_id',
    ];

    public function manager()
    {
        return $this->belongsTo(HotelManager::class, 'manager_id');
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function photos()
    {
        return $this->hasMany(HotelPhoto::class);
    }

    public function firstPhoto()
    {
        return $this->hasOne(HotelPhoto::class)->oldest();
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function availableServices()
    {
        return $this->services()->where('availability', true);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}