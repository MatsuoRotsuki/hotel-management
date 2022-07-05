<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'department_id',
        'dob',
        'address',
        'phone',
        'identification_number',
        'salary',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
