<?php

namespace App\Models;

use App\Models\Guest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rate extends Model
{
    use HasFactory;

    protected $fillable = [
        'rating',
        'comment',
    ];


    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }

    public function ratedBy(Guest $guest)
    {
        return $this->guest->contains('id', $guest->id);
    }
}
