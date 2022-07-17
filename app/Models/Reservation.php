<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Room;
use App\Models\Guest;
use App\Models\Payment;
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

    public function totalMoney()
    {
        $checkInDate = Carbon::createFromFormat('Y-m-d', $this->checkin_date);
        $checkOutDate = Carbon::createFromFormat('Y-m-d', $this->checkout_date);
        $days = $checkInDate->diffInDays($checkOutDate);
        $totalMoney = 0;
        $roomIds = $this->rooms()->pluck('rooms.room_id');
        $rooms = Room::find($roomIds);
        foreach ($rooms as $room) {
            $totalMoney += $room->base_price * $days;
        }
        return $totalMoney;
    }

    public function days(){
        $checkInDate = Carbon::createFromFormat('Y-m-d', $this->checkin_date);
        $checkOutDate = Carbon::createFromFormat('Y-m-d', $this->checkout_date);
        return $checkInDate->diffInDays($checkOutDate);
    }

    public function reservedBy(User $user)
    {
        return $this->guest->user->user_id === $user->user_id;
    }

    public function displayWhite(){
        switch ($this->reservation_status_id) {
            case 1:
            case 2:
            case 3:
            case 4:
                return true;

            default:
                return false;
        }
    }

    public function payment(){
        return $this->hasOne(Payment::class, 'reservation_id', 'reservation_id');
    }
}
