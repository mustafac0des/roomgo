<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Booking; 
use App\Models\User; 

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'host_id',
        'beds',
        'washrooms',
        'guests',
        'address',
        'city',
        'price',
        'amenities',
        'image',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class); 
    }

    public function host()
    {
        return $this->belongsTo(User::class, 'host_id');
    }
}
