<?php

namespace App\Policies;

use App\Models\Room;
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

    public function book(User $user, Room $room){
        $canReserve = false;
        switch($room->room_status_id){
            case 1:
            case 4:
            case 7:
                $canReserve = true;
                break;
            default:
                $canReserve = false;
                break;
        }

        $roomGuestId = $room->reservations->whereIn('reservation_status_id', [1,2,3,4])->pluck('guest')->pluck('guest_id');
        if (!$user->confirmed_information){
            return $canReserve;
        } else {
            $guestId = $user->guest->guest_id;
            if ($user->guest->reservations->whereIn('reservation_status_id', [1,2,3,4])->count() > 0){
                $reservation = $user->guest->reservations->whereIn('reservation_status_id', [1,2,3,4])->first();
                $status = ($reservation->reservation_status_id === 1) ? 1 : 0;
                if (!$roomGuestId->contains($guestId)){
                    return $canReserve && $status;
                }
                else return false;
            } else return $canReserve;
        }
    }

    public function unbook(User $user, Room $room){
        $roomGuestId = $room->reservations->whereIn('reservation_status_id', [1])->pluck('guest')->pluck('guest_id');
        if (!$user->confirmed_information){
            return false;
        } else {
            $guestId = $user->guest->guest_id;
            if ($roomGuestId->contains($guestId) && $room->room_status_id !== 3){
                return true;
            } else return false;
        }
    }

    public function hasBooked(User $user, Room $room){
        $roomGuestId = $room->reservations->pluck('guest')->pluck('guest_id');
        if (!$user->confirmed_information){
            return false;
        } else {
            $guestId = $user->guest->guest_id;
            if($roomGuestId->contains($guestId) && $room->room_status_id === 3){
                return true;
            } else return false;
        }
    }

    public function hasCheckedIn(User $user, Room $room){
        $roomGuestId = $room->reservations->whereIn('reservation_status_id', [4])->pluck('guest')->pluck('guest_id');
        if (!$user->confirmed_information){
            return false;
        } else {
            $guestId = $user->guest->guest_id;
            return $roomGuestId->contains($guestId) && $room->room_status_id === 2;
        }
    }
}
