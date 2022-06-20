<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RoomPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function isAdmin(User $user){
        return $user->role === 'admin';
    }

    public function isGuest(User $user){
        return $user->role === 'guest';
    }

    public function isStaff(User $user){
        return $user->role === 'staff' || $user->role === 'admin';
    }
}
