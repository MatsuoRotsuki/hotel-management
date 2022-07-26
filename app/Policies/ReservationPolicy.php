<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Reservation;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReservationPolicy
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
    public function isNotStaff(User $user){
        return $user->role !== 'staff';
    }

    public function isAuth(User $user){
        return $user->role === 'admin' || $user->role === 'staff' || $user->role === 'guest';
    }

    public function update(User $user, Reservation $reservation){
        return $reservation->reservedBy($user);
    }

    public function checkout(User $user, Reservation $reservation){
        return $reservation->reservedBy($user) || $user->role === 'staff' || $user->role === 'admin';
    }

    public function create(User $user){
        return $user->guest->reservations()->whereIn('reservation_status_id', [1,2,3,4])->count() === 0;
    }

    public function cancel(User $user, Reservation $reservation){
        return $reservation->reservedBy($user);
    }
}
