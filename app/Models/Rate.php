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

    protected $primaryKey = 'rate_id';

    public function guest()
    {
        return $this->belongsTo(Guest::class, 'guest_id', 'guest_id');
    }

    public function ratedBy(Guest $guest)
    {
        return $this->guest->contains('id', $guest->id);
    }
}
