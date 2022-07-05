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
        if ($user->confirmedInformation){
            return $user->guest->id === $rate->guest_id;
        }
        else return false;
    }
}
