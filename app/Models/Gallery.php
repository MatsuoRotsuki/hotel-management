<?php

namespace App\Models;

use App\Models\Room;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gallery extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'img_url',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
