<?php

namespace App\Models;

use App\Models\Room;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = [
        'dob',
        'address',
        'phone',
        'country',
        'city',
        'identification_number',
        'passport_id',
    ];

    protected $primaryKey = 'guest_id';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'guest_id', 'guest_id');
    }

    public function rates(){
        return $this->hasMany(Rate::class, 'guest_id', 'guest_id');
    }

    public function alreadyReserve(){
        return $this->reservations->whereIn('reservation_status_id', [1, 2, 3, 4])->count();
    }
}
