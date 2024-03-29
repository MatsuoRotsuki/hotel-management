<?php

namespace App\Models;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReservationStatus extends Model
{
    use HasFactory;

    protected $primaryKey = 'reservation_status_id';

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'reservation_status_id', 'reservation_status_id');
    }
}
