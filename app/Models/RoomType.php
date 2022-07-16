<?php

namespace App\Models;

use App\Models\Room;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoomType extends Model
{
    use HasFactory;

    protected $primaryKey = 'room_type_id';

    public function rooms(){
        return $this->hasMany(Room::class, 'room_type_id', 'room_type_id');
    }
}
