<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Guest;
use App\Models\RoomStatus;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $guest = $request->user()->guest;
        $ids = $guest->reservations->rooms()->pluck('id');
        $rooms = Room::find($ids);
        $confirmedRooms = $rooms->where('room_status_id', 3);
        $queueRooms = $rooms->whereNotIn('room_status_id', [3]);
        return view('reservation.index', [
            'queueRooms' => $queueRooms,
            'confirmedRooms' => $confirmedRooms,
        ]);
    }

    public function store(Room $room, Request $request){ //book.push
        $this->authorize('isGuest', Reservation::class);

        $reservation = $request->user()->guest->reservations;
        $roomId = $room->id;
        $reservation->rooms()->attach($roomId);
        return back();
    }

    public function create(Request $request){

        $this->authorize('isGuest', Reservation::class);

        $this->validate($request, [
            'checkin_date' => ['required','date','after:yesterday'],
            'checkout_date' => ['required','date','after:checkin_date'],
            'num_of_people' => ['required','numeric','max:50'],
        ]);

        $request->user()->guest->reservations()->create([
            'checkin_date' => $request->checkin_date,
            'checkout_date' => $request->checkout_date,
            'num_of_people' => $request->num_of_people
        ]);

        return redirect()->route('room');
    }

    public function redirectCreate(){
        return view('reservation.create');
    }

    public function showQueue(){
        $this->authorize('isStaff', Reservation::class);

        dd('ok this is confirmed book');
    }

    public function confirm(Request $request)
    {
        $this->authorize('isGuest', Reservation::class);
        $guest = $request->user()->guest;
        $room_ids = $guest->reservations->rooms()->pluck('id');
        $guestReserveId = $guest->reservations->id;
        $guest->reservations->update(['reservation_status_id' => 2]);
        $idNotIn = Reservation::all()->except($guestReserveId)->pluck('id');


        $rooms = Room::find($room_ids);
        foreach ($rooms as $room){
            $room->update(['room_status_id' => 3]);
            $room->reservations()->detach($idNotIn);
        }
        return redirect()->route('booked');
    }

    public function destroy(Room $room, Request $request){
        $this->authorize('isGuest', Reservation::class);

        $reservation = $request->user()->guest->reservations;
        $roomId = $room->id;
        $reservation->rooms()->detach($roomId);
        return back();
    }
}
