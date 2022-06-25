<?php

namespace App\Models;

use App\Models\RoomType;
use App\Models\RoomStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_area',
        'base_price',
        'room_number',
        'reservation_id',
        'room_type_id',
        'room_status_id',
    ];

    public function room_type(){
        return $this->belongsTo(RoomType::class);
    }

    public function room_status(){
        return $this->belongsTo(RoomStatus::class);
    }

    // public function reserve(){
    //     return $this->hasMany(RoomReservation::class);
    // }
}
