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
        $reservation = $guest->reservations->whereIn('reservation_status_id', [1, 2, 3, 4])->first();
        $reservation_status = $reservation->reservation_status_id;
        $selectedRoomIds = null;
        $confirmedRoomIds = null;
        $queueRoomIds = null;
        $checkedInRoomIds = null;
        $checkedOutRoomsIds = null;
        if ($reservation_status === 1){
            $selectedRoomIds = $reservation->rooms()->pluck('rooms.room_id');
        } elseif ($reservation_status === 2){
            $queueRoomIds = $reservation->rooms()->pluck('rooms.room_id');
        } elseif ($reservation_status === 3){
            $confirmedRoomIds = $reservation->rooms()->pluck('rooms.room_id');
        } elseif ($reservation_status === 4){
            $checkedInRoomIds = $reservation->rooms()->pluck('rooms.room_id');
        } elseif ($reservation_status === 5){
            $checkedOutRoomsIds = $reservation->rooms()->pluck('rooms.room_id');
        }

        $selectedRooms = Room::find($selectedRoomIds);
        $confirmedRooms = Room::find($confirmedRoomIds);
        $queueRooms = Room::find($queueRoomIds);
        $checkedInRooms = Room::find($checkedInRoomIds);
        $checkedOutRooms = Room::find($checkedOutRoomsIds);

        return view('reservation.index', [
            'selectedRooms' => $selectedRooms,
            'queueRooms' => $queueRooms,
            'confirmedRooms' => $confirmedRooms,
            'checkedInRooms' => $checkedInRooms,
            'checkedOutRooms' => $checkedOutRooms,
        ]);
    }

    public function store(Room $room, Request $request){ //book.push
        $this->authorize('isGuest', Reservation::class);

        $reservation = $request->user()->guest->reservations->whereIn('reservation_status_id', [1])->first();
        $roomId = $room->room_id;
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
        $reservation = $guest->reservations->whereIn('reservation_status_id', [1])->first();
        $room_ids = $reservation->rooms()->pluck('rooms.room_id');
        $guestReserveId = $reservation->reservation_id;
        $reservation->update(['reservation_status_id' => 2]);
        $idNotIn = Reservation::all()->except($guestReserveId)->pluck('reservation_id');


        $rooms = Room::find($room_ids);
        foreach ($rooms as $room){
            $room->update(['room_status_id' => 3]);
            $room->reservations()->detach($idNotIn);
        }
        return redirect()->route('booked');
    }

    public function destroy(Room $room, Request $request){
        $this->authorize('isGuest', Reservation::class);

        $reservation = $request->user()->guest->reservations->whereIn('reservation_status_id', [1])->first();
        $roomId = $room->room_id;
        $reservation->rooms()->detach($roomId);
        return back();
    }
}
