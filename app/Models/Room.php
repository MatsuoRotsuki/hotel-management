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

    protected $primaryKey = 'room_id';

    public function room_type(){
        return $this->belongsTo(RoomType::class, 'room_type_id', 'room_type_id');
    }

    public function room_status(){
        return $this->belongsTo(RoomStatus::class, 'room_status_id', 'room_status_id');
    }

    public function gallery(){
        return $this->hasMany(Gallery::class, 'room_id', 'room_id');
    }

    public function reservations()
    {
        return $this->belongsToMany(Reservation::class, 'reservation_room', 'room_id', 'reservation_id');
    }

    public function bookedBy(User $user){
        if ($user->confirmedInformation){
            $guest = $user->guest;
            $reservation = $guest->reservations->whereIn('reservation_status_id', [1, 2, 3, 4])->first();
            if($reservation){
                $ids = $reservation->rooms()->pluck('rooms.room_id');
                return $ids->contains($this->room_id);
            }
        }
        return false;
    }
}
