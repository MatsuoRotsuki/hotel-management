<?php

namespace App\Models;

use App\Models\Room;
use App\Models\Guest;
use App\Models\ReservationStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'checkin_date',
        'checkout_date',
        'num_of_people',
        'reservation_status_id',
    ];

    protected $primaryKey = 'reservation_id';

    protected $attributes = [
        'reservation_status_id' => 1,
    ];

    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'reservation_room', 'reservation_id', 'room_id');
    }

    public function guest()
    {
        return $this->belongsTo(Guest::class, 'guest_id', 'guest_id');
    }

    public function status()
    {
        return $this->belongsTo(ReservationStatus::class, 'reservation_status_id', 'reservation_status_id');
    }
}
