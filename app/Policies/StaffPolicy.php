<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StaffPolicy
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
    public function isStaff(User $user){
        return $user->role === 'staff';
    }

    public function isReception(User $user){
        return ($user->role === 'staff' && $user->staff->department_id === 1);
    }

    public function isJanitor(User $user){
        return ($user->role === 'staff' && $user->staff->department_id === 2);
    }
}
