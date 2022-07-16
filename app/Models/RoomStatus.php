<?php

namespace App\Models;

use App\Models\Room;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoomStatus extends Model
{
    use HasFactory;

    protected $primaryKey = 'room_status_id';

    public function rooms(){
        return $this->hasMany(Room::class, 'room_status_id', 'room_status_id');
    }
}
