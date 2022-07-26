<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationPivot extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'reservation_id'
    ];

    protected $table = 'reservation_room';

    public $timestamps = false;
}
