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
        'first_name',
        'last_name',
        'dob',
        'address',
        'phone',
        'country',
        'city',
        'identification_number',
        'passport_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reservations()
    {
        return $this->hasOne(Reservation::class);
    }

    public function rates(){
        return $this->hasMany(Rate::class);
    }
}
