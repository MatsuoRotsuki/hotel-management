<?php

namespace App\Models;

use App\Models\Guest;
use App\Models\Gallery;
use App\Models\RoomType;
use App\Models\RoomStatus;
use App\Models\Reservation;
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

    public function gallery(){
        return $this->hasMany(Gallery::class);
    }

    public function reservations()
    {
        return $this->belongsToMany(Reservation::class, 'reservation_pivots', 'room_id', 'reservation_id');
    }

    public function bookedBy(User $user){
        if ($user->confirmedInformation){
            $guest = $user->guest;
            if($user->guest->reservations()->count()){
                $ids = $guest->reservations->rooms()->pluck('id');
                return $ids->contains($this->id);
            }
        }
        return false;
    }
}
