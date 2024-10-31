<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelManager extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    public function hotels()
    {
        return $this->hasMany(Hotel::class, 'manager_id');
    }
}