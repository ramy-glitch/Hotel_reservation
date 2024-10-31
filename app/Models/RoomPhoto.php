<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'photo_url',
        'room_id',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}