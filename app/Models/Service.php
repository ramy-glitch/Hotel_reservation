<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'servicename',
        'description',
        'availability',
        'cost',
    ];


    public function hotels()
    {
        return $this->belongsToMany(Hotel::class, 'hotel_services');
    }
}