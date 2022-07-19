<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'dob',
        'address',
        'phone',
        'identification_number',
        'salary',
        'gender',
    ];

    protected $primaryKey = 'staff_id';

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
