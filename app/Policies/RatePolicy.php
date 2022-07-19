<?php

namespace App\Policies;

use App\Models\Rate;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RatePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function delete(User $user, Rate $rate)
    {
        if ($user->role === 'admin'){
            return true;
        }
        if ($user->confirmed_information){
            return $user->guest->guest_id === $rate->guest_id;
        }
        return false;
    }

    public function isGuest(User $user){
        return $user->role === 'guest';
    }
}
