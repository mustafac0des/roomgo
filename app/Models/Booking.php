<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Room; 

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',      
        'user_id',
        'status',  
        'start_date',    
        'end_date', 
        'guests',
        'price',       
        'guest_name',    
        'guest_phone',   
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function guest()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
