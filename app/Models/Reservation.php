<?php

namespace App\Models;

use App\Models\Room;
use App\Models\Guest;
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

    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'reservation_pivots', 'reservation_id', 'room_id');
    }

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }
}
