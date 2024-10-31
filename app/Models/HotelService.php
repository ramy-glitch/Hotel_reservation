<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelService extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id',
        'service_id',
    ];

    protected $table = 'hotel_services';

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
